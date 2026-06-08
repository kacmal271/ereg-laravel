<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Lesson Class - Goals
 * # Relate 1 teacher - 1 group - 1 subject
 * # Cooperate w/ Schedule::class
 *   Lesson(helper) - Schedule(main)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Lesson extends Model
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA
  
  // mass assignable
  protected $fillable = [
    'user_id',
    'group_id',
    'subject_id'
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
  public function subject()
  {
    return $this->belongsTo(Subject::class);

  }
  
  //*****************************************************************************
  public function group()
  {
    return $this->belongsTo(Group::class);

  }
  
  //*****************************************************************************
  public function teacher()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');

  }
  
  //*****************************************************************************
  // / szedżjul / 
  public function schedules()
  {
    /**
     * lesson 1 - schedule m
     * same lesson may occur many times in a week
     */
    return $this->hasMany(Schedule::class);

  }

}
