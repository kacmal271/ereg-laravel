<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * File Class - Goals
 * # coop with FileRule::class
 */

namespace App\Helper\Enumeration;

//-----------------------------------------------------------------------------
enum Status : string
{
  case Error      = 'error';
  case Ok         = 'ok';
  case Warning    = 'warning';
}