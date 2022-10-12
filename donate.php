<?php

# Malcolm Fitzgerald
# 2022-10-13
# 
# determine which URL to display, based on the UTC date


function Redirect($url, $permanent = false) {
 header('Location: ' . $url, true, $permanent ? 301 : 302);
 exit();
 }

$now = time();

$default = [ "target" => "https://duckduckgo.com" ] ;
$target = $default["target"]; 


/*
 * Date format is YYYY-MM-DD-H 
 * If hour is not included the current time is used.
 * Setting H to zero is the same as 00:00:00
 * We are ignoring timezones. Time is UTC
 **/


$seasonal = [
[
"start" => "2022-10-11-0" , 
"end" => "2022-10-14-0",
"target" => "https://the.fmsoup.org"
],
[
"start" => "2022-11-15-0" , 
"end" => "2022-12-15-0",
"target" => "https://google.com"
],

];       



foreach ( $seasonal as $event ) {
    $start =  DateTime::createFromFormat("Y-n-d-h", $event["start"])->format("U");
    $end = DateTime::createFromFormat("Y-n-d-h", $event["end"])->format("U");
    $target = ( $start > $now && $end < $now ) ? $event["target"] : $target ;
}



 
Redirect( $target, false);



