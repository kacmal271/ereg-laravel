<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Sanitization Class - Goals
 * # 
 * 
 * Table of Contents
 * # 
 */

namespace App\Helper;

use App\Helper\Webstring\CharacterType;
use App\Helper\Webstring\WebString;
use InvalidArgumentException;

//-----------------------------------------------------------------------------
class Sanitization
{

  ///////////////////////////////////////////////////////////////////////////////
  // PUBLIC: STATIC

	//*****************************************************************************

  /**
   * desc
   *   return null if string empty or trim string
   * example
   *   input: ' <1> William Carter'
   *   output: '<1> William Carter'
   * 
   *   input: ''
   *   output: null
   */

  public static function normalize(mixed $data) : mixed
  {
    switch (gettype($data))
    {
      case "array" :

        return Sanitization::normalize__Fa($data);
        break;

      case "string" :

        return Sanitization::normalize__Fs($data);
        break;

      default :

        throw new InvalidArgumentException("allowed:array|string");
    }

  }
	//*****************************************************************************

  /**
   * desc
   *   remove special characters from string
   *   keep alphanums only
   * example
   *   input: 'Ab1_-<?php'
   *   output: 'Ab1php'
   * 
   *   input: ['Ab1_-<?php', 'My5ql_#--drop table']
   *   output: ['Ab1php', 'Myqldrop table']
   */

	public static function removeSpecial(mixed $data, bool $removeSpace = false) : mixed
  {
    switch (gettype($data))
    {
      case "array" :

        return Sanitization::removeSpecial__Fa($data, $removeSpace);
        break;

      case "string" :

        return Sanitization::removeSpecial__Fs($data, $removeSpace);
        break;

      default :

        throw new InvalidArgumentException("allowed:array|string");
    }

  }

	//*****************************************************************************
  public static function sanitizeInput($input) : string
  {
    $input = trim($input);
    $input = htmlspecialchars($input);

    return $input;

  }

  ///////////////////////////////////////////////////////////////////////////////
  // PRIVATE: STATIC

	//*****************************************************************************
	private static function normalize__Fa(mixed $data) : mixed
  {
    foreach ($data as &$string)
    {
      $string = Sanitization::normalize__Fs($string);
    }

    return $data;

  }

	//*****************************************************************************
	private static function normalize__Fs(string $string) : ?string
  {
    if ($string == '')
    {
      return null;
    }

    return trim($string);

  }

	//*****************************************************************************
	private static function removeSpecial__Fa(array $data, bool $removeSpace) : array
  {
    foreach ($data as &$string)
    {
      $string = Sanitization::removeSpecial__Fa($string, $removeSpace);
    }

    return $data;

  }

	//*****************************************************************************
	private static function removeSpecial__Fs(string $data, bool $removeSpace) : string
  {
    $data = strtolower($data);
    $data = str_split($data);

    for ($i = 0; $i < count($data); $i++)
    {
      if ($removeSpace && ord($data[$i]) == 32)
      {
        continue;
      }

      if ( ! WebString::isAlphaNumInterp(
        $data[$i],
        CharacterType::Alpha->value | CharacterType::Numeric->value)
      )
      {
        $data = array_splice($data, $i, 1); // (!) updates for condition
      }
    }

    return implode('', $data);

  }
	
}