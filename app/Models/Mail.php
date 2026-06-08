<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
* Mail Class - Goals
* # provide member function sender()     - who the sender is ?
* # provide member function receivers()  - who the receivers are ?
*/

namespace App\Models;

use \App\Helper\Interface\ISearchStringFiltering;

use \App\Helper\WebString\WebString;
use \App\Helper\Translator;
use \App\Helper\Extended\DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
// SINGLE MAIL TITLE AND BODY
class Mail extends Model implements ISearchStringFiltering
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA

  // mass assignable
  protected $fillable = [
    'title',
    'body'
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    
  ];
  
  // need to cast
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime'

  ];

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTIONS

  //*****************************************************************************
  public function attachments()
  {
    return $this->hasMany(Attachment::class);

  }

  //*****************************************************************************

  /**
   * desc
   *   output: 'Email Title'
   */

  public function getSearchHaystack() : string
  {
    $deliveryDate = $this->mailDeliveryDate();
    $deliveryDate = DateTime::relativeDate($deliveryDate);

    $searchHaystack =
      $this->title                    . ' ' . // Translator::class requirement
      $this->body                     . ' ' .
      $deliveryDate                   . ' ' .
      $this->sender->id               . ' ' .
      $this->sender->fname            . ' ' .
      $this->sender->lname            . ' ' .
      ($mail->sender->email ?? '')    . ' ' .
      $this->sender->role->name;
      
    $searchHaystack = Translator::translate($searchHaystack);
    $searchHaystack = strtolower($searchHaystack);

    return WebString::stripWhiteChars($searchHaystack);

  }

  //*****************************************************************************

  /**
   * return
   *   Illuminate\Support\Carbon
   *   aka Data Wrapper
   */

  public function mailDeliveryDate() : \Illuminate\Support\Carbon
  {
    $deliveryDate = new \Illuminate\Support\Carbon();

    foreach ($this->receivers()->get() as $receiver)
    {
      // sent on, to each receiver, on the same day 
      // date when Mail sent, not when created
      $deliveryDate = $receiver->pivot->created_at;
      break;
    }

    return $deliveryDate;

  }

  //*****************************************************************************
  public function receivers()
  {
    // m(mails) - m(users)
    return $this->belongsToMany(User::class)
                // is mail[i] soft deleted BY THIS USER
                ->withPivot(['isSoftDeleted', 'created_at']);

  }

  //*****************************************************************************
  public function sender()
  {
    // m(mails) - 1(user)
    return $this->belongsTo(User::class, 'user_id', 'id');

  }

}
