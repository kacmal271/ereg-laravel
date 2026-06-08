<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
* User Class - Goals
* # represent physical person at school
* # respresent parent, student, admin, teacher
* # cooperator w/ Role::class
* 
* Table of Contents
* # LARAVEL: MODEL EVENT AKA MODEL LIFECYCLE
* # PHP: OVERLOADING
* # LARAVEL: SESSION MEMBER DATA
*/

namespace App\Models;

use \App\Helper\Interface\ISearchStringFiltering;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use \App\Helper\WebString\WebString;
use \App\Helper\Translator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

//-----------------------------------------------------------------------------
class User  extends Authenticatable
            implements ISearchStringFiltering, MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable;

  ///////////////////////////////////////////////////////////////////////////////
  // DATA: PROTECTED, keep member data up top
  
  // make all member data mass assignable
  // protected $guarded = [];
  
  // mass assignable
  protected $fillable = [
    'fname',
    'lname',
    'email',
    'lastLogIn',
    'picturePath',
    'group_id',
    'role_id',
    'password'
    
  ];
  
  // dont serialize these attributes
  // when you return JsonResponce::class
  protected $hidden = [
    'password',
    'remember_token'
  ];
  
  // need to cast
  protected $casts = [
    'password' => 'hashed',
    'email_verified_at' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
  ];

  ///////////////////////////////////////////////////////////////////////////////
  // PUBLIC: STATIC

  //*****************************************************************************
  public static function boot()
  {
    // PARENT init

    parent::boot();
    
    // LARAVEL: MODEL EVENT AKA MODEL LIFECYCLE
    // ALT: put make session(...) function in getter when key missing()
    static::retrieved(function ($user)
    {
      // Remember: PHP doesnt allow lambdas to access to external scope
      // Remember: this block of code {} is NOT User::Model

      if (isset($GLOBALS['isRecursiveCall'])) // (A) prevent infinite recursion
        return;

      $GLOBALS['isRecursiveCall'] = true; // (A) prevent infinite recursion

      if ($user == auth()->user())
      // user logged in

        if (auth()->user()->role->name == config('role.parent.name'))
        // user logged in is parent
          
          if (auth()->user()->children->isNotEmpty())
          // parent has children assigned (as should be)

            if (session()->missing('User.childId'))
              // set session child id for future reference
              session(['User.childId' => auth()->user()->children[0]->id]);

      unset($GLOBALS['isRecursiveCall']); // (A) prevent infinite recursion

    });

  }

  /**
   * function students
   */

  public static function students() : Collection
  {
    $students = User::all();
    $studentsRole = Role::all();
    $studentsRole = $studentsRole->where('code', '=', config('role.student.code'));

    $students = $students->where('role_id', '=', $studentsRole->first()->id);

    return $students;
  }

  ///////////////////////////////////////////////////////////////////////////////
  // PUBLIC: AUTOMATIC

  //*****************************************************************************
  
  /**
   * interface MustVerifyEmail
   */

  public function getEmailForVerification() : string
  {
    return $this->email;
  }

  //*****************************************************************************
  
  /**
   * interface MustVerifyEmail
   */

  public function sendEmailVerificationNotification() : void
  {
    parent::sendEmailVerificationNotification();
  }

  //*****************************************************************************
  
  /**
   * interface MustVerifyEmail
   */

  public function markEmailAsVerified() : bool
  {
    return parent::markEmailAsVerified();
  }

  //*****************************************************************************
  
  /**
   * interface MustVerifyEmail
   */

  public function hasVerifiedEmail() : bool
  {
    return $this->email_verified_at == null ? false : true;
  }
  
  //*****************************************************************************
  // PHP: OVERLOADING
  public function ChildId(... $arguments)
  {
    switch (count($arguments))
    {
      case 0 :
        return $this->ChildId0();
        break;
      
      case 1 :
        return $this->ChildId1($arguments[0]);
        break;
      
      default :
        return null;
        break;

    }

  }
  
  //*****************************************************************************
  public function getSearchHaystack() : string
  {
    $searchHaystack =
      $this->id           . ' ' .
      $this->fname        . ' ' .
      $this->lname        . ' ' .
      ucfirst($this->role->name);

    $searchHaystack = Translator::translate($searchHaystack);
    // (A) case-insensitive
    $searchHaystack = strtolower($searchHaystack);

    return WebString::stripWhiteChars($searchHaystack);

  }

  //*****************************************************************************
  public function grades()
  {
    return $this->hasMany(Grade::class);
    
  }

  //*****************************************************************************
  public function sentMails()
  {
    // 1(user) - m(mails)
    // explicit foreign key declaration
    return $this->hasMany(Mail::class);
    
  }
  
  //*****************************************************************************
  public function receivedMails()
  {
    // explicit name declaration(s)
    $receivedMails = $this->belongsToMany(Mail::class, 'mail_user', 'user_id', 'mail_id')
      // is mail[i] soft deleted FOR THIS USER
      ->withPivot(['isSoftDeleted', 'created_at'])
      ->where('isSoftDeleted', '=', false);

    return $receivedMails;
    
  }
  
  //*****************************************************************************
  public function praises()
  {
    if ($this->role->name == config('role.student.name'))
      return $this->hasMany(Praise::class, 'studentId', 'id');
    
    if ($this->role->name == config('role.parent.name'))
    {
      if ($this->ChildId() == null) // is child selected ?
        return null;
      
      $myChildren = $this->children();
      $myChild = $myChildren::where('id', 'like', $this->ChildId())->get(); // return selected child
      return $myChild->praises->hasMany(Praise::class, 'studentId', 'id');
      
    }

    if ($this->role->name == config('role.teacher.name'))
      return $this->hasMany(Praise::class, 'teacherId', 'id');
    
    return null;
    
  }
  
  //*****************************************************************************
  // Child accesses Parents
  public function parents()
  {
    if ($this->role->name == config('role.student.name'))
      // this is student
      // relate to parent
      // as studentId (me)
      // by parentId
      return $this->belongsToMany(User::class, 'parent_student', 'studentId', 'parentId');
    
    return null;
    
  }
  
  //*****************************************************************************
  // Parent accesses Children
  public function children()
  {
    // this is student
    // relate to parent
    // as studentId (me)
    // by parentId
    if ($this->role->name == config('role.parent.name'))
    {
      return $this->belongsToMany(
        User::class,
        'parent_student',
        'parentId',
        'studentId'
      );
    }
    
    return null;
    
  }
  
  //*****************************************************************************
  public function meetings()
  {
    if ($this->role->name == config('role.teacher.name'))
      return $this->hasMany(Meeting::class, 'user_id', 'id');
    
    if ($this->role->name == config('role.parent.name'))
    {
      // Login -> SESSION stores User.childId
      // ∵ Parent clicked button w/ User.childId

      if ($this->ChildId() == null)
        return null;
      
      $myChildren = $this->children;
      $myChild = $myChildren->where('id', 'like', $this->ChildId())->first();

      return $myChild->group->hasMany(Meeting::class);
      
    }
    
    return null;
    
  }
  
  //*****************************************************************************
  // Teacher has Lessons
  // Student has Group has Lessons
  public function lessons()
  {
    if ($this->role->name == config('role.teacher.name'))
      return $this->hasMany(Lesson::class, 'user_id', 'id');
    
    return null;
    
  }
  
  //*****************************************************************************
  public function nonattendances()
  {
    if ($this->role->name == config('role.student.name'))
      /**
      * config()
      * global function
      * define in AppServiceProvider.php
      */
      return $this->hasMany(Nonattendance::class);
    
    return null;
    
  }
  
  //*****************************************************************************
  public function group()
  {
    if ($this->role->name == config('role.student.name'))
      /**
      * config()
      * global function
      * define in AppServiceProvider.php
      */
      return $this->belongsTo(Group::class, 'group_id', 'id');
        // ::class, here FK, there PK
    
    return null;
    
  }
  
  //*****************************************************************************

  /**
   * return
   *   Collection or null
   *   NOT relationship
   */

  public function groups() : ?Collection
  {
    if ($this->role->code == config('role.teacher.code'))
    {
      /**
       * config()
       * global function
       * define in AppServiceProvider.php
       */

      $groups = new Collection();

      foreach ($this->lessons()->get() as $lesson)
      {
        $group = $lesson->group()->get()->first();
        if ( ! $groups->contains($group))
        {
          $groups->add($group);
        }
      }
      
      return $groups;
    }
    
    return null;
    
  }
  
  //*****************************************************************************
  public function role()
  {
    return $this->belongsTo(Role::class, 'role_id', 'id');
    
  }

  ///////////////////////////////////////////////////////////////////////////////
  // PRIVATE: AUTOMATIC
      
  //*****************************************************************************
  // getter (by value)
  private function ChildId0()
  {
    // LARAVEL: SESSION MEMBER DATA
    return session('User.childId', null);
    
  }
  
  //*****************************************************************************
  // setter
  private function ChildId1($childId)
  {
    return session(['User.childId' => $childId]);
    
  }
  
}
    