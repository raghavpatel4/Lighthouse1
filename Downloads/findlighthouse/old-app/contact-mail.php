<?php
	if(isset($_POST)) {
		include 'superadmin/configuration.php';
		$email_add = trim(addslashes($_POST['contactEmail']));
		$first_name = trim(addslashes($_POST['contactName']));
		$contactMsg = trim(addslashes($_POST['contactMsg']));

		$to = 'hello@findlighthouse.com';
		$subject = "Lighthouse Contact Us!";
		
		$encode_user_id = base64_encode($resturnVal);
		$htmlContent = '<html>
		<body>
			<p align="center"><img src="'.$webUrl.'assets/img/site-logo.png" alt="Lighthouse" /></p>
			<h1>Lighthouse Contact Us!</h1>
			<p>Hello Admin,<br />Please check bellow details.</p>
			<p>My Name:- '.$msgArr[0]['contactName'].'</p>
			<p>My Email Address:- '.$msgArr[0]['contactEmail'].'</p>
			<p>Message:- '.$msgArr[0]['contactMsg'].'</p>
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