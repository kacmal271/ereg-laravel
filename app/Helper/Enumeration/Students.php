<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Students Class - Goals
 * # define Students Groups concept
 */

namespace App\Helper\Enumeration;

//-----------------------------------------------------------------------------
enum Students : string
{
  case None       = 'nobody';
  case Student    = 'student';  // one person
  case Subgroup   = 'group';    // one group of students
  case Group      = 'class';    // case Class forbidden
                                // one class of groups
  case Year       = 'year';     // one year of classes
  case School     = 'school';   // students of all years

}