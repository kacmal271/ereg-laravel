<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * UserFormat Enum - Goals
 * # cooperate with UserPicker Class
 */

 namespace App\Helper\Enumeration;

 //-----------------------------------------------------------------------------
enum UserFormat : string
{
  case Generic = 'generic';
  case Receiver = 'receiver';
  case Student = 'student';
}