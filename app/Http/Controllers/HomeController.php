<?php

namespace App\Http\Controllers;

use App\Helper\Enumeration\TimePeriod;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

  //*****************************************************************************

  /**
   * Must but logged in
   * No need for: Authorization Policies
   */
  
  public function __construct()
  {
    $this->middleware('auth');

  }
  
  //*****************************************************************************
  /**
  * Redirect User-Role to proper View
  *
  * @return \Illuminate\Contracts\Support\Renderable
  */
  public function index()
  {
    // redirect to landing page
    $landing = '';
    switch (auth()->user()->role->name)
    {
      case config('role.parent.name') :

        // parent: cannot exist w/o children
        $childId = session('User.childId');
        
        // show grades, not barchart
        $landing = "/user/$childId/grades/0";
        break;

      case config('role.student.name') :

        $id = auth()->user()->id;

        // show grades, not barchart
        $landing = "/user/$id/grades/0";
        break;

      case config('role.admin.name') :

        $landing = '/notification/create';
        break;

      case config('role.teacher.name') :

        $landing = "/nonattendance/create/period/" . TimePeriod::None->value;
        break;

    }

    return redirect($landing);

  }

}
        