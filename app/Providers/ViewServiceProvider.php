<?php

namespace App\Providers;

use App\View\Composers\AppComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
  /**
  * Register services.
  */
  public function register(): void
  {
    //
  }
  
  /**
  * Bootstrap services.
  */
  public function boot(): void
  {
    // APP COMPOSER: Share Variables: $logo
		Facades\View::composer('*', AppComposer::class);
  }
}
