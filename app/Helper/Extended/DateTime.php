<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * DateTime Class - Goals
 * # extend DateTime class
 */

namespace App\Helper\Extended;

use App\Helper\Enumeration\TimePeriod;
use App\Helper\Enumeration\TimePeriodFilter;

//-----------------------------------------------------------------------------
class DateTime extends \DateTime
{

  /////////////////////////////////////////////////////////////////////////////
  // PUBLIC STATIC

  //*****************************************************************************
  public static function abstractDayName(string $dayName)
  {
    $dayName = strtolower($dayName);
    $dayName = substr($dayName, 0, 2);

    return $dayName;

  }

	//*****************************************************************************

  /**
   * description
   *   input: string "2000-01-01" or "2000-01-01 12:59:59" or ...
   *   output: "24 years ago", "in 40 minutes"
   */

	public static function dateTimeAgo(string $datetime) : string
	{
    // AM/PM DATE() STRING SWITCH
		$now = date_create(date('Y-m-d h:i:s a'));
      // now
    $then = date_create(date($datetime));
      // then
    $diff = date_diff($now, $then); // then - now
      // past or future

    // Watch: then - now
    // (A) Watch: - is past
    // (B) Watch: + is future

    $returnalTimeAgo = '';

    switch (true)
    {
      // DECADE

        // wait.. seriously?

      // YEAR

      case (int)$diff->format('%y') != 0 :

        // LANGUAGE INFLEXION
        $postfix = (int)$diff->format('%y') == 1 ? "Year" : "Years";

        $returnalTimeAgo =
          DateTime::dateTimeAgoPeriod($diff, "%y", $postfix);

        break;

      // MONTH

      case (int)$diff->format('%m') != 0 :

        $postfix = "Month(s)";

        $returnalTimeAgo =
        DateTime::dateTimeAgoPeriod($diff, "%m", $postfix);

        break;

      // DAY

      case (int)$diff->format('%d') != 0 :

        $postfix = "Day(s)";

        $returnalTimeAgo =
        DateTime::dateTimeAgoPeriod($diff, "%d", $postfix);

        break;

      // HOUR

      case (int)$diff->format('%h') != 0 :

        $postfix = "Hour(s)";

        $returnalTimeAgo =
        DateTime::dateTimeAgoPeriod($diff, "%h", $postfix);

        break;

      // MINUTE

      case (int)$diff->format('%i') != 0 :

        $postfix = "Minute(s)";

        $returnalTimeAgo =
        DateTime::dateTimeAgoPeriod($diff, "%i", $postfix);

        break;
      
      // SECOND

      default :

      $postfix = "Second(s)";

        $returnalTimeAgo =
        DateTime::dateTimeAgoPeriod($diff, "%s", $postfix);

        break;

    }
    
    return $returnalTimeAgo;
		
	}
  
	//*****************************************************************************

  /**
   * description
   *   Helper for self::dateTimeAgo(string)
   *   input: string "2000-01-01" or "2000-01-01 12:59:59" or ...
   *   output: "24 years ago", "in 40 minutes"
   */

	public static function dateTimeAgoPeriod(
    \DateInterval $diff,
    string $formatFilter,   // \DateInterval format("%y") 
    string $periodName      // "lat" "miesięcy" "dni"
  ) : string
  {
    $timeAgo = (int)$diff->format($formatFilter);

    if ($diff->format('%R') == '-')
    {
      // (A) is past
      // Point In Time: has happened

      $postfix = "Ago";

      $timeAgo = abs($timeAgo) . " $periodName $postfix";

    }
    else
    {
      // (B) is future
      // Point In Time: will happen

      $prefix = "In.time";

      $timeAgo = "$prefix $timeAgo $periodName";

    }

    return $timeAgo;

  }

  //*****************************************************************************

  /**
   * description
   *   operate on array of week days
   * $dayNames
   *   ['Tuesday', 'weDnesDay', 'friday']
   * $filter
   *   TimePeriodFilter::WeekendDays
   * $daysCount
   *   1
   * return
   *   ['friday']
   */

  public static function filterDayNames(
    array $dayNames,
    TimePeriodFilter $filter, // WeekendDays? I will return Weekend Days!
                              // WeekDays?    I will return Week    Days!
    int $daysInTimePeriod
  )
  {
    $daysToReturn = [];

    switch ($filter)
    {
      case TimePeriodFilter::WeekendDays :

        $dayNames = array_reverse($dayNames);

      case TimePeriodFilter::WeekDays :

        for ($i = 0; $i < $daysInTimePeriod; $i++)
        {
          if ($i >= count($dayNames))
            throw new \Exception('array $dayNames has shorter period');

          $daysToReturn[] = $dayNames[$i];

        }

        break;

    }

    return $daysToReturn;

  }

  //*****************************************************************************

  /**
   * description
   *   input: string "2000-01-01 12:59:59"
   *   output: same day: "12:59"
   *   output: same month and year: "Jan 01, 12:59"
   *   output: otherwise: "2024 Jan 01, 12:59"
   */

  public static function relativeDate(string $datetime) : string
  {
    $datetime = date_create($datetime);
    $datenow = new DateTime();
    // $datediff = date_diff($datenow, $datetime);
    
    /**
     * Version: stupid
     * how do you know its not next year ?
     */
    // $condition = $datediff->format('%Y') == 0;

    if ($datetime->format('Y') == $datenow->format('Y'))
    {
      // current year

      if ($datetime->format('d') == $datenow->format('d'))
        // current day
        $datetime = $datetime->format('H:i');
      else
        // past/future year day
        $datetime = $datetime->format('M d, H:i');
    }
    else
      // past/future year
      $datetime = $datetime->format('Y M d, H:i');

    return $datetime;

  }

	//*****************************************************************************

  /**
   * description
   *   Helper for dateTimeAgo(string)
   * string $time
   *   example can be: '36' when $period is TimePeriod::Second
   *   example can be: '59' when $period is TimePeriod::Minute
   *   example can be: '23' when $period is TimePeriod::Hour
   * TimePeriod $period
   *   example can be: TimePeriod::Second
   * return : string
   *   example: 60 - 36 = 24 as string
   *   example: 60 - 59 = 1  as string
   */
	
	public static function timeInvert(string $time, TimePeriod $period) : string
  {
    $invertedTime = '';

    switch ($period)
    {
      case TimePeriod::Second :
        // Difference         : How far apart
        // Discrete Values    : (from, to]
        $invertedTime = TimePeriod::Minute->value - (int)$time;
        break;

      case TimePeriod::Minute :
        $minuend = TimePeriod::Hour->value / TimePeriod::Minute->value;
          // minuend is # minutes in 1 hour
        $invertedTime = $minuend - (int)$time;
        break;

      case TimePeriod::Hour :
        $minuend = TimePeriod::Day->value / TimePeriod::Hour->value;
          // minutend is # hours in 1 day
        $invertedTime = $minuend - (int)$time;
        break;

    }

    return $invertedTime;

  }

  //*****************************************************************************
  public static function weekDays(bool $isSundayFirst = false) : array
  {
    if ($isSundayFirst)
      return [
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday'
      ];

    return [
      'monday',
      'tuesday',
      'wednesday',
      'thursday',
      'friday',
      'saturday',
      'sunday'
    ];

  }

  //*****************************************************************************

  /**
   * return: int, day of the week, 1-7
   */

  public static function whichDayOfWeek(
    string $dayName,
    bool $isSundayFirst = false
  ) : int
  {
    $dayName = DateTime::abstractDayName($dayName);

    $weekDays = DateTime::weekDays($isSundayFirst);

    foreach ($weekDays as &$weekDay)
      $weekDay = DateTime::abstractDayName($weekDay);

    $index = array_search($dayName, $weekDays);

    return $index + 1;

  }

  /////////////////////////////////////////////////////////////////////////////
  // PUBLIC

  //*****************************************************************************

  /**
   * description
   *   is it a Week day or WeekEnd day ?
   * string $dayName
   *   example can be, 'Mon', 'tue', 'Wednesday', 'friday' ..
   * return : bool
   *   is this day is a studying day ?
   * workings
   *   array of week days (7) is being popped
   *   since thats where the weekend days (2) are expected
   */

  public function isValidWeekDay(string $dayName) : bool
  {
    $days = DateTime::weekDays();

    $validWeekDays = DateTime::filterDayNames(
      $days,
      TimePeriodFilter::WeekDays,
      count($days) - $this->daysPerWeekend
    );
    
    foreach ($validWeekDays as $validWeekDay)
    {
      $day1 = DateTime::abstractDayName($validWeekDay);
      $day2 = DateTime::abstractDayName($dayName);

      if ($day1 == $day2)
        return true;

    }

    return false;

  }

  /////////////////////////////////////////////////////////////////////////////
  // PRIVATE

  private int $daysPerWeekend = 2;

    public function setDaysPerWeekend(int $daysPerWeekend)
    {
      $this->daysPerWeekend = $daysPerWeekend;

    }

    public function getDaysPerWeekend() : int
    {
      return $this->daysPerWeekend;

    }

}