<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * DateTime Class - Goals
 * # help WebString::class
 */

namespace App\Helper\WebString;

enum CharacterType : int
{
    case Alpha = 0b1;
    case Numeric = 0b10;
    case Interpunction = 0b100;
    case Parenthesis = 0b1000;
}