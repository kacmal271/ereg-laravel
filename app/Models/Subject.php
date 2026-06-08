<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Subject Class - Goals
 * # represent abstract school subject (being taught)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Subject extends Model
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA
  
  // can set properties in fill() member function
  protected $fillable = [
    'abbreviation',
    'subjectName'
    
  ];
  
  // dont serialize
  protected $hidden = [
    
  ];
  
  // dont serialize these attributes
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
  ];
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTIONS

  //*****************************************************************************
  // 1 (Subject) - m (Grade)
  // then I can look for specific User ...
  public function grades()
  {
    return $this->hasMany(Grade::class, 'subject_id', 'id');

  }
  
  //*****************************************************************************
  public function lessons()
  {
    // 1(subject) - m(lessons)
    return $this->hasMany(Lesson::class);

  }

}
