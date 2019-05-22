	<?php include 'head.php';?>
	</head>
  	<body class="inner-page">
	  	<?php include 'header.php';?>
	  	
	  	<?php if(isset($_SESSION["admin_id"]) && $_SESSION["admin_id"] > 0) {?>
				<script type="text/javascript">
                    window.location = 'superadmin/index.php';
                </script>
		<?php
			}
	  		if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0) {
		?>
				<script>
                    window.location = 'message.php';
                </script>
			<?php
			}
			$errorMsg = '';
			if(isset($_POST['registration_button'])) {
				$msgArr = getCustomResult("select * from `vpb_users` WHERE `email` = '".trim($_REQUEST['forgotEmailId'])."'");
				if(count($msgArr) > 0) {
					$to = $msgArr[0]['email'];
					$subject = "Forgot Password in Lighthouse!";
					
					$encode_user_id = base64_encode($msgArr[0]['id']);
					$htmlContent = '<html>
					<body>
						<p align="center"><img src="'.$webUrl.'assets/img/site-logo.png" alt="Lighthouse" /></p>
						<h1>Forgot Password in Lighthouse!</h1>
						<p>Hello '.$msgArr[0]['full_name'].',<br />Please Change Password in your account.</p>
						<p>Email Address:- '.$msgArr[0]['email'].'</p>
						<p><a href="'.$webUrl.'forgot-password.php?forgot_id='.$encode_user_id.'" target="_blank">Click Here!</a> for Confirm Your Change Password.</p>
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
					$errorMsg = 'To Change Password Link sent on your registered email ID. Please check and change Your Password.';
				} else {
					$errorMsg = 'Sorry this email Address is wrong. Please try again with correct email address.';
				}
			}
			if(isset($_POST['changePassword'])) {
				dbRowUpdate(trim('vpb_users'), array('password' => md5(trim($_REQUEST['password'])), 'org_pass' => trim($_REQUEST['password'])), " WHERE `id` = '".$_REQUEST['user_id']."'");
		?>
        		<script type="text/javascript">
					window.location = 'index.php#login';
				</script>
        <?php
			}
	  	?>
            <div class="body-section">
                <div class="container">
                
                	<?php
						$forPass = 0;
						if(isset($_REQUEST['forgot_id'])) {
							$encode_user_id = base64_decode($_REQUEST['forgot_id']);
							//echo $encode_user_id;
							$checkUserActive = getRowResult(trim('vpb_users'), " WHERE `id` = '".$encode_user_id."'");
							if(count($checkUserActive) > 0) {
								$forPass = 1;
							}
						}
						if($forPass == 0) {
					?>
                    <div class="row centered mt grid">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                            <h1 class="text-center">Forgot Password</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <p align="center"><?php echo $errorMsg;?></p>
							<form action="" method="post" class="form-horizontal form-label-left login-form">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="forgotEmailId">Email Address</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"><input type="text" name="forgotEmailId" required="required" class="form-control" id="forgotEmailId" placeholder="Email Address" /></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="item form-group centered">
                                    <div class="col-md-12 col-sm-12 col-xs-12"><input type="submit" name="registration_button" value="Registration" class="btn btn-success btn-xs" data-id='2' /><input type="hidden" name="registration_button" value="1" /></div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    <?php } else {?>
                    <div class="row centered mt grid">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                            <h1 class="text-center">Change Password</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<form action="" method="post" class="form-horizontal form-label-left login-form">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="changePass">Change New Password</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"><input type="password" name="password" required="required" class="form-control" id="changePass" placeholder="New Password" /></div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirmPass">Confirm Password</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"><input type="password" name="confirmPass" required="required" class="form-control" id="confirmPass" placeholder="Confirm Password" /></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="item form-group centered">
                                    <div class="col-md-12 col-sm-12 col-xs-12"><input type="submit" name="changePassword" value="Change Passowrd" class="btn btn-success btn-xs" data-id='2' /><input type="hidden" name="changePassword" value="1" /></div>
                                </div>
                                <input type="hidden" name="user_id" value="<?php echo $encode_user_id;?>" />
                            </form>
                            
                        </div>
                    </div>
                    <?php }?>
                    
                </div>
            </div>
		<?php include 'footer.php';?>
		
	</body>
</html>
