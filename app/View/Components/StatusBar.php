<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This Class - Note
 * # internally uses session('status')
 */

namespace App\View\Components;

use \App\Helper\Enumeration\Status;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBar extends Component
{
  //*****************************************************************************

  /**
   * Create a new component instance.
   */

  public function __construct(
    // default values arent required
    // in Laravel View to pass to Blade view
    public string $backgroundColor = '',
    public bool $isVisible = true,
    public string $message = ''
  )
  {
    $status = session('status', null);

    // is status bar visible
    $this->isVisible = $status == null ? false : true;

    // is status a failure or success
    switch ($status)
    {
      case Status::Ok :
        // BiWork.css class
        $this->backgroundColor = 'background-ok';
        $this->message = __('Success');
        break;
        
      case Status::Warning :
        // BiWork.css class
        $this->backgroundColor = 'background-warning';
        $this->message = __('Warning');
        break;
        
      case Status::Error :
        // BiWork.css class
        $this->backgroundColor = 'background-error';
        $this->message = __('Failure, You can try again');
        break;
      
      default:
        $this->backgroundColor = '';
        $this->message = __('');
        
    }

  }
  
  //*****************************************************************************

  /**
   * Get the view / contents that represent the component.
   */

  public function render(): View|Closure|string
  {
    return view('components.status-bar');
  }

  //*****************************************************************************

  /**
   * desc
   *   display status bar conditionally
   */

  public function shouldRender() : bool
  {
    // initialize in constructor
    return $this->isVisible;
  }

}
