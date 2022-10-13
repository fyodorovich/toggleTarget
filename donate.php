<?php

# Malcolm Fitzgerald
# 2022-10-13
# 
# determine which URL to display, based on the UTC date


/*
 * provide a default target and set the current target to the default
 */

$default = ["target" => "https://www.zeffy.com/en-CA/donation-form/ada8ec6b-e24d-4486-be1a-bc57f7cfbf49"];
$target = $default["target"];

/*
 * Specifying events in the $seasonal array
 * - we may have more than one seasonal event, so we have an array
 * 
 * Date format is YYYY-M-D-H, in PHP formatting rules that is "Y-n-d-h"
 * Month, day and hour can be a single digit
 * If hour is not included the current time is used.
 * Setting H to zero is the same as 00:00:00
 * We are ignoring timezones. Time is UTC
 * */


$now = (int) time();
$seasonal = [
    [
        "label" => "Testing",
        "start" => "2022-10-6-0",
        "end" => "2022-10-18-0",
        "target" => "https://www.zeffy.com/en-CA/donation-form/bcec56fb-9c63-4243-8a51-433b049b9efd"
    ],
    [
        "label" => "Annual Funding Drive 2022",
        "start" => "2022-11-6-0",
        "end" => "2022-12-18-0",
        "target" => "https://www.zeffy.com/en-CA/donation-form/3034a3f7-a80d-4427-bbd1-9af978339ed7"
    ],
];

foreach ($seasonal as $event) {
    $start = DateTime::createFromFormat("Y-n-d-h", $event["start"])->format("U");
    $end = DateTime::createFromFormat("Y-n-d-h", $event["end"])->format("U");
    $target = ( (int) $start < $now && $now < (int) $end) ? $event["target"] : $target;
}


header('Location: ' . $target, true, 302);
exit();
