<?php

namespace App\Livewire\Meeting;

use \App\Models\Group;
use \App\Models\User;
use \Illuminate\Database\Eloquent\Collection;
use \App\Helper\Extended\DateTime;
use \App\Helper\ServerDatabaseConversion;
use App\Helper\Translator;
use Livewire\Component;

class SortedView extends Component
{
  //
  // MARKUP
  //

  public $dropdown;

  //
  // MEMBER DATA
  //

  public $isAscending = true;


  /**
   * $isMeetingExpired
   *   [true, false, true, ..]
   * count
   *   same as $meetings
   */
  public $isMeetingExpired = [];

  public $meetings = [];
  public $sortingProperties = [];
  public $sortingProperty;

  private $start = 'start';
  private $lastName = 'lastName';
  private $group = 'groupName';

  ///////////////////////////////////////////////////////////////////////////////
  // PUBLIC: FUNCTION

  //*****************************************************************************
  public function changeOrder(bool $isAscending)
  {
    $this->isAscending = $isAscending;

    $this->updatedDropdown();
  }

  //*****************************************************************************
  public function mount()
  {
    // adapt sorting options
    $this->sortingProperties = [];
    
    switch (auth()->user()->role->code)
    {
      case config('role.parent.code') :

        // parent
        $this->sortingProperties = [
          $this->start        => __('Start Date'),
          $this->lastName     => __('Teacher Last Name')
        ];
        
        break;

      case config('role.teacher.code') :

        // teacher
        $this->sortingProperties = [
          $this->start        => __('Start Date'),
          $this->group        => __('Group')
        ];

        break;

    }

    // sorting options adapted

    // set initial sorting option
    $this->dropdown = $this->start;

    // set initial sorting
    $this->updatedDropdown();
    
  }

  //*****************************************************************************
  public function render()
  {
    return view('livewire.meeting.sorted-view');
  }

  //*****************************************************************************
  public function updatedDropdown()
  {
    $this->sortingProperty = $this->dropdown;

    // return sorted models
    $meetings = $this->sortedByProperty();

    // set view data
    $this->meetings = $this->parseModels($meetings);

    // set view color-coded backgrounds information
    $this->setMeetingsExpiration($meetings);

  }

  ///////////////////////////////////////////////////////////////////////////////
  // PRIVATE: FUNCTION

  //*****************************************************************************

  /**
   * desc
   *   input: [meeting1, meeting2, meeting3]
   *   output: [meeting1, meeting3] that belong to auth()->user()
   */

  private function getUserMeetings($meetings)
  {
    $myMeetings = auth()->user()->meetings;

    $userMeetings = new Collection();

    foreach ($meetings as $meeting)
    {
      // search through all meetings
      // (!) sorted with respect to teacher last name
      $userMeeting = null;

      foreach ($myMeetings as $myMeeting)
      {
        if ($myMeeting->id != $meeting->id)
        {
          // search for meeting that should also
          // be displayed in View
          continue;
        }

        // found meeting that should
        // be displayed in View
        $userMeeting = $myMeeting;
        break;
      }

      if ($userMeeting == null)
      {
        // this particular meeting shouldnt at all
        // be displayed in View
        continue;
      }

      // add next sorted meeting
      $userMeetings->add($userMeeting);

    }

    return $userMeetings;
    
  }

  //*****************************************************************************

  /**
   * 
   */

  private function sortedByProperty()
  {
    $property = $this->sortingProperty;

    switch ($property)
    {
      case $this->group :

        // group name

        $sortedMeetings = Group::join('meetings', 'groups.id', '=', 'meetings.group_id')
          // meetings.meetingName
          // groups.name
          // much luck
          ->orderBy('name', $this->isAscending ? 'asc' : 'desc')
          ->get();

        return $this->getUserMeetings($sortedMeetings);

        break;

      case $this->start :

        // start time

        // Illuminate\Database\Eloquent\Collection
        $meetings = auth()->user()->meetings;
        
        if ($this->isAscending)
        {
          return $meetings->sortBy('startTime');
        }
        
        return $meetings->sortByDesc('startTime');

        break;

      case $this->lastName :

        // teacher last name // sorting with relation

        // asc
        // 2024-10-31
        // 2024-12-12
        // 2024-12-25

        // desc
        // 2024-12-25
        // 2024-12-12
        // 2024-10-31

        $sortedMeetings = User::join('meetings', 'users.id', '=', 'meetings.user_id')

          // Illuminate\Database\Eloquent\Builder
          ->orderBy('lname', $this->isAscending ? 'asc' : 'desc')

          // Illuminate\Database\Eloquent\Collection
          ->get();

        return $this->getUserMeetings($sortedMeetings);

        break;

    }

  }

  //*****************************************************************************
  private function setMeetingsExpiration($meetings)
  {
    $now = new \DateTimeImmutable('now');

    $isMeetingExpired = [];

    foreach ($meetings as $meeting)
    {
      // future (not expired):
      // 1000000000 > 2000000000 : false
      // past (expired):
      // 2000000000 > 1000000000 : true

      $isMeetingExpired[] = $now->getTimestamp() > $meeting->startTime->getTimestamp();
    }

    // return
    $this->isMeetingExpired = $isMeetingExpired;
  }

  //*****************************************************************************

  /**
   * desc
   * 
   *   Collection of Models
   * 
   *   [
   *     [
   *       'teacher|group' => 'John Smith'|'2A',
   *       'date' => '2024-11-11 11:11:00',
   *       'start' => '2024-11-11 11:11:00',
   *       'end' => '2024-11-11 11:44:00',
   *       'title' => 'Model Title',
   *       'description' => 'Model Description'
   *     ],
   *   ]
   */

  private function parseModels($meetings) : array
  {
    $data = [];

    foreach ($meetings as $meeting)
    {
      /**
       * $context
       *   teacher personallia (for parents) or group name (for teacher)
       */
      $context = null;
      $contextKey = null;

      switch (auth()->user()->role->code)
      {
        case config('role.parent.code') :
          
          // parent
          $context = $meeting->teacher->fname . ' ' . $meeting->teacher->lname;
          $contextKey = 'teacher';
          break;

        case config('role.teacher.code') :

          // teacher
          $context = $meeting->group->name;
          $contextKey = 'group';
          break;
      }
      
      $date = $meeting->startTime->format(config('format.datetime'));
      $date = DateTime::relativeDate($date);
      $date = Translator::translate($date);

      $start = $meeting->startTime->format(config('format.time-hour-minute'));

      $end = $meeting->startTime->format(config('format.time-hour-minute'));
      
      $description = ServerDatabaseConversion::markupNewLines(
        $meeting->meetingDescription
      );

      $newRow = [
        $contextKey => $context,
        'date' => $date,
        'start' => $start,
        'end' => $end,
        'title' => $meeting->meetingName,
        'description' => $description,
      ];

      $data[] = $newRow;

    }

    return $data;

  }

}
