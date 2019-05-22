	<?php include 'head.php';?>
	</head>
  	<body class="home-page">
    	<i id="home-page"></i>
        <?php include 'header.php';?>
	  	<?php 
	  		/*if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0) {
				if($_SESSION["user_type"] == 1) {
		?>
					<script>
						window.location = 'user-profile.php';
					</script>
		<?php
				} else {
		?>
					<script>
						window.location = 'teacher-profile.php';
					</script>
		<?php			
				}
			}*/
	  	?>
		<div class="body-section">
    		<i id="about"></i>
            <div class="container">
                <div class="row centered mt grid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                        <h2 class="text-center box-title">Abount</h2>
                        <p><img src="assets/img/about-border.png" class="border-img" alt="" /></p>
                    </div>
                </div>
                <div class="row centered mt grid">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h2 class="box-title text-left">History</h2>
                        <div class="box-content text-left">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p><p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h2 class="text-right box-title">Our Vision</h2>
                        <div class="text-right box-content">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p><p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                      	</div>
                    </div>
                </div>
                
                <!--<div class="row centered mt grid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                        <h1 class="text-center">Lighthouse</h1>
                        <p><a href="javascript:;" class="btn btn-success popUpButtons" data-id='1' title="Student Login">Student Login</a> | <a href="javascript:;" class="btn btn-success popUpButtons" title="Teacher Login" data-id='2'>Teacher Login</a></p>
                        <p><a href="javascript:;" class="aboutPopUpButtons btn btn-link" data-title='about.php'>About</a></p>
                    </div>
                </div>-->
                
            </div>
		</div>
		<?php
			if(isset($_REQUEST['confirm_id'])) {
				$encode_user_id = base64_decode($_REQUEST['confirm_id']);

				$checkUserActive = getRowResult(trim('vpb_users'), " WHERE `id` = '".$encode_user_id."'");
				if(count($checkUserActive) > 0) {
					$form_data_1 = array(
						'as_active' => 1,
						'status' => 1
					);
					$resturnVal_1 = dbRowUpdate(trim('vpb_users'), $form_data_1, "WHERE `id` = '".$encode_user_id."'");
				}
			}
		?>
        <?php if(!isset($_SESSION["user_id"])) {?>
       	<div class="blue-section">
        	<i id="login"></i>
            <div class="container">
            	
                <div class="row centered mt grid">
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12"></div>
                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 centered">
                    	<div class="login-box">
                            <h2 class="text-center box-title">Login</h2>
                            <?php if(isset($_REQUEST['confirm_id'])) {?>
                                <div class="alert alert-success">
                                  <strong>Congratulations!</strong> Your Account is active now.
                                </div>
                            <?php }?>
                            <form action="" method="post" class="LoginForm">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="username" placeholder="username" name="username" required />
                                </div>
                            	<div class="form-group">
                                	<input type="password" class="form-control" id="password" placeholder="password" name="password" required />
                                </div>
                                <div class="form-group">
                                	<input type="submit" class="btn btn-primary btn-xs" value="login" name="login" />
                                </div>
                                <p>
                                	<a href="forgot-password.php" data-id="1" title="Lost your password?">Lost your password?</a><br />
                                	<a href="student_registration.php" title="Student Registration">Student Registration</a><br />
                                	<a href="mentor_registration.php" title="Request form Mentor Account">Request form Mentor Account</a>
                              	</p>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12"></div>
                </div>
                
            </div>
        </div>
		<?php }?>

       	<div class="black-section">
        	<i id="the-team"></i>
            <div class="container">
            	<div class="row grid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                        <h2 class="text-center box-title">The Team</h2>
                        <p><img src="assets/img/about-border.png" class="border-img" alt="" /></p>
                    </div>
                </div>
                
                <div class="row grid">
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="team-box centered">
                        	<p><img src="assets/img/dummy-icon.png" class="border-img" alt="" /></p>
                            <p class="box-title">The Team<br><span class="team-type">Founder/CEO</span></p>
                            <p class="">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                    	</div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="team-box centered">
                        	<p><img src="assets/img/dummy-icon.png" class="border-img" alt="" /></p>
                            <p class="box-title">The Team<br><span class="team-type">CEO</span></p>
                            <p class="">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                    	</div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="team-box centered">
                        	<p><img src="assets/img/dummy-icon.png" class="border-img" alt="" /></p>
                            <p class="box-title">The Team<br><span class="team-type">CEO</span></p>
                            <p class="">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                    	</div>
                    </div>
                    
                </div>
                
            </div>
        </div>

       	<div class="blue-section">
        	<i id="contact"></i>
            <div class="container">
            	
                <div class="row centered mt grid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                        <h2 class="text-center box-title">Contact</h2>
                        <p><img src="assets/img/about-border.png" class="border-img" alt="" /></p>
                        <h3>Let's Transform Lives, Together.</h3>
                        <p>Fill out this form today, or feel free to drop  </p>
                    </div>
                </div>
                
                <div class="row centered mt grid">
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12"></div>
                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 centered">
                    	<div class="contact-box">
                            <form action="" method="post" class="contactUsForm">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="contactName" placeholder="Your Name*" name="contactName" required />
                                </div>
                            	<div class="form-group">
                                	<input type="email" class="form-control" id="contactEmail" placeholder="Your Email*" name="contactEmail" required />
                                </div>
                            	<div class="form-group">
                                	<textarea class="form-control" id="contactMsg" placeholder="Your Message*" name="contactMsg" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                	<input type="submit" class="btn btn-primary btn-xs" value="Send" name="send" />
                                </div>
                            </form>
                            <p class="text-center"><a href=""><span class="big-icons"><i class="fa fa-mobile" aria-hidden="true"></i></span> (123) - 456 - 7890</a></p>
                            <p class="text-center"><a href=""><span class="big-icons"><i class="fa fa-envelope" aria-hidden="true"></i></span> hello@findlighthouse.com</a></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12"></div>
                </div>
                
            </div>
        </div>
        
        <?php include 'footer.php';?>
        <script type="text/javascript">
			$(document).ready(function() {
				$(document).on('submit', '.LoginForm', function() {
					//alert('Hi');
					$.ajax({
					  type: 'post',
					  url: 'new-login.php',
					  data: $(this).serialize(),
					  success: function (response) {
					  	if(response == 'Wrong') {
							swal({
							  title: "Sorry!",
							  text: "Your Email Address and Password are wrong please try again.",
							  type: "warning",
							  timer: 4000,
							  showConfirmButton: false
							});
						} else {
							window.location = 'edit_profile.php';
						}
					  }
					});
					return false;
				});
				
				$(document).on('submit', '.contactUsForm', function() {
					//alert('Hi');
					$.ajax({
					  type: 'post',
					  url: 'contact-mail.php',
					  data: $(this).serialize(),
					  success: function (response) {
					  	if(response == '1') {
							swal({
							  title: "Thank you!",
							  text: "Your Email Address has been successfully sent.",
							  type: "success",
							  timer: 4000,
							  showConfirmButton: false
							});
						} else {
							swal({
							  title: "Sorry!",
							  text: "Your Email Address not sent please try again.",
							  type: "warning",
							  timer: 4000,
							  showConfirmButton: false
							});
						}
					  }
					});
					return false;
				});
			});
		</script>
	</body>
</html>
