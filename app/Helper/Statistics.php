<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Statistics Class - Goals
 * # define function(s) for statistics computation
 */

namespace App\Helper;

//-----------------------------------------------------------------------------
class Statistics
{
  
	//*****************************************************************************
	// MEAN
	public static function mean(array $numbers, int $i = 0) : float
  {
    // Exception Handling
    if (count($numbers) == 0)
      return 0.0;

    return  $i < count($numbers) ?

            $numbers[$i] / (count($numbers) * 1.0) + Statistics::mean($numbers, ++$i) :

            0;

  }
  
	//*****************************************************************************
	// MEAN WEIGHTED
	public static function meanWeighted(
    array $numbers, array $weights, int $i = 0
  ) : float
  {
    // Exception Handling
    if (count($numbers) == 0)
      return 0.0;
    
    $numerator = 0;
    $denominator = 0;

    for ($i = 0; $i < count($numbers); $i++)
    {
      $numerator += $numbers[$i] * $weights[$i];
      $denominator += $weights[$i];

    }

    return $numerator / ($denominator * 1.0);

  }
	
	
}