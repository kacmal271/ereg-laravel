<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * SPL File - Goals
 * # extend Standard PHP Library
 */

//*****************************************************************************
function isAnyNull(array $array)
{
  // is null ?

  if ($array == null)
    return true;
  
  // is any null ?

  foreach ($array as $elem)
    if ($elem == null)
      return true;
  
  return false;

}

//*****************************************************************************
function isAllNull(array $array)
{
  // is null ?

  if ($array == null)
    return true;
  
  // is all null ?

  foreach ($array as $elem)
    if ($elem != null)
      return false;
  
  return true;

}

//*****************************************************************************

/**
 * desc
 *   filter key-value 1D array by key by value
 * return
 *   filterd array
 */

function array_filter_1D($array, $key, $value)
{
  $filtered = [];

  foreach ($array as $myKey => $myValue)
  {
    if ($key == $myKey)
    {
      if ($value == $myValue)
      {
        $filtered[] = $array[$key];
      }
    }
  }

  return $filtered;

}

//*****************************************************************************

/**
 * author
 *   https://www.php.net/manual/en/function.sort.php#99419
 * desc
 *   maintains association of key => value after sorting
 *   equal key => value pairs remain original order
 * $order
 *   SORT_ASC | SORT_DESC
 * return
 *   sorted array
 */

function array_sort($array, $key, $order = SORT_ASC)
{
  $new_array = [];
  $sortable_array = [];
  if (count($array) > 0)
  {
    foreach ($array as $outerKey => $outerValue)
    {
      if (is_array($outerValue))
      {
        foreach ($outerValue as $innerKey => $innerValue)
        {
          if ($innerKey == $key)
          {
            $sortable_array[$outerKey] = $innerValue;
          }
        }
      }
      else
      {
        $sortable_array[$outerKey] = $outerValue;
      }

    }

    switch ($order)
    {
      case SORT_ASC:
        asort($sortable_array);
        break;

      case SORT_DESC:
        arsort($sortable_array);
        break;

    }

    foreach ($sortable_array as $myKey => $value)
    {
      $new_array[$myKey] = $array[$myKey];
    }

  }

  return $new_array;

}

//*****************************************************************************

/**
 * author
 *   php.net/manual/en/function.round.php#114573
 */

function round_up($number, $precision = 2)
{
    $orderOfMagnitude = (int) str_pad('1', $precision, '0');
    return (ceil($number * $orderOfMagnitude) / $orderOfMagnitude);
}

//*****************************************************************************

/**
* author
*   php.net/manual/en/function.round.php#114573
*/

function round_down($number, $precision = 2)
{
    $orderOfMagnitude = (int) str_pad('1', $precision, '0');
    return (floor($number * $orderOfMagnitude) / $orderOfMagnitude);
}