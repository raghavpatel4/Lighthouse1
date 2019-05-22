<?php
	session_start();
	if(isset($_POST)) {
		include 'superadmin/configuration.php';
		if($_POST['method'] == 'createNew') {
			$form_data1 = array(
				'title' => trim(addslashes($_POST['collegeTitle'])),
				'is_admin' => trim($_SESSION["user_id"])
			);
			$insert_id = dbRowInsert(trim('vpb_college_check_list'), $form_data1);
			
			/*$form_data2 = array(
				'c_id' => trim(addslashes($insert_id)),
				'user_id' => trim($_SESSION["user_id"])
			);
			dbRowInsert(trim('vpb_user_college_check_list'), $form_data2);*/
			echo $insert_id;
		}
		if($_POST['method'] == 'createCheck') {
			if($_POST['process'] == 1) {
				$form_data2 = array(
					'c_id' => trim(addslashes($_POST['c_id'])),
					'user_id' => trim($_SESSION["user_id"])
				);
				dbRowInsert(trim('vpb_user_college_check_list'), $form_data2);
			} else {
				dbRowDelete(trim('vpb_user_college_check_list'), "WHERE `user_id` = '".$_SESSION['user_id']."' AND `c_id` = '".$_REQUEST['c_id']."'");
			}
			echo 1;
		}
	}
?>
