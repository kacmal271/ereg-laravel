<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
* Role Class - Goals
* # Cooperate w/ User::class
* # School role identification string
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Role extends Model
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
  
  // need to cast
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',

  ];

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTION: PUBLIC

  //*****************************************************************************
  public static function codeToId($code)
  {
    return Role::all()->where('code', '=', $code)->first()->id;
  }

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTION: RELATIONS

  //*****************************************************************************
  public function users()
  {
    return $this->hasMany(User::class);
  }

}
