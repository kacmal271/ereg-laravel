<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Group Class - Goals
 * # represent cross-section x -> Year * Major
 * # represent group of students 
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Group extends Model
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA
  
  // mass assignable
  protected $fillable = [
    'name'
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    
  ];
  
  // automatic datatype casting
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
  ];
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTIONS
  
  //*****************************************************************************
  public function lessons()
  {
    // 1(group) - m(lessons)
    return $this->hasMany(Lesson::class);

  }
  
  //*****************************************************************************
  public function students()
  {
    // 1(group) - m(students)
    // Note: Role teacher not added to Group
    return $this->hasMany(User::class, 'group_id', 'id');
      // ::class, there FK, here PK

  }
  
  //*****************************************************************************
  public function meetings()
  {
    // 1(group) - m(meetings)
    return $this->hasMany(Meeting::class);

  }

}
