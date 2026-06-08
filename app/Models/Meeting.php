<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Meeting Class - Goals
 * # 
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Meeting extends Model
{
  use HasFactory;
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA
  
  // mass assignable
  protected $fillable = [
    'user_id',
    'group_id',
    'startTime',
    'endTime',
    'meetingName',
    'meetingDescription'
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    
  ];
  
  // need to cast
  protected $casts = [
    // datetime avails usage of timezones
    'startTime'     => 'datetime',
    'endTime'       => 'datetime',
    'created_at'    => 'datetime',
    'updated_at'    => 'datetime'
  ];
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTIONS
  
  //*****************************************************************************
  public function group()
  {
    // Meetings m -> 1 Group
    return $this->belongsTo(Group::class);

  }
  
  //*****************************************************************************
  public function teacher()
  {
    // Meetings m -> 1 User
    return $this->belongsTo(User::class, 'user_id', 'id');

  }

}
