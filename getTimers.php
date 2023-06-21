<?php
// get timers pulls timer data from persistentTimers.csv and temporaryTimers.csv and returns it to the client

$f = fopen('Timers/persistentTimers.csv', 'r');
$timers = array();
while (($line = fgetcsv($f)) !== FALSE) {
    $timers[] = $line;
}
echo $timers;
?>