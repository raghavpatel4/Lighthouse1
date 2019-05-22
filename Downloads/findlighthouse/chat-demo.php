<?php
session_start();
ob_start();
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vasplus Chat</title>




<!-- These links should be at the head section of your account page where you want to place the chat system -->
<script type="text/javascript"> jQuery.noConflict(); </script>
<link rel="stylesheet" type="text/css" href="vasplus_chat/css/vasplus_chat.css">
<script type="text/javascript" src="vasplus_chat/js/jQuery_v1.8.3.js"></script> <!-- No need to add this if your page already has the Jquery plugin -->
<script type="text/javascript" src="vasplus_chat/js/jquery.cookie.js"></script>
<script type="text/javascript" src="vasplus_chat/js/jquery.eventsource.js"></script>
<script type="text/javascript" src="vasplus_chat/js/vasplus_chat.js"></script>






</head>
<body>










<?php
/*
* These codes are expected to be any where at the body section of your account page where a user can only see after login
* The same applies to the codes at the head section of this page. The codes at the head section of this page the below
* PHP codes work together and they must always be on any page where you want the chat system to reflect with the username
of your logged in user paced to the session variable $_SESSION["from_username"] = 'username of logged in user';
*/

// Username of logged in user
//$_SESSION["from_username"] = 'victor'; // Set your logged in user username as it is in your database users table here

// Demo Sample which should be remove when username has been passed to the $_SESSION["from_username"] code above
$_SESSION["from_username"] = isset($_GET["username"]) ? strip_tags($_GET["username"]) : 'victor'; // This is a demo for username passed to the URL

echo '<input type="hidden" id="from_username_identity" value="'.strip_tags($_SESSION["from_username"]).'" />';
?>












</body>
</html>