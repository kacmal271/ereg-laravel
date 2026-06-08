<?php

namespace App\View\Composers;

use \App\Models\School;
use Illuminate\View\View;

class AppComposer
{
  //*****************************************************************************
  public function compose(View $view) : void
	{
		$image = School::all()->first()->logo;

    if ($image == null)
    {
      $image = url('/svg/logo-ereg.svg');
    }
    else
    {
      $image = config('path.storage.logo.urlPath') . $image;
    }
			
		$view->with('logo', $image);
			// any.blade.php has $featuredImage
				// AnyController doesnt know about it :C
				// however it shrinks AnyController in size
	}
}