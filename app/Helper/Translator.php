<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Translator Class - Goals
 * # define function(s) translating compound string
 * # extend Laravel
 */

namespace App\Helper;

use \App\Helper\WebString\CharacterType;
use \App\Helper\WebString\WebString;

//-----------------------------------------------------------------------------
class Translator
{

	//*****************************************************************************

  /**
   * description
   *   input: string "Month Year"
   *   output: string "Miesiąc Rok"
   */

  public static function translate(string $text, bool $toLower = false) : string
	{
		$textArray = explode(' ', $text, PHP_INT_MAX);
    $textArrayTranslated = [];
    foreach ($textArray as $myText)
    {
      $flag = CharacterType::Alpha->value |
              CharacterType::Numeric->value |
              CharacterType::Interpunction->value |
              CharacterType::Parenthesis->value;
      if (WebString::isAlphaNumInterp($myText, $flag))
      {
        // Assert: Laravel likes breaking parsing special characters &lt; &gt;
        $textArrayTranslated[] = __($myText);
      }
      else
      {
        $textArrayTranslated[] = $myText;
      }
    }

    $textTranslated = implode(' ', $textArrayTranslated);
    $textTranslated = $toLower ? strtolower($textTranslated) : $textTranslated;
		
		return $textTranslated;
		
	}
	
}