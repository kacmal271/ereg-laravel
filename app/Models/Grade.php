<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
* Grade Class - Goals
* # Represent a single student grade
* # cooperate w/ Assessment.php
* # cooperate w/ User.php
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Grade extends Model
{
  use HasFactory;
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA

  // mass assignable
  protected $fillable = [
    'grade'
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    
  ];
  
  // automatic datatype casting
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',

  ];
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTION

  //*****************************************************************************
  // m (Grade) - 1 (Subject)
  public function subject()
  {
    return $this->belongsTo(Subject::class, 'subject_id', 'id');

  }

  //*****************************************************************************
  public function assessment()
  {
    return $this->belongsTo(Assessment::class);

  }

  //*****************************************************************************
  public function user()
  {
    return $this->belongsTo(User::class);

  }

}
