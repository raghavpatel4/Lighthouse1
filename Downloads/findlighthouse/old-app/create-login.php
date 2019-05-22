<?php
	if(isset($_POST)) {
		include 'superadmin/configuration.php';
		
		$resultArr = getRowResult(trim('vpb_users'), " WHERE `email` = '".trim($_POST['email_id'])."' AND `password` = '".md5($_POST['password'])."' AND `user_type` = '".$_POST['action']."' AND `status` = '1'");
		if(count($resultArr) > 0) {
	    	@session_start();
	    	foreach($resultArr as $keys => $vals) {
				$_SESSION['user_id'] = $vals['id'];
				$_SESSION['from_username'] = $vals['id'];
				$_SESSION['email'] = $vals['email'];
				$_SESSION['user_type'] = $vals['user_type'];
				$_SESSION['first_name'] = $vals['first_name'];
				$_SESSION['last_name'] = $vals['last_name'];
				$_SESSION['create_login'] = date('Y-m-d h:i:s');
			}
			//echo '<pre>';print_r($_SESSION);echo '</pre>';
			//echo '<pre>'; print_r($_SESSION);echo '</pre>';die;
	    	//$_SESSION[''] = $form_data[][]
	    	
	        echo 1;
	    } else {
			echo 0;
		}
	}
?>