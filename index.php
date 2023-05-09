<?php
include "navbar.php";
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Timer Page</title>
</head>
<!-- Button to create new timer -->
<?php
// wipe temporaryTimers.csv
$fp = fopen('Timers/temporaryTimers.csv', 'w');
fclose($fp);
?>
<!-- button to call tempTimer() -->
<button onclick="createTimer('test', 10, 'temp', true, true)">Create new timer</button>
<!-- button to create persistent timer -->
<button onclick="createTimer('test', 10, 'persistent', true, true)">Create new persistent timer</button>
<!-- button to get token -->
<button onclick="getToken('oscar')">Get token</button>

<button onclick="validateUser()">Validate user</button>
<input type="text" id="userid" placeholder="userid">
<input type="text" id="password" placeholder="password">



<script>
   //const crypto = require('crypto');
    function createTimer(name, interval,type, finite, mute) {
        // create a new timer object

        const timer = {
            name: name,
            interval: interval,
            type: type,
            finite: finite,
            mute: mute
        };
        // add timer to temporaryTimers.csv
        $.ajax({
            url: 'addTimer.php',
            type: 'post',
            data: timer,
            success: function () {
                alert("Timer added successfully");
            },
            error: function () {
                alert("Error adding timer");
            }
        });
    }

    function getToken(userid) {
        data = {
            userid: userid
        };
        $.ajax({
            url: 'authentication/getToken.php',
            data: data,
            type: 'post',
            success: function (token) {
                //alert(token);
            },
            error: function () {
                alert("Error getting token");
            }
        });
    }

    function validateUser(){
        const userid = document.getElementById("userid").value;
        const password = document.getElementById("password").value;
        const token = getToken(userid);
        // perform sha256 hash on password . token
        console.log(token);
        sha256(token * password).then(function (hash) {
            authorise(userid, hash);
        });
    }

    async function sha256(input) {
        const encoder = new TextEncoder();
        const data = encoder.encode(input);
        const hashBuffer = await crypto.subtle.digest('SHA-256', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
        return hashHex;
    }



    function authorise(userid, hash){

        // perform sha256 hash on password . token



        // send serverToken to validateToken.php
        const data = {
            userid: userid,
            clientToken: hash,
        };

        $.ajax({
            url: 'authentication/validateToken.php',
            data: data,
            type: 'post',
            success: function (tokenValid) {
                alert(tokenValid);
            },
            error: function () {
                alert("Error validating token");
            }
        });

    }

</script>
