<?php
	session_start();
	include 'superadmin/configuration.php';
	dbRowDelete('vpb_online_users', " WHERE `user_id` = '".$_SESSION['user_id']."'");
	
	session_unset(); 
	session_destroy(); 
?>
<script type="">
	window.location = 'index.php';
</script>