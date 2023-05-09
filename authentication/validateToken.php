<?php
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
    // append all values to 2d array
    $storedTokens[$line[1]] = array($line[0], $line[2]);
    // dict with userid as key, array(token, timeout) as value
}


// passwordArray cant be echo'd as it is array
// instead echo individual elements
//print_r($passwordsArray);
//echo '<br>';
// print all $_POST keys
//print_r(array_keys($_POST));
//print_r($storedTokens);


$userid = $_POST['userid'];
$clientToken = $_POST['clientToken'];
//$data = $_POST['data'];
//$action = $_POST['action'];
$tokenValid = false;
$serverToken = "";
// formualte serverToken
$serverToken = hash('sha256', $storedTokens[$userid][0] . $passwordsArray[$userid]);
// check if clientToken matches serverToken
if ($clientToken == $serverToken) {
    $tokenValid = true;
}
// if token is valid, perform action




echo "====================== ";
echo $storedTokens[$userid][0];
echo " ";
echo $passwordsArray[$userid];
echo " ";
echo $serverToken;
echo "Client token: ";
echo $clientToken;

token:
a9596dbf4370160294530d263b07164017e20a96e3ecb5f70a70bc9dea634cc6
Password:
password123
Expected Token:
2df30a6958e320f1da34df68041a302642241669e4c830ececfe50423ad4f0b6
ClientSide Token Sent:
d5b592c05dc25b5032553f1b27f4139be95e881f73db33b02b05ab20c3f9981e

?>