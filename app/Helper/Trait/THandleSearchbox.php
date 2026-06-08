<?php

namespace App\Helper\Trait;

use \App\Helper\Filter;

//-----------------------------------------------------------------------------
trait THandleSearchbox
{
  //*****************************************************************************
  private function getSearch()
  {
    $search = request()->input('search');
    $search = $search == '' ? null : $search;

    return $search;
  }

  //*****************************************************************************
  private function handleSearchbox($models)
  {
    // receive search query
    $search = $this->getSearch();
    
    // filter mails by user search
    if ($search != null)
    {
      $models = Filter::filterModelsBySearch($models, $search);
    }

    return $models;
  }
}