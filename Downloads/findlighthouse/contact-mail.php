<?php
	if(isset($_POST)) {
		include 'superadmin/configuration.php';
		$email_add = trim(addslashes($_POST['contactEmail']));
		$first_name = trim(addslashes($_POST['contactName']));
		$contactMsg = trim(addslashes($_POST['contactMsg']));
		
		$form_data1 = array(
			'names' => trim(addslashes($first_name)),
			'messages' => trim(addslashes($contactMsg)),
		    'email_address' => trim(addslashes($email_add))
		);
		dbRowInsert(trim('vpd_contact_mail'), $form_data1);

		$to = 'hello@findlighthouse.com';
		//$to = "karan@vovance.com";
		$subject = "Lighthouse Contact Us!";
		
		$encode_user_id = base64_encode($resturnVal);
		$htmlContent = '<html>
		<body>
			<p align="center"><img src="'.$webUrl.'assets/img/site-logo.png" alt="Lighthouse" /></p>
			<h1>Lighthouse Contact Us!</h1>
			<p>Hello Admin,<br />Please check bellow details.</p>
			<p>My Name:- '.$first_name.'</p>
			<p>My Email Address:- '.$email_add.'</p>
			<p>Message:- '.$contactMsg.'</p>
			<p><br /></p>
			<h4>Questions?</h4>
			<p>24 / 7 Days support : hello@findlighthouse.com</p>
		</body>
		</html>';
		
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// Additional headers
		$headers .= 'From: '.$first_name.' <'.$email_add.'>' . "\r\n";
		$headers .= 'Cc: karan@vovance.com' . "\r\n";
		//$headers .= 'Bcc: welcome2@example.com' . "\r\n";
		
		// Send email
		if(mail($to,$subject,$htmlContent,$headers)):
			$successMsg = '1';
		else:
			$successMsg = '0';
		endif;
		
		echo $successMsg;
	}
?>