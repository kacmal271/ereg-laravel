<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Schedule Class - Goals
 * # schedule multiple instances of Lesson in a week
 *   Lesson is related teacher-group-subject
 * # cooperate w/ Lesson::class
 *   Schedule(main) - Lesson(helper)
 */

 namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Schedule extends Model
{
  use HasFactory;
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA
  
  // mass assignable
  protected $fillable = [
    'lesson_id',
    'startTime',
    'endTime',
    'dayName'
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    
  ];
  
  // need to cast
  protected $casts = [
    'startTime'   => 'datetime',    // MySQL: datatype: TIME
    'endTime'     => 'datetime',    // PHP: doesnt have class time
    'created_at'  => 'datetime',    // just use class datetimeimmutable
    'updated_at'  => 'datetime'     // and convert w ->format()
  ];
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTIONS
  
  //*****************************************************************************
  // One Lesson may be Many Times every Week
  public function lesson()
  {
    return $this->belongsTo(Lesson::class);

  }

  //*****************************************************************************
  // STATISTICS
  // n = how many nonattendance(s) on Monday for this particular Group-Subject
  //      does it correlate to Subject ? 
  //      does it correlate to Teacher ?
  // m = mean of nonattendance(s) for Friday and Thursday VS. Monday and Tuesday
  //      is the global day-subject-count distribution non-optimal ?
  // etc
  public function nonattendances()
  {
    return $this->hasMany(Nonattendance::class);

  }

}
