<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Mailbox Class - Goals
 * # define Mailbox concept
 */

namespace App\Helper\Enumeration;

//-----------------------------------------------------------------------------
enum Mailbox : string
{
  case None       = 'none';
  case Inbox      = 'inbox';
  case Sent       = 'sent';

}