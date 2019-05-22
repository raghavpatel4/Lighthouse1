<?php
if(isset($_POST['user_id'])) {
	include 'superadmin/configuration.php';
	$to_username = $_POST['user_id'];
	$onlineStatus = "select * from `vpb_online_users` WHERE `user_id` = '".$to_username."'";
	//echo $sqlQuery;
	$rsOnlineStatus = getCustomResult($onlineStatus);
	if(count($rsOnlineStatus) > 0) {
		$onlineIcons = 'images/icons/greenNotificationDot.png';
	} else {
		$onlineIcons = 'images/icons/redNotificationDot.png';
	}
	echo $onlineIcons;
}
?>
