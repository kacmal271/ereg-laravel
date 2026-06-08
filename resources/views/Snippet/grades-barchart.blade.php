<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Table of Contents
 * # [>= PHP 8.2.0] STRING INTERPOLCATION
 */

// Exception Handler: No Subjects Assigned
if (! isset($subjects))
  // header('');

$x              = [];
$xLabel         = __('Subject');
$y              = [1,2,3,4,5,6];
$yLabel         = __('Mean');
$data           = [];

// [>= PHP 8.2.0] STRING INTERPOLCATION
$title          = __("Grades Chart") . ": {$user->fname} {$user->lname}";

for ($indexOfSubject = 0; $indexOfSubject < count($subjects); $indexOfSubject++)
{
  // x axis tick -> subject name
  $x[]    = $subjects[$indexOfSubject];

  // round long raw float object 
  $data[] = round($meansWeightedRaw[$indexOfSubject], 2);

}

$jsonArray = [
  'x'         => $x,
  'xLabel'    => $xLabel,
  'y'         => $y,
  'yLabel'    => $yLabel,
  'data'      => $data,
  'title'     => $title

];

$jsonString = json_encode($jsonArray, JSON_UNESCAPED_UNICODE);

?>

{{-- Script Herself --}}

<script src="{{ url('script/canvas-api-bar-chart.js') . '?v=' . time() }}"></script>

{{-- Here one of Bar Charts --}}

<canvas class="canvasBarChart b-0 w-100"></canvas>

{{-- Here PHP-JS API w/ JSON Data --}}

<input  id="jsonString"
        value="{{ $jsonString }}"
        hidden />