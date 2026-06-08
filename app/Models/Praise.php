<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Praise Class - Goals
 * # represent student's praise or notice
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Praise extends Model
{
  use HasFactory;
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA
  
  // mass assignable
  protected $fillable = [
    'studentId',
    'teacherId',
    'title',
    'description',
    'isNotice'
    
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
  public function teacher()
  {
    // Match Praise::teacherId to User::id 
    return $this->belongsTo(User::class, 'teacherId', 'id');

  }
  
  //*****************************************************************************
  public function student()
  {
    // Match Praise::studentId to User::id 
    return $this->belongsTo(User::class, 'studentId', 'id');

  }

}
