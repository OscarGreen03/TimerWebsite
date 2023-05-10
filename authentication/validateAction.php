<?php
// check if userid is set and not empty, token is set and not empty, data is set and not empty, action is set and not empty

if (!isset($_POST['userid']) || empty($_POST['userid'])) {
    echo "Userid not set";
    exit();
}
if (!isset($_POST['clientToken']) || empty($_POST['clientToken'])) {
    echo "Token not set";
    exit();
}
if (!isset($_POST['data']) || empty($_POST['data'])) {
    //echo "No Data sent";
}
if (!isset($_POST['action']) || empty($_POST['action'])) {
    //echo "Action not set";
    //exit();
    $processAction = false;
}




$passwords = fopen('passwords.csv', 'r');
// turn passwords into array
$passwordsArray = array();
while (($line = fgetcsv($passwords)) !== FALSE) {
    $passwordsArray[$line[0]] = $line[1];
    // dict with userid as key, password as value
}

// get stored token
$tokens = fopen('tempDatabase.csv', 'r');
$storedTokens = array();
while (($line = fgetcsv($tokens)) !== FALSE) {
    $storedTokens[$line[1]] = array($line[0], $line[2]);
    // dict with userid as key, array(token, timeout) as value
}
fclose($tokens);



$userid = $_POST['userid'];
$clientToken = $_POST['clientToken'];
//$data = $_POST['data'];
//$action = $_POST['action'];


// formualte serverToken

$joinedString = $storedTokens[$userid][0] . $passwordsArray[$userid];
$serverToken = hash('sha256', $joinedString);

// check if clientToken matches serverToken
if ($clientToken == $serverToken) {
    $tokenValid = true;
} else {
    $tokenValid = false;
    echo "Token invalid";
    exit();
}
// if token is valid, perform action

//echo $tokenValid;

if (($processAction)){
    echo "Doing action";
} else {
    echo "200";
}




?>