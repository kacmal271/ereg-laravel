<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * SchoolFeature Class - Goals
 * # define School Feature concepts
 */

namespace App\Helper\Enumeration;

//-----------------------------------------------------------------------------
enum SchoolFeature : string
{
  case None       = 'nothing';
  case Group      = 'group';        // 1A | 2A
  case Subgroup   = 'subgroup';     // English B1 | English B2
  case Subject    = 'subject';
  case Grade      = 'grade';

}