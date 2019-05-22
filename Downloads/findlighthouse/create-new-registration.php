<?php
	if(isset($_POST)) {
		include 'superadmin/configuration.php';
		$password1 = trim($_REQUEST['password']);
		$password = md5($password1);
		$email_add = trim(addslashes($_POST['email_id']));
		$first_name = trim(addslashes($_POST['first_name']));
		$last_name = trim(addslashes($_POST['last_name']));
		$full_name = trim(addslashes($_POST['first_name'])).' '.trim(addslashes($_POST['last_name']));

		$form_data = array(
		    'email' => $email_add,
		    'password' => md5($_POST['password']),
		    'user_type' => trim(addslashes($_POST['action'])),
		    'first_name' => $first_name,
		    'last_name' => $last_name,
		    'std_unique_id' => trim(addslashes($_POST['std_unique_id'])),
			'org_pass' => $password1,
		    'school_id' => trim(addslashes($_POST['school_id'])),
		    'fullname' => $full_name,
		    'date' => date('Y-m-d h:i:s')
		);
		$resturnVal = dbRowInsert(trim('vpb_users'), $form_data);
		if($resturnVal > 0) {
		
			$form_data_1 = array(
			    'username' => $resturnVal
			);
			$resturnVal_1 = dbRowUpdate(trim('vpb_users'), $form_data_1, "WHERE `id` = '".$resturnVal."'");
			
			/*$form_data_2 = array(
			    'user' => $resturnVal,
			    'friend' => '1'
			);
			$resturnVal_2 = dbRowInsert(trim('vpb_chat_friends'), $form_data_2);
			
			$form_data_3 = array(
			    'user' => '1',
			    'friend' => $resturnVal
			);
			$resturnVal_3 = dbRowInsert(trim('vpb_chat_friends'), $form_data_3);
			
	    	@session_start();
	    	$_SESSION['user_id'] = $resturnVal;
			$_SESSION['email'] = trim(addslashes($_POST['email_id']));
			$_SESSION['user_type'] = trim(addslashes($_POST['action']));
			$_SESSION['first_name'] = trim(addslashes($_POST['first_name']));
			$_SESSION['last_name'] = trim(addslashes($_POST['last_name']));
			$_SESSION['from_username'] = trim(addslashes($resturnVal));
			$_SESSION['create_login'] = date('Y-m-d h:i:s');*/
			//echo '<pre>'; print_r($_SESSION);echo '</pre>';die;
			if($_POST['action'] == '1') {
				$to = $email_add;
				$subject = "Confirm Your New Account in Lighthouse!";
				
				$encode_user_id = base64_encode($resturnVal);
				$htmlContent = '<html>
				<body>
					<p align="center"><img src="'.$webUrl.'assets/img/site-logo.png" alt="Lighthouse" /></p>
					<h1>Confirm Your New Account in Lighthouse!</h1>
					<p>Hello '.$full_name.',<br />Please confirm Your Student Account.</p>
					<p>So, Now You can Active Your Account and Create All student activites.</p>
					<p>Email Address:- '.$email_add.'</p>
					<p><a href="'.$webUrl.'?confirm_id='.$encode_user_id.'#login" target="_blank">Click Here!</a> for Confirm Your Account.</p>
					<p><br /></p>
					<h4>Questions?</h4>
					<p>24 / 7 Days support : hello@findlighthouse.com</p>
				</body>
				</html>';
				
				// Set content-type header for sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				// Additional headers
				$headers .= 'From: Lighthouse <hello@findlighthouse.com>' . "\r\n";
				$headers .= 'Cc: karan@vovance.com' . "\r\n";
				//$headers .= 'Bcc: welcome2@example.com' . "\r\n";
				
				// Send email
				if(mail($to,$subject,$htmlContent,$headers)):
					$successMsg = 'Email has sent successfully.';
				else:
					$errorMsg = 'Email sending fail.';
				endif;
			}

	        echo $resturnVal;
	    } else {
			echo 0;
		}
	}
?>