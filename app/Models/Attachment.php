<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Class Attachment - Goals
 * # store information about 1 attachment
 * # cooperate w/ Mail::class
 * 
 * One Mail can have Many Attachments
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//-----------------------------------------------------------------------------
class Attachment extends Model
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////////////////////
  // MEMBER DATA

  // mass assignable
  protected $fillable = [
    'attachmentFileName',
    'mimeType'
    
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

  public function mail()
  {
    return $this->belongsTo(Attachment::class);

  }

}
