<?php
	if(isset($_POST)) {
		include 'superadmin/configuration.php';
		
		//$resultArr = getRowResult(trim('tbl_user'), " WHERE `email_id` = '".trim($_POST['email'])."' AND `user_type` = '".$_POST['action']."'");
		$resultArr = getRowResult(trim('vpb_users'), " WHERE `email` = '".trim($_POST['email_id'])."'");
		if(count($resultArr) > 0) {
	    	echo 1;
	    } else {
			echo 0;
		}
	}
?>