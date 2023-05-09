<?php
// pass unique token to user
$userid = $_POST['userid'];
$token = bin2hex(random_bytes(32));
// save token to file with timeout
$fp = fopen('../authentication/tempDatabase.csv', 'a');
fputcsv($fp, array($token,$userid, time() + 60));
fclose($fp);

echo $token;

?>