<?php

namespace App\Http\Controllers;

use \App\Helper\Enumeration\UserFormat;
use \App\Models\Attachment;
use \App\Rules\UserPickerRule;
use \App\Livewire\UserPicker;
use \App\Models\User;
use \Illuminate\Http\Request;
use \App\Helper\WebString\WebString;
use \App\Helper\ServerDatabaseConversion;
use \App\Helper\Translator;
use \App\Helper\Extended\DateTime;
use Illuminate\Pagination\Paginator;
use App\Models\Mail;
use App\Helper\Enumeration\Mailbox;
use App\Helper\Trait\THandleSearchbox;

class MailController extends Controller
{
  use THandleSearchbox;

  ///////////////////////////////////////////////////////////////////////////////
  // PUBLIC

  //*****************************************************************************
  public function create()
  {
    return view('Access.Mail.create', [
      'mailCategory' => Mailbox::None,
      'searchboxFormat' => UserFormat::Receiver
    ]);
  }

  //******************************************************************************
  public function destroy(Mail $mail)
  {
    // determine if request is a soft deletion
    $isSoftDeletion = true; // (A)
    // user can only delete their mails, not mails of others
    $sentMails = auth()->user()->sentMails;
    if ($sentMails != null)
    { // user has some received mails
      foreach ($sentMails as $sentMail)
      { // Symfony standard reads: loops structures should be blocks of code
        if ($mail->id == $sentMail->id)
        { // Symfony standard reads: program flow constructs should be blocks of code
          // mail is user's mail
          $isSoftDeletion = false; // (A) user's mail can be deleted
          break;
        }
      }
    }

    if ( ! $isSoftDeletion)
    {
      // request is a deletion
      $mail->delete(); // ondelete cascade should ensue
      return redirect()->back();
    }

    // request is a soft deletion
    // mail is NOT user's mail
    foreach ($mail->receivers as $receiver)
    { // (B) loop models, not collections
      if ($receiver->pivot->user_id == auth()->user()->id)
      { // asserted: user_id is correct
        if ($receiver->pivot->mail_id == $mail->id)
        { // asserted: mail_id is correct
          // found mail delivery record
          $receiver->pivot->isSoftDeleted = true;
          // (B) update model
          $receiver->pivot->update();
          break;
        }
      }
    }
    
    return redirect()->back();

  }

  //******************************************************************************
  public function download(Attachment $attachment)
  {
    $filePathName = config('fs.path.storage.attachments') .
      "/{$attachment->attachmentFileName}";

    if(file_exists($filePathName))
    {
      // HEADERS - OBLIGATORY
      header('Content-Description: File Transfer');
      header("Content-Type: {$attachment->mimeType}");
      // Content-Disposition
      // attachment value has nothing to do with EReg Application
      // attachment value is a co-incidence
      header('Content-Disposition: attachment; filename="' . basename($filePathName) . '"');
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filePathName));
      
      // DOWNLOAD FILE - READFILE() IN PRACTICE
      readfile($filePathName);

    }

    // Assert file_exists() behaves properly
    clearstatcache();

  }

  //******************************************************************************
  public function index(Mailbox $mailCategory)
  {
    switch ($mailCategory)
    {
      // default Mail Category to Inbox
      case Mailbox::None :

        // change to Inbox ...
        $mailCategory = Mailbox::Inbox;

        // ... continue handling request()

    }

    // prepare: a batch of mails
    $paginatedMails = $this->handleMailboxRequest($mailCategory);

    return view('Access.Mail.index', [
      'paginatedMails' => $paginatedMails,
      'mailCategory' => $mailCategory,
      'search' => $this->getSearch()
    ]);

  }

  //*****************************************************************************
  public function show(Mailbox $mailCategory, int $mail_id)
  {
    // fetch mail
    $mail = Mail::FindOrFail($mail_id);
    
    // fetch MAIL DELIVERY DATE
    $sentOn = $mail->mailDeliveryDate();
    
    // how long ago ?
    $sentOnAgo = DateTime::dateTimeAgo($sentOn);

    // make date human readable
    $sentOn = DateTime::relativeDate($sentOn);

    // translate
    $sentOn = Translator::translate($sentOn, false);
    $sentOnAgo = Translator::translate($sentOnAgo, true);

    $mail->body = ServerDatabaseConversion::markupNewlines($mail->body);

    // attachments
    $attachments = [];
    foreach ($mail->attachments as $attachment)
      $attachments[] = [
        'id'            => $attachment->id,
        'fileName'      => $attachment->attachmentFileName,
        'shortFileName' => ServerDatabaseConversion::shortenFileName(
          $attachment->attachmentFileName
        )
      ];

    return view('Access.Mail.show', [
      'attachments'   => $attachments,
      'mail'          => $mail,
      'mailCategory'  => $mailCategory,
      'sentOn'        => $sentOn,
      'sentOnAgo'     => $sentOnAgo
    ]);

  }

  //*****************************************************************************

  public function store(Request $request)
  {
    $request->validate([
      'usersString' => ['required', 'string', new UserPickerRule],
      'subject' => ['required', 'string', 'max:255'],
      'mail' => ['max:65535'],
      'another' => ''
    ]);
    
    // validate each file
    for ($i = 0; $request->input("file$i"); $i++)
    {
      $request->validate([
        "file$i" => ['file']
      ]);
    }

    $data = $this->retrieveRequestData($request);

    $mailId = $this->storeRequestData($data);

    return redirect()->route('mail.show', [
      Mailbox::Sent->value,
      $mailId
    ]);

  }
  
  ///////////////////////////////////////////////////////////////////////////////
  // PRIVATE

  //*****************************************************************************

  private function handleMailboxRequest(
    Mailbox $mailCategory
  ) : Paginator
  {
    // prepare data: mails as Models
    $mails = new \Illuminate\Database\Eloquent\Collection();
    
    // prepare data: mails as array
    // prepare pagination
    $mailArray = [];

    switch ($mailCategory)
    {
      case Mailbox::Inbox :
        
        $mails = auth()->user()->receivedMails;

        break;
      
      case Mailbox::Sent :

        $mails = auth()->user()->sentMails;

        break;

    }

    $mails = $this->handleSearchbox($mails);

    // group mail data
    foreach ($mails as $mail)
    {
      // break with no mails in Response
      if (count($mails) == 0)
      {
        break;
      }
      
      // fetch MAIL DELIVERY DATE
      $sentOn = $mail->mailDeliveryDate();

      // make date human readable
      $sentOnPretty = DateTime::relativeDate($sentOn);

      // translate
      $sentOnPretty = Translator::translate($sentOnPretty, false);

      // group mail data
      $mailArray[] = [
        'id'                => $mail->id, // VIEW: OnClick: remove mail
        'user.prefix'       => $mailCategory == Mailbox::Sent ? __('To:') : __('From:'),
        'user.users'        => '',
        'title'             => $mail->title,
        'sentOnPretty'      => $sentOnPretty,
        'sentOn'            => $sentOn->format(config('format.datetime'))
      ];

      // append user of interest
      switch ($mailCategory)
      {
        // default Mail Category to Inbox
        case Mailbox::None:
        case Mailbox::Inbox:
  
          // there is only one sender
          $sender = '';
          if (auth()->user()->id == $mail->sender->id)
          {
            // sender is me
            $sender = __('Me');
          }
          else
          {
            // sender is someone other than me
            $sender = "{$mail->sender->fname} {$mail->sender->lname}";
          }

          $mailArray[array_key_last($mailArray)]['user.users'] = $sender;
  
          break;
        
        case Mailbox::Sent:

          // there may be many receivers
          $receivers = $this->getMailReceivers($mail);
          $mailArray[array_key_last($mailArray)]['user.users'] = $receivers;
  
          break;
  
      }

      // user of interest appended

    } // foreach mail

    // mail data has been grouped
    
    // SORT: Mail newest first
    $mailArray = array_sort($mailArray, 'sentOn', SORT_DESC);

    // paginator: which page ?
    $pageNo = Paginator::resolveCurrentPage() ?? 1;

    // paginator: how many pages ?
    $perPage = config('mail.paginator.itemsPerPage');

    // data: slice out portion for paginator
    $mailArray = array_slice($mailArray, ($pageNo - 1) * $perPage, $perPage);

    // paginator: instance
    $paginatedMails = new Paginator($mailArray, $perPage, $pageNo, [
      'firstPage' => 1,
      'lastPage'  => (int)ceil(count($mails) / $perPage),
      // Keep this vvv inside view -> links break there
      'path'      => Paginator::resolveCurrentPath()
    ]);

    return $paginatedMails;

  }

  //*****************************************************************************
  private function getMailReceivers($mail) : string
  {
    $receiversString = '';
    $receivers = $mail->receivers;
    for ($i = 0; $i < count($receivers); $i++)
    {
      if (auth()->user()->id == $receivers[$i]->id)
      {
        // sender is me
        $receiversString .= " " . __('Me');
      }
      else
      {
        // sender is someone other than me
        // format: <id>LastName, <id>LastName
        $receiversString .= " <{$receivers[$i]->id}>{$receivers[$i]->lname}";
      }

      if ($i < count($receivers) - 1)
      {
        $receiversString .= ',';
      }

    }

    // shorten receivers list
    return WebString::substr($receiversString, 0, 40, true);

  }

  //*****************************************************************************
  private function retrieveRequestData(Request $request)
  {
    // name: usersString
    $recipients = $request->input('usersString');
    // 0 => "<1> Mieszko Polan Rodzic"
    // 1 => "<2> Bolesław Chrobry Uczeń"

    $recipients = UserPicker::convertToModels($recipients);

    // name: subject
    $title = $request->input('subject');
    // "rickrolled"

    // name: mail
    $body = $request->input('mail');
    // """
    // rickrolled\r\n
    // it is time to say goodbye
    // """

    // name: file0, file1, file2, .., null
    $files = [];
    for ($i = 0; $file = $request->file("file$i"); $i++)
    {
      // $file
      // class UploadedFile
      // Apache stores in /XAMPP/tmp/[here] folder

      if ( ! $file->isValid())
      {
        continue;
      }

      // Get: file himself
      $files[$i]['file'] = $file;

      // Get: file data
      $fileNameExt = ServerDatabaseConversion::getFileName($file);
      $mime = $file->getMimeType();

      $files[$i]['attachmentFileName'] = $fileNameExt;

      // Mime Type
      $files[$i]['mimeType'] = $mime;
    }

    return [
      'recipients'  => $recipients,
      'title'       => $title,
      'body'        => $body,
      'files'       => $files
    ];
  }

  //*****************************************************************************
  private function storeRequestData(array $data) : int
  {
    // "jpg"
    // "png"
    $mail = auth()->user()->sentMails()->create([
      'title'   => $data['title'],
      'body'    => $data['body']
    ]);
    
    foreach ($data['files'] as $file)
    {
      $mail->attachments()->create([
        'attachmentFileName'  => $file['attachmentFileName'],
        'mimeType'            => $file['mimeType']
      ]);

      // $file is wrapper
      $file['file']->storeAs(
        config('path.storage.attachments.saveAsPath'),
        "/{$file['attachmentFileName']}"
      );
    }

    // DB: add mail, add attachments
    $mail->push();
    
    foreach ($data['recipients'] as $receiverWrapper)
    {
      $receiver = $receiverWrapper->first();
      
      // DB: insert new row into pivot table
      $receiver->receivedMails()->attach($mail->id, [
        'isSoftDeleted' => false
      ]);
    }

    return $mail->id;
  }

}
