<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * TimePeriod Class - Goals
 * # define Time Period concept
 * # (!) define In Seconds
 */

namespace App\Helper\Enumeration;

//-----------------------------------------------------------------------------
enum TimePeriod : int
{
  case None       = 0;
  case Second     = 1;
  case Minute     = 60;
  case Hour       = 3600;
  case Day        = 86400;
  case Week       = 604800;
  case Fortnight  = 1209600;
  // case Month      = 2419200;        // WHICH ?
  // case Quartile   = 7257600;        // WHICH ?
  case Year       = 31536000;
  case Decade     = 315360000;

}