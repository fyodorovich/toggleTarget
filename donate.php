<?php

# Malcolm Fitzgerald
# 2022-10-13
# 
# determine which URL to display, based on the UTC date

function Redirect($url, $permanent = false) {
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

$now = (int) time();

$default = ["target" => "https://www.zeffy.com/en-CA/donation-form/ada8ec6b-e24d-4486-be1a-bc57f7cfbf49"];
$target = $default["target"];

/*
 * Specifying events in the $seasonal array
 * - we may have more than one seasonal event, so we have an array
 * 
 * Date format is YYYY-MM-DD-H 
 * If hour is not included the current time is used.
 * Setting H to zero is the same as 00:00:00
 * We are ignoring timezones. Time is UTC
 * */


$seasonal = [
    [
        "label" => "Testing",
        "start" => "2022-10-6-0",
        "end" => "2022-10-18-0",
        "target" => "https://www.zeffy.com/en-CA/donation-form/bcec56fb-9c63-4243-8a51-433b049b9efd"
    ],
    [
        "label" => "Annual Funding Drive",
        "start" => "2022-11-6-0",
        "end" => "2022-12-18-0",
        "target" => "https://www.zeffy.com/en-CA/donation-form/bcec56fb-9c63-4243-8a51-433b049b9efd"
    ],
];

foreach ($seasonal as $event) {
    $start = DateTime::createFromFormat("Y-n-d-h", $event["start"])->format("U");
    $end = DateTime::createFromFormat("Y-n-d-h", $event["end"])->format("U");

    var_dump($end);
    var_dump($start);
    var_dump($now);
    $target = ( (int) $start < $now && $now < (int) $end) ? $event["target"] : $target;
}




Redirect($target, false);

