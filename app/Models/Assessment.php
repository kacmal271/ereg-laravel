<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
// ASSESSMENT = Shortest of value 1, group 1A, on day XX-XX-XXXX
// ASSESSMENT = Exam of value 6, group 2B, on day YY-YY-YYYY
class Assessment extends Model
{
  use HasFactory;
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA
  
  // mass assignable
  protected $fillable = [
    'name',
    'value'
    
  ];
  
  // dont serialize these attributes
  protected $hidden = [
    
  ];
  
  // automatic datatype casting
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
  ];
  
  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTIONS
  
  //*****************************************************************************
  public function grades()
  {
    return $this->hasMany(Grade::class, 'assessment_id', 'id');
    
  }
  
}
