<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * UserPicker Class - Goals
 * # define pop-up searchbox logic
 */

namespace App\Livewire;

use \App\Helper\Enumeration\UserFormat;
use \App\Helper\Filter;
use \App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UserPicker extends Component
{
  ///////////////////////////////////////////////////////////////////////////////
  // FIELD

  public $usersString; // users // (A) view: updates $usersString
  public $searchString;
  public $placeholder;
  public $title;
  public $userFormat;
  public $users;

  private $delim = ';';
  private static $idFormat = '/<(\d+)>/';

  ///////////////////////////////////////////////////////////////////////////////
  // PROPERTY

  public static function getIdFormat()
  {
    return UserPicker::$idFormat;
  }

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTION - BUILTIN

  //***************************************************************************
  public function mount()
  {
    // fetch users
    $users = User::all();
    // remember filtered users
    $this->users = $this->filterUsers($users);
  }

  //***************************************************************************
  public function render()
  {
    return view('livewire.user-picker');
  }

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTION - PUBLIC

  //***************************************************************************
  public function addUser(int $userId)
  {
    $added = $this->normalizeAddedString();
    $adding = strlen($added) > 0 ? "$this->delim " : '';
    foreach ($this->usersString as $userString)
    {
      if ($userString->id == $userId)
      {
        $adding .= $this->formatUser($userString);
        break;
      }
    }

    $this->searchString = $added . $adding;
    $this->usersString = [];
  }

  //***************************************************************************
  public static function convertToModels(string $usersString, bool $removeDupes = true)
  {
    $ids = [];
    preg_match_all(UserPicker::getIdFormat(), $usersString, $ids);
    $ids = $ids[1]; // ids: first fetch group

    // ids shouldnt be empty
    // ids should be asserted in store()

    if ($removeDupes)
    {
      // dont send to one user twice
      $ids = array_unique($ids);
    }
    
    // fetch User:recipients
    $users = [];
    foreach ($ids as $id)
    {
      $user = User::all()->where('id', '=', $id);
      $users[] = $user;
    }

    return $users;
  }

  //***************************************************************************

  /**
   * desc
   *   searchString -> collection -> update users -> view
   */

	public function updatedSearchString() // (A) call bound member function
  {
    $searchString = $this->normalizeSearchString();
    $users = Filter::filterModelsBySearch($this->users, $searchString);
    // update users
    $this->usersString = [];
    foreach ($users as $user)
    {
      // dynamic property: add string user-hint
      $user->userString = $this->formatUser($user, false);
      // attach user model with dynamic property
      $this->usersString[] = $user;
    }
  }

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTION - PRIVATE

  //***************************************************************************
  private function filterUsers(Collection $users)
  {
    switch ($this->userFormat)
    {
      case UserFormat::Generic :
      case UserFormat::Receiver :

        return $users;

      case UserFormat::Student :

        // remove not-students
        foreach ($users as $key => $user)
        {
          if ($user->role->name != config('role.student.name'))
          {
            $users->forget($key);
          }
        }

        // removed not-students

        return $users;
    }

    return new Collection();

  }

  //***************************************************************************

  /**
   * note
   *   abide by private static $idFormat
   */

  private function formatUser(User $user, bool $isDelimited = true) : string
  {
    $formattedUser = '';

    switch ($this->userFormat)
    {
      case UserFormat::Generic :

        $formattedUser = "<{$user->id}> {$user->fname} {$user->lname}";
        break;

      case UserFormat::Student :

        $formattedUser = "<{$user->id}> {$user->fname} {$user->lname} {$user->group->name}";
        break;
      
      case UserFormat::Receiver :

        $formattedUser = "<{$user->id}> {$user->fname} {$user->lname} " .
          __(ucfirst($user->role->name));
          break;
      
      default :

        $formattedUser = __('N/A');
        break;
    }

    if ($isDelimited)
    {
      $formattedUser .= "$this->delim ";
    }
    else
    {
      $formattedUser .= " ";
    }

    return $formattedUser;
    
  }

  //***************************************************************************

  /**
   * desc
   *   input: '1 Mieszko Polon, 2 Boleslaw Chrobry, Wielki'
   *   output: '1 Mieszko Polon, 2 Boleslaw Chrobry'
   */

  private function normalizeAddedString() : string
  {
    // extract all except last element of front-end search string
    $added = substr(
      $this->searchString,
      0,
      strrpos($this->searchString,  $this->delim)
    );

    $added = trim($added);

    return $added;
  }

  //***************************************************************************

  /**
   * desc
   *   input: '1 Mieszko Polon, 2 Boleslaw Chrobry, Wielki'
   *   output: 'Wielki'
   */

  private function normalizeSearchString() : string
  {
    $delimAt = strrpos($this->searchString, $this->delim);
    // assert start is valid index
    // dont start at delim itself
    $start = ! $delimAt ? 0 : $delimAt + 1;

    // extract last element of front-end search string
    $searchString = substr(
      $this->searchString,
      $start
    );

    $searchString = trim($searchString);

    return $searchString;
  }
}
