<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
// USER REPRESENTS PERSON AT SCHOOL
class Nonattendance extends Model
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA

  // able to be assigned w Model::fill()
  protected $fillable = [
    'user_id',
    'isExcused',
    'schedule_id',
    'nonattendanceWhen',
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    
  ];
  
  // need to cast
  protected $casts = [
    'isExcused' => 'bool',
    'nonattendanceWhen' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
    
  ];
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTIONS

  //*****************************************************************************
  public function student()
  {
    // Nonattendance.user_id is always student_id
    // nobody else is appended to this table
    return $this->hasOne(User::class); // has one Student

  }

  //*****************************************************************************
  public function schedule()
  {
    return $this->belongsTo(Schedule::class);

  }

}
