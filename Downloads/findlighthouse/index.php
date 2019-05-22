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
        <div class="slider-section">
            <div class="container">
                <ul id="slider_1">
                    <li>
                    	<img src="images/slider/1.jpg" alt="" />
                     	<div class="slide-desc">
                            <div class="slider-img"><img src="images/new-logo.png" alt="" /></div>
                            <p>Guiding Future Leaders Today.</p>
                      	</div>
                    </li>
                    <li>
                    	<img src="images/slider/2.jpg" alt="" />
                       	<div class="slide-desc">
                            <div class="slider-img"><img src="images/new-logo.png" alt="" /></div>
                            <p>Guiding Future Leaders Today.</p>
                      	</div>
                    </li>
                    <li>
                    	<img src="images/slider/3.jpg" alt="" />
                        <div class="slide-desc">
                            <div class="slider-img"><img src="images/new-logo.png" alt="" /></div>
                            <p>Guiding Future Leaders Today.</p>
                      	</div>
                    </li>
                    <li>
                    	<img src="images/slider/4.jpg" alt="" />
                      	<div class="slide-desc">
                            <div class="slider-img"><img src="images/new-logo.png" alt="" /></div>
                            <p>Guiding Future Leaders Today.</p>
                      	</div>
                    </li>
                    <li>
                    	<img src="images/slider/5.jpg" alt="" />
                    	<div class="slide-desc">
                            <div class="slider-img"><img src="images/new-logo.png" alt="" /></div>
                            <p>Guiding Future Leaders Today.</p>
                      	</div>
                    </li>
                </ul>
         	</div>
		</div>
        
		<div class="body-section">
    		<i id="about"></i>
            <div class="container">
                <div class="row centered mt grid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                        <h2 class="text-center box-title"><span>About Us</span></h2>
                        <!--<p><img src="assets/img/about-border.png" class="border-img" alt="" /></p>-->
                    </div>
                </div>
                <div class="row centered mt grid">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3 class="box-title text-left blue-color">How did we get started?</h3>
                        <div class="box-content text-left">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3 class="text-right box-title blue-color">What is Lighthouse?</h3>
                        <div class="text-right box-content">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                      	</div>
                    </div>
                </div>
                
                <div class="row centered mt grid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2 class="box-title text-center"><span>Our Mission</span></h2>
                        <div class="box-content">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            <p><a href="">Learn More</a></p>
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
        
        <div class="black-section expect-box">
    		<i id="expect"></i>
            <div class="container">
                
                <div class="row centered">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3 class="box-title text-left blue-color">What to expect?</h3>
                        <div class="box-content text-left">
                        	<ul>
                            	<li>Easy to use portals</li>
                            	<li>College Assesments</li>
                            	<li>Mentor Messaging</li>
                            	<li>Where do you stand?</li>
                            	<li>Transcripts</li>
                            	<li>Reccomendation Letter Management</li>
                            	<li>Customizable Check Lists</li>
                            	<li>Interactive Callendars</li>
                            	<li>and MORE!</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="screenShotBox">
                        	<ul class="bxslider">
                              <li><img src="images/screenshots/img-1.png" /></li>
                              <li><img src="images/screenshots/img-2.png" /></li>
                              <li><img src="images/screenshots/img-3.png" /></li>
                              <li><img src="images/screenshots/img-4.png" /></li>
                              <li><img src="images/screenshots/img-5.png" /></li>
                            </ul>
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
        
        <div class="tema-section">
        	<i id="the-team"></i>
            <div class="container">
            	<div class="row grid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                        <h2 class="text-center box-title"><span>Meet The Team</span></h2>
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
            <div class="container login-sections">
            	
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
                                <p><a href="forgot-password.php" data-id="1" title="Lost your password?">Forgot username or password?</a></p>
                                <div class="form-group">
                                	<input type="submit" class="btn btn-primary" value="login" name="login" />
                                </div>
                                <p>
                                	<a href="student_registration.php" title="Student Registration">Student Registration</a><br />
                                	<a href="mentor_registration.php" title="Request form Mentor Account">Request Mentor Account</a>
                              	</p>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12"></div>
                </div>
                
            </div>
        </div>
		<?php }?>

       	<div class="contact-section">
        	<i id="contact"></i>
            <div class="container">
                <?php include 'contact-section.php';?>
            </div>
        </div>
        
        <?php include 'footer.php';?>
        <a href="javascript:" id="return-to-top" style="display: none;"><i class="fa fa-chevron-up"></i></a>

        <script src="assets/homeSlider/src/skdslider.min.js" type="text/javascript"></script>
		<link href="assets/homeSlider/src/skdslider.css" rel="stylesheet" type="text/css" />

        <script src="assets/bxslider/jquery.bxslider.js" type="text/javascript"></script>
		<link href="assets/bxslider/jquery.bxslider.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
			$(document).ready(function() {
				$(window).scroll(function() {
					if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
						$('#return-to-top').fadeIn(200);    // Fade in the arrow
					} else {
						$('#return-to-top').fadeOut(200);   // Else fade out the arrow
					}
				});
				$('#return-to-top').click(function() {      // When arrow is clicked
					$('body,html').animate({
						scrollTop : 0                       // Scroll to top of body
					}, 500);
				});
				
				$('#slider_1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':false,'showPlayButton':false,'autoSlide':true,'animationType':'fading'});
				
				$('.bxslider').bxSlider({
					auto: true,
					pager:false,
					minSlides: 2,
					maxSlides: 2,
					moveSlides: 2,
					slideWidth: 320,
					slideMargin: 10,
					speed: 800,
				});
				
			});
		</script>
	</body>
</html>
