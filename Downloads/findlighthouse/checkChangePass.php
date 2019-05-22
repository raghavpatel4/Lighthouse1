<?php
	if(isset($_POST)) {
		include 'superadmin/configuration.php';
		
		$resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".trim($_POST['user_id'])."'");
		if(count($resultArr) > 0) {
			if($resultArr[0]['password'] == md5(trim($_POST['old_password']))) {
				$form_data = array(
					'password' => md5(trim(addslashes($_POST['new_password'])))
				);
				$resturnVal = dbRowUpdate(trim('vpb_users'), $form_data, " WHERE `id` = '".trim($_POST['user_id'])."'");
				echo 0;
			} else {
				echo 2;
			}
	    } else {
			echo 1;
		}
	}
?>