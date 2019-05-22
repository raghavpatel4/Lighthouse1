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
                    window.location = 'messaging.php';
                </script>
			<?php			
			}
			$action = 1;
	  	?>
        <div class="body-section">
            <div class="container">
                <div class="row centered mt grid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                        <h1 class="text-center">Student Registration</h1>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="login_errors"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                                <form action="" method="post" class="form-horizontal form-label-left login-form">
                                	<div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="school_id">Select School</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php $schoolArr = getCustomResult("select * from `vpb_school` WHERE `status` = '1' order by `id` desc");?>
                                            <select id="school_id" class="form-control col-md-7 col-xs-12" name="school_id" required="required">
                                                <option value="0">Select School</option>
                                                <?php for($scl = 0; $scl < count($schoolArr); $scl++) {?>
                                                    <option value="<?php echo $schoolArr[$scl]['id']?>"><?php echo $schoolArr[$scl]['title']?></option>
                                                <?php }?>
                                            </select>
                                    	</div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">First Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="text" class="form-control" id="first_name" placeholder="First Name" /></div>
                                 	</div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Last Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="text" class="form-control" id="last_name" placeholder="Last Name" /></div>
                                 	</div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="std_unique_id">Std Unique ID</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="text" class="form-control" id="std_unique_id" placeholder="Std Unique ID" /></div>
                                 	</div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="signUpEmailId">Email Address</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="text" class="form-control" id="signUpEmailId" placeholder="Email Address" /></div>
                                 	</div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="registration-password">Password</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="password" class="form-control" id="registration-password" onKeyUp="CheckPasswordStrength(this.value)" placeholder="Password" /><span id="password_strength"></span></div>
                                 	</div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="school_id">Confirm Password</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" /></div>
                                 	</div>
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="interests">Interests</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="text" class="form-control" id="interests" placeholder="Interests" /></div>
                                 	</div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="study">Study</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="text" class="form-control" id="study" placeholder="Study" /></div>
                                 	</div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extra_note">Extra Note</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><textarea class="form-control" id="extra_note" placeholder="Extra Note"></textarea></div>
                                 	</div>

                                    <div class="row row-close form-group">
                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" align="left">
                                        <input type="hidden" value="0" id="passwordVal" />
                                      </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        	<div id='userIconPreview'><input type="hidden" name="profileIcon" value="" id="profileIcon" /></div>
                                        	<div class="saveProfileLogo" style="display:none;"></div>
                                        </div>
                                 	</div>
                                    <div class="item form-group row">
                                    	<div class="col-sm-3">
                                        	<div class="pre-define-logo-box">
                                                <input type="radio" class="pre-define-logo" name="img-icon" value="1" id="img-icon-1" checked />
                                                <label for="img-icon-1">
                                                	<img src="images/user-icon-1.png" alt="" />
                                                    <div class="gradient"></div>
                                                </label>
                                        	</div>
                                        </div>
                                    	<div class="col-sm-3">
                                        	<div class="pre-define-logo-box">
                                                <input type="radio" class="pre-define-logo" name="img-icon" value="2" id="img-icon-2" />
                                                <label for="img-icon-2">
                                                	<img src="images/user-icon-2.png" alt="" />
                                                    <div class="gradient"></div>
                                               	</label>
                                        	</div>
                                        </div>
                                    	<div class="col-sm-3">
                                        	<div class="pre-define-logo-box">
                                                <input type="radio" name="img-icon" class="pre-define-logo" value="3" id="img-icon-3" />
                                                <label for="img-icon-3">
                                                	<img src="images/user-icon-3.png" alt="" />
                                                    <div class="gradient"></div>
                                               	</label>
                                            </div>
                                        </div>
                                    	<div class="col-sm-3">
                                        	<div class="pre-define-logo-box">
                                                <input type="radio" name="img-icon" class="pre-define-logo" value="4" id="img-icon-4" />
                                                <label for="img-icon-4">
                                                	<img src="images/icons/AddIcon.png" alt="" />
                                                    <div class="gradient"></div>
                                               	</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                                <form id="userIconForm" method="post" class="form-horizontal form-label-left login-form" enctype="multipart/form-data" action='ajaximage.php'>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ProfilePicture">Profile Picture</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="profile_img" id="profile_img" class="userIcon" /></div>
                                 	</div>
                                </form>
                                <div class="clearfix"></div>
                                <div class="item form-group centered">
                                    <div class="col-md-12 col-sm-12 col-xs-12"><input type="submit" name="registration_button" value="Registration" class="signupRegistration btn btn-success btn-xs" data-id='1' /></div>
                                </div>
                                
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
		<?php include 'footer.php';?>
		
		<script type="text/javascript">
			$(document).ready(function() {
				$(document).on('click', '.signupRegistration', function () {
			    	var action = $(this).attr('data-id');

					var first_name = $('#first_name').val();
					var last_name = $('#last_name').val();
					var email_id = $('#signUpEmailId').val();
					var password = $('#registration-password').val();
					var confirm_password = $('#confirm-password').val();
					var profileIcon = $('#profileIcon').val();
					var std_unique_id = $('#std_unique_id').val();
					var interests = $('#interests').val();
					var extra_note = $('#extra_note').val();
					var school_id = $('#school_id').val();
					var study = $('#study').val();
					
					if(school_id == '0') {
						alert('Please Select Your School.');
						$('#school_id').focus();
					} else if(first_name == '') {
						alert('Please Enter Your First Name.');
						$('#first_name').focus();
					} else if(last_name == '') {
						alert('Please Enter Your Last Name.');
						$('#last_name').focus();
					} else if(std_unique_id == '') {
						alert('Please Enter Std. Unique ID.');
						$('#std_unique_id').focus();
					} else if(email_id == '') {
						alert('Please Enter Your Email Address.');
						$('#signUpEmailId').focus();
					} else if(password.length < 8) {
						alert('Password Should be Minimum 8 Characters.');
						$('#registration-password').focus();
					} else if($('#passwordVal').val() == 0) {
						alert('Password must contain at least one uppercase (A-Z) and one lowercase (a-z) and one number and one special character!');
						$('#registration-password').focus();
					} else if(password != confirm_password) {
						alert('Please Enter Correct Confirm Password.');
						$('#registration-password').focus();
					/*} else if(interests == '') {
						alert('Please Enter Your Interests.');
						$('#interests').focus();
					} else if(study == '') {
						alert('Please Enter Your Study.');
						$('#study').focus();
					} else if(extra_note == '') {
						alert('Please Enter Your Extra Note.');
						$('#extra_note').focus();*/
					} else {
						$.ajax({
				        	type: 'POST',
						   	url: 'create-new-registration.php',
						   	data: 'action='+action+'&email_id='+email_id+'&password='+password+'&first_name='+first_name+'&last_name='+last_name+'&profileIcon='+profileIcon+'&study='+study+'&extra_note='+extra_note+'&interests='+interests+'&std_unique_id='+std_unique_id+'&school_id='+school_id,
						   	success: function(data) {
						   		//$('#footers').html(data);
						   		if(data == 0) {
									swal({
									  title: "Wrong!",
									  text: "Sorry, Your Data is wrong. Please Try again.",
									  type: "warning",
									  confirmButtonColor: "#DD6B55",
									  confirmButtonText: "Oh, Ok"
									});
									//$("#login_errors").html('Sorry, Your Data is wrong. Please Try again.');
								} else {
									$("#login_errors").html('Your Account is Successfully Created. To activate it click on the confirmation link sent on your registered email ID.');
									$("input[type=text], input[type=password], input[type=file], textarea").val("");
									$('.removeImg').hide();
									$('.preview_img').hide();
									$('#password_strength').html('');
									/*if(action == '1') {
										window.location = 'user-profile.php';	
									} else {
										window.location = 'teacher-profile.php';	
									}*/
									
									swal({
									  title: "Your Account is Successfully Created.",
									  text: "To activate it click on the confirmation link sent on your registered email ID.",
									  type: "success",
									  confirmButtonColor: "#DD6B55",
									  confirmButtonText: "Go to Home Page"
									},
									function(){
									  window.location = 'index.php#login';
									});
								}
						    }
						});	
					}
		    	});
		    });
		</script>
	</body>
</html>
