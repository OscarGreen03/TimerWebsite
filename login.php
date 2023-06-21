<?php
include 'navbar.php';
?>
<head>
    <link rel="stylesheet" href="static/CSS/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Timer Page</title>
</head>

<html>
  <body>
      <script src="https://accounts.google.com/gsi/client" async defer></script>
      <script>
        function handleCredentialResponse(response) {
          console.log("Encoded JWT ID token: " + response.credential);
        }
        window.onload = function () {
          google.accounts.id.initialize({
            client_id: "815261389481-49a76q5nsjopnmtr7dsarlck6q6n5vv9.apps.googleusercontent.com",
            callback: handleCredentialResponse
          });
          google.accounts.id.renderButton(
            document.getElementById("buttonDiv"),
            { theme: "outline", size: "large" }  // customization attributes
          );
          google.accounts.id.prompt(); // also display the One Tap dialog
        }
    </script>
    <div id="buttonDiv"></div> 
  </body>
</html>
<!--
https://tinyurl.com/2bz2kasd - login.php
https://tinyurl.com/3xt87ktu - main.
-->

