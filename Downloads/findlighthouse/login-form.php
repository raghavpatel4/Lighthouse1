<?php
	if(isset($_POST['action']) && $_POST['action'] == 2) {
		$action = 2;
		$actionText = 'Teacher ';
		$actionUrl = 'teacher_registration.php';
	} else {
		$action = 1;
		$actionText = 'Student ';
		$actionUrl = 'student_registration.php';
	}
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="login_errors"></div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<form action="" method="post" class="login-form">
			<input type="text" class="form-control" name="email" id="login-email" placeholder="Email Address" />
			<input type="password" class="form-control" name="password" id="login-password" placeholder="Password" />
		</form>
		<!--<p align="center"><a href="javascript:;" data-id='<?php echo $action?>' title='<?php echo $actionText?> Sign Up' class="popUpRegistration">Create New Account</a> | <a href="javascript:;" data-id='<?php echo $action?>' title='<?php echo $actionText?> Forgot Password' class="popUpForgotPass">Forgot Password</a></p>-->
		<p align="center"><a href="<?php echo $actionUrl;?>" data-id='<?php echo $action?>' title='<?php echo $actionText?> Sign Up'>Create New Account</a> | <a href="javascript:;" data-id='<?php echo $action?>' title='<?php echo $actionText?> Forgot Password' class="popUpForgotPass">Forgot Password</a></p>
	</div>
</div>
