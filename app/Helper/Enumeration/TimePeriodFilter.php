<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Mailbox Class - Goals
 * # coop w Extended/DateTime
 */

namespace App\Helper\Enumeration;

//-----------------------------------------------------------------------------
enum TimePeriodFilter
{
  case EvenDays;
  case OddDays;
  case WeekDays;
  case WeekendDays;

}