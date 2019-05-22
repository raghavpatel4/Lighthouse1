<?php
	/*if(isset($_POST['action']) && $_POST['action'] == 2) {
		$action = 2;
		$actionText = 'Teacher ';
	} else {
		$action = 1;
		$actionText = 'Student ';
	}*/
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="login_errors"></div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<form action="" method="post" class="login-form">
            <div class="row row-close form-group">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" align="left">
				<p><input type="text" class="form-control" id="first_name" placeholder="First Name" /></p>
				<p><input type="text" class="form-control" id="last_name" placeholder="Last Name" /></p>
				<p><input type="text" class="form-control" id="signUpEmailId" placeholder="Email Address" /></p>
				<p><input type="password" class="form-control" id="registration-password" onkeyup="CheckPasswordStrength(this.value)" placeholder="Password" /></p>
				<span id="password_strength"></span>
				<p><input type="hidden" value="0" id="passwordVal" /></p>
				<p><input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" /></p>
              </div>
            </div>
            <div class="row row-close form-group">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" align="left">
                <div id='userIconPreview'><input type="hidden" name="profileIcon" value="" id="profileIcon" /></div>
                <div class="saveProfileLogo" style="display:none;"></div>
              </div>
            </div>
		</form>
        <form id="userIconForm" method="post" class="login-form" enctype="multipart/form-data" action='ajaximage.php'>
	        <div class="row row-close form-group">
	          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" align="left">
	            <label>Profile Picture:</label>
	            <input type="file" name="profile_img" id="profile_img" class="userIcon" />
	          </div>
	        </div>
	    </form>
		<!--<p align="center"><a href="javascript:;" data-id='<?php echo $action?>' title='<?php echo $actionText?> Login' class="popUpButtons">Create Login</a> | <a href="javascript:;" data-id='<?php echo $action?>' title='<?php echo $actionText?> Forgot Password' class="popUpForgotPass">Forgot Password</a></p>-->
		<p align="center"> <input type="submit" name="registration_button" value="Registration" class="signupRegistration btn btn-success" data-id='<?php echo $action;?>' /> </p>
	</div>
</div>
