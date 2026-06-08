<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
* School Class - Goals
* # Store data about current school
* # Store data about current school year
* # 1 row only
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class School extends Model
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA

  // mass assignable
  protected $fillable = [
    'name',
    'schoolYear',
    'logo',
    'firstDay',
    'lastDay',
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    
  ];
  
  // need to cast server -> database
  // http server: DateTimeImmutable
  // mysql server: date 
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'firstDay' => 'date',
    'lastDay' => 'date',

  ];

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTION

  // No Relations

  //*****************************************************************************
  public function getFirstMonth()
  {
    return $this->firstDay->format('m');
  }

  //*****************************************************************************
  public function getFirstYear()
  {
    return $this->firstDay->format('Y');
  }

  //*****************************************************************************
  public function getLastMonth()
  {
    return $this->lastDay->format('m');
  }

  //*****************************************************************************
  public function getLastYear()
  {
    return $this->lastDay->format('Y');
  }

}
