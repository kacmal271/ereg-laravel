<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Filter Class - Goals
 * # 
 * 
 * Table of Contents
 * # 
 */

namespace App\Helper;

use \App\Helper\WebString\WebString;
use Illuminate\Database\Eloquent\Collection;

//-----------------------------------------------------------------------------
class Filter
{
  //*****************************************************************************

  /**
   * desc
   *   case-insensitive
   * Collection $mails
   *   Illuminate\Database\Eloquent\Collection
   * return
   *   Illuminate\Database\Eloquent\Collection
   */

  public static function filterModelsBySearch(
    Collection $models,
    string $search
  ) : Collection
  {
    if ($search == null || $search == '')
    {
      return $models;
    }

    $filtered = new Collection();

    $search = Translator::translate($search);
    $search = strtolower($search);
    $search = WebString::stripWhiteChars($search);

    foreach ($models as $model)
    {
      $searchHaystack = $model->getSearchHaystack();
      
      if (preg_match("/$search/", $searchHaystack))
      {
        $filtered->add($model);
      }

    }

    return $filtered;

  }
	
}