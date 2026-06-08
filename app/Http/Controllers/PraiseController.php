<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * PraiseController::class - Goals
 * # 
 */

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \App\Models\Praise;
use \App\Models\Group;
use \App\Models\User;
use \App\Helper\Enumeration\Status;
use \App\Helper\Enumeration\Students;
use App\Helper\ServerDatabaseConversion;

//-----------------------------------------------------------------------------
class PraiseController extends Controller
{
  /////////////////////////////////////////////////////////////////////////////
  // PUBLIC: AUTOMATIC

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
   * desc
   *   show all user -> praises / notices
   * auth
   *   guard PraisePolicy::viewAny
   */

  public function index(int $userId)
  {
    $user = User::findOrFail($userId);

    $this->authorize('viewAny', [Praise::class, $user]);

    $praises = Praise::all()->where('studentId', '=', $userId);

    // markup new lines
    // change '\r\n' -> '<br>'
    foreach ($praises as &$praise)
    {
      $praise->title = ServerDatabaseConversion::markupNewlines($praise->title);
      $praise->description = ServerDatabaseConversion::markupNewlines($praise->description);
    }

    return view('Access.Praise.index', [
      // parent select bar
      'user' => $user,
      'praises' => $praises
    ]);

  }

  //*****************************************************************************

  /**
   * desc
   *   store new model:Praise
   * auth
   *   create() should be guarded
   */

  public function store(Request $request)
  {
    $validated = $request->validate([
      'sId'           => array_merge(['required'], config('validator.integer.nonNegative')),
      'isItNotice'    => ['required', 'boolean'],
      'header'        => ['required', 'string', 'max:255'],
      'message'       => ['required', 'string', 'max:65535']
    ]);

    $model = new Praise();
    $model->fill([
      'studentId'       => $validated['sId'],
      // should be safe
      // as long as session is server-stored
      // ( Think: xampp -> php -> tmp )
      // uses sends their hash identifier only
      'teacherId'       => auth()->user()->id,
      'isNotice'        => $validated['isItNotice'],
      'title'           => $validated['header'],
      'description'     => $validated['message'],
    ]);

    $status = Status::Error;

    if ($model->save())
    {
      $status = Status::Ok;
    }
    
    return back()->with([
      'status'          => $status
    ]);

  }
  
  //*****************************************************************************

  /**
   * desc
   *   new model:Praise creator
   * auth
   *   guard PraisePolicy::create
   * return
   *   view
   */

  public function create(Students $who, $groupId = null, $userId = null)
  {
    $links      = [];
    $groups     = [];
    $students   = [];
    $student    = null;

    switch ($who)
    {
      case Students::School :

        // All Students

        $groups = Group::all();

        foreach ($groups as $group)
        {
          $links[] = route('praise.create', [
            // who next ?
            'students'    => Students::Group->value,
            'groupId'     => $group->id,
            'userId'      => 0
          ]);
        }

        break;
      
      case Students::Group :

        // One Group / Class

        $students = User::all()->where('group_id', '=', $groupId);

        foreach ($students as $key => $student)
        {
          // assert: student[key] matches link[key]
          $links[$key] = route('praise.create', [
            // who next ?
            'students'    => Students::Student->value,
            'groupId'     => $groupId,
            'userId'      => $student->id
          ]);
        }

        break;
      
      case Students::Student :
        
        // One Student

        $student = User::all()->where('id', '=', $userId)->first();

        break;
    }

    return view('Access.Praise.create', [
      'who'       => $who,
      'links'     => $links,
      'groups'    => $groups,
      'students'  => $students,
      'student'   => $student
    ]);

  }

}
