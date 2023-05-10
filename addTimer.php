<?php
// get timer data from ajax
$name = $_POST['name'];
$interval = $_POST['interval'];
$type = $_POST['type'];
$finite = $_POST['finite'];
$mute = $_POST['mute'];

// save data to csv
if ($type == "temp"){
    $fp = fopen('Timers/temporaryTimers.csv', 'a');
} else {
    $fp = fopen('Timers/persistentTimers.csv', 'a');
}

fputcsv($fp, array($name, $interval, $finite, $mute));
fclose($fp);
// return success
echo "success";

?>

