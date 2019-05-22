<?php
session_start();
ob_start();
//header("location: ../index.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vasplus Chat</title>





</head>
<body>




<?php
if(isset($_GET["username"]));

$_SESSION["from_username"] = strip_tags($_GET["username"]); // Set your logged in user session username as it is in your database users table here
?>
<input type="hidden" id="from_username_identity" value="<?php echo $_SESSION["from_username"]; ?>" />




<script type="text/javascript" src="js/jQuery_v1.8.3.js"></script>
<link rel="stylesheet" type="text/css" href="css/vasplus_chat.css">
<script type="text/javascript" src="js/jquery.eventsource.js"></script>
<script type="text/javascript" src="js/vasplus_chat.js"></script>

</body>
</html>
