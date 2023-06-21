<?php
include "navbar.php";
?>
<head>
    <link rel="stylesheet" href="static/CSS/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Timer Page</title>
</head>
<!-- Button to create new timer -->
<?php
// wipe temporaryTimers.csv
$fp = fopen('Timers/temporaryTimers.csv', 'w');
fclose($fp);
?>
<div id="main">
    <!-- button to call tempTimer() -->
    <button onclick="createTimer('test', 10, 'temp', true, true)">Create new timer</button>
    <!-- button to create persistent timer -->
    <button onclick="createTimer('test', 10, 'persistent', true, true)">Create new persistent timer</button>
    <!-- button to get token -->
    <button onclick="getTimers()">Get Timers</button>

    <button onclick="validateUser('none')">Validate user</button>
    <label for="userid"></label><input type="text" id="userid" placeholder="userid">
    <label for="password"></label><input type="password" id="password" placeholder="password">


</div>
<script>

    //const crypto = require('crypto');
    function createTimer(name, interval, type, finite, mute) {
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


    async function sha256(input) {
        const encoder = new TextEncoder();
        const data = encoder.encode(input);
        const hashBuffer = await crypto.subtle.digest('SHA-256', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        return hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
        //return hashHex;
    }


    function notifyUser(content, type) {
        // get main div and place notification under nav bar
        const mainDiv = document.getElementById("main");
        const notification = document.createElement("div");
        notification.classList.add("notification");
        notification.classList.add(type === "error" ? "error" : "not");
        notification.textContent = content;
        mainDiv.appendChild(notification);
        setTimeout(() => {
            notification.classList.add("fade");
            setTimeout(() => {
                mainDiv.removeChild(notification);
            }, 1000);
        }, 3000);
    }

    function pullTimers() {

    }

    function getTimers() {

    }

</script>
