	<?php include 'head.php';?>
	</head>
  	<body class="home-page ">
    	<i id="home-page"></i>
        <?php //include 'header.php';?>
        <div class="header-section full_width_section">
        	<div class="row">
            	<div class="col-sm-3 clean-space">
                	<?php include 'new-user-left-menu.php';?>
                </div>
            	<div class="col-sm-9">
                	<div class="box">
                    	<div class="box-head head-icons">
                        	<div class="pull-right">
                        		<a href="" class="setting-opt"><img src="images/setting-icons-1.png" class="icon-imgs" alt="" /></a>
                                <a href="" class="setting-opt"><img src="images/setting-icons-2.png" class="icon-imgs" alt="" /></a>
                                <a href="" class="setting-opt"><img src="images/setting-icons-3.png" class="icon-imgs" alt="" /></a>
                        	</div>
                        </div>
                        <div class="box-header"><h3>Welcome back, Ariana!</h3></div>
                        <div class="box-body dashbord-box-body">
                        	<div class="full-width"><div class="pull-right"><strong>Quickview</strong></div></div>
                            <div class="row">
                            	<div class="col-sm-4">
                                	<a href="">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-1.png" alt="" /></div>
                                        </div>
                                    	<div class="titleBox">Others Like Me</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-2.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">View Common App</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-3.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">College Recommendations</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-4.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">Get Connected</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                        	<div class="imgBox"><img src="images/dashboard-box-img-5.png" alt="" /></div>
                                        </div>
                                    	<div class="titleBox">Where do I fall?</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-6.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">Additional Resources</div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                	<a href="">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/icons/AddIcon.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">Add Quick Link</div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
