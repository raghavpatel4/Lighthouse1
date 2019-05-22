<?php
	if(isset($_POST['chat'])) {
		@session_start();
		ob_start();
		include 'superadmin/configuration.php';
		//date_default_timezone_set('US/Eastern');
		$to_username = $_POST['to_username'];
		if($_POST['chatText'] != '') {
			$form_data = array(
				'from_username' => trim(addslashes($_SESSION["user_id"])),
				'to_username' => trim(addslashes($_POST['to_username'])),
				'message' => trim(addslashes($_POST['chatText'])),
				'read' => 'no',
				'date_sent' => strtotime(date('Y-m-d h:i:s'))
			);
			$resturnVal = dbRowInsert(trim('vpb_chat_messages'), $form_data);
			
			$form_data1 = array(
				'lastTimeStr' => time(),
				'lastTime' => date('Y-m-d h:i:s')
			);
			dbRowUpdate('vpb_online_users', $form_data1, " WHERE `user_id` = '".trim($_SESSION["user_id"])."'");
		}
	}
	if(isset($_POST['chatFiles'])) {
		$resArr = array();
		@session_start();
		ob_start();
		include 'superadmin/configuration.php';
		//date_default_timezone_set('US/Eastern');
		//echo '<pre>';print_r($_REQUEST);
		$to_username = $_POST['to_username'];
		if (isset($_FILES['file']['name'])) {
			$fielNames = time().'-'.$_FILES['file']['name'];
			$fullPathFileNmae = 'vasplus_chat/vpb_chat_attachments/'.$fielNames;
			$resArr['FileNmae'] = $fielNames;
			$resArr['fullPathFileNmae'] = $fullPathFileNmae;
			if (0 < $_FILES['file']['error']) {
				$resArr['errorType'] = 1;
				//echo 'Error during file upload' . $_FILES['file']['error'];
			} else {
				if (file_exists($fullPathFileNmae)) {
					//echo 'File already exists : uploads/' . $_FILES['file']['name'];
					$resArr['errorType'] = 1;
				} else {
					move_uploaded_file($_FILES['file']['tmp_name'], $fullPathFileNmae);
					//echo 'File successfully uploaded : uploads/' . $_FILES['file']['name'];
					$resArr['errorType'] = 0;

					$form_data = array(
						'from_username' => trim(addslashes($_SESSION["user_id"])),
						'to_username' => trim(addslashes($_POST['to_username'])),
						'message' => 'File uploaded: '.trim(addslashes($fielNames)),
						'attachment' => trim(addslashes($fielNames)),
						'read' => 'no',
						'date_sent' => strtotime(date('Y-m-d h:i:s'))
					);
					$resturnVal = dbRowInsert(trim('vpb_chat_messages'), $form_data);

					$form_data1 = array(
						'lastTimeStr' => time(),
						'lastTime' => date('Y-m-d h:i:s')
					);
					dbRowUpdate('vpb_online_users', $form_data1, " WHERE `user_id` = '".trim($_SESSION["user_id"])."'");
					
				}
			}
		}
		echo json_encode($resArr);
	}
?>
