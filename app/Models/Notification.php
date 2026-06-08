<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Notification Class - Goals
 * # represent crucial school information
 * # cooperate w/ User::class such as Admin
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Notification extends Model
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA
  
  // mass assignable
  protected $fillable = [
    'expires',
    'notification',
    'title'
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    // dont hide 'id'
    // sorting by 'id' = useful
  ];
  
  // need to cast
  protected $casts = [
    'expires' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
  ];
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTIONS
  
  // no need for relations
  // global user access

}
