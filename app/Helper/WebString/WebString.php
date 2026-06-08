<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * DateTime Class - Goals
 * # extend primitive string functionalities
 * 
 * Note
 * # cannot extend primitive string
 */

namespace App\Helper\WebString;

//-----------------------------------------------------------------------------
class WebString
{

  /////////////////////////////////////////////////////////////////////////////
  // PUBLIC STATIC

	//*****************************************************************************
  
  /**
   * return
   *   is string Alpha and/or Nums and/or Interpunction ?
   * $charCode : int
   *   CharacterType::Alpha : 0b1
   *   CharacterType::Numeric : 0b10
   *   CharacterType::Alpha | CharacterType::Numeric : 0b11
   */

  public static function isAlphaNumInterp(
    string $string,
    int $charCode
  ) : bool
  {
    $string = strtolower($string);
    $string = str_split($string);
    
    // reference: faster
    foreach ($string as &$char)
    {
      if ($charCode & CharacterType::Alpha->value != 0)
      {
        if (ord($char) >= 97 && ord($char) <= 122) // [a-z]
        {
          // is alpha
          continue;
        }
      }

      if ($charCode & CharacterType::Interpunction->value != 0)
      {
        if (ord($char) == 44 || // [,]
            ord($char) == 46)   // [.]
        {
          // is interpunction
          continue;
        }
      }

      if ($charCode & CharacterType::Numeric->value != 0)
      {
        if (ord($char) >= 48 && ord($char) <= 57) // [0-9]
        {
          // is numeric
          continue;
        }
      }

      if ($charCode & CharacterType::Parenthesis->value != 0)
      {
        if (ord($char) == 40 || // [(]
            ord($char) == 41)   // [)]
        {
          // is parenthesis
          continue;
        }
      }

      return false;
    }

    return true;

  }

  //*****************************************************************************

  /**
   * desc
   *   
   *   input: '\nvillain'
   *   output: true
   *   
   *   input: '\t'
   *   output: true
   *   
   *   input: 'villain\n'
   *   output: false
   *   
   *   input: ''
   *   output: false
   */

  public static function isWhiteChar(string $string) : bool
  {
    if (strlen($string) <= 0)
    {
      return false;
    }

    $string = ord($string[0]);

    return  $string == 0 || // NULL
            $string == 9 || // HORIZONTAL TAB
            $string == 10 || // LINE FEED
            $string == 11 || // VERTICAL TAB
            $string == 13 || // CR
            $string == 32;
  }

  //*****************************************************************************

  /**
   * desc
   *   input: 'See how dark\t\t your mind is\n'
   *   output: 'Seehowdarkyourmindis'
   */

  public static function stripWhiteChars($string)
  {
    $reduced = '';
    for ($i = 0; $i < strlen($string); $i++)
    {
      if ( ! WebString::isWhiteChar($string[$i]))
      {
        $reduced .= $string[$i];
      }
    }

    return $reduced;
  }

  //*****************************************************************************

  /**
   * desc
   *   input: 'very long string doesnt fit'
   *   output: 'very long string do'
   *   output: 'very long string do...'
   */

  public static function substr(
    string $string,
    int $from,
    int $howMany,
    $isEllipsis = false)
  {
    $string = substr($string, $from);
    $reduced = substr($string, 0, $howMany);
    if ($isEllipsis)
    {
      if (strlen($string) > $howMany)
      {
        $reduced .= '...';
      }
    }

    return $reduced;
  }

  /////////////////////////////////////////////////////////////////////////////
  // PUBLIC

  //*****************************************************************************

  public function __construct(string $value = '')
  {
    $this->string = $value;
    
  }

  /////////////////////////////////////////////////////////////////////////////
  // PRIVATE

  private string $string;

      public function get() : string
      {
        return $this->string;
      }

      public function set(string $value) : void
      {
        $this->string = $value;
      }

}