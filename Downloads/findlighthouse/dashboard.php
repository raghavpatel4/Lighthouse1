	<?php include 'head.php';?>
    <?php include 'checkUserLogin.php';?>
	</head>
  	<body class="home-page black-bg">
    	<i id="home-page"></i>
        <?php //include 'header.php';?>
        <div class="header-section full_width_section container white-bg">
        	<div class="row">
            	<div class="col-md-4 clean-space">
                	<?php include 'new-user-left-menu.php';?>
                </div>
            	<div class="col-md-8 col-xs-12">
                	<div class="box">
                    	<?php include 'user-top-right.php';?>
                        <div class="box-header"><h3>Welcome back, <?php echo $resultArr[0]['first_name']?> <?php echo $resultArr[0]['last_name']?>!</h3></div>
                        <div class="box-body dashbord-box-body">
                        	<div class="full-width"><div class="pull-right"><strong>Quickview</strong></div></div>
                            <div class="row">
                            	<div class="col-sm-4">
                                	<a href="#">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-1.png" alt="" /></div>
                                        </div>
                                    	<div class="titleBox">Others Like Me</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="#">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-2.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">View Common App</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="#">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-3.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">College Recommendations</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="#">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-4.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">Get Connected</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="#">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                        	<div class="imgBox"><img src="images/dashboard-box-img-5.png" alt="" /></div>
                                        </div>
                                    	<div class="titleBox">Where do I fall?</div>
                                    </div>
                                    </a>
                                </div>
                            	<div class="col-sm-4">
                                	<a href="#">
                                	<div class="imgBoxSection">
                                    	<div class="imgTable">
                                    		<div class="imgBox"><img src="images/dashboard-box-img-6.png" alt="" /></div>
                                    	</div>
                                        <div class="titleBox">Additional Resources</div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                	<a href="#">
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
            
            <?php include 'user-footer.php';?>
            
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
        <?php include 'checkUserLoginStatus.php';?>
		<?php include 'footer.php';?>
        <?php include 'user-details-alert.php';?>
        <?php //include 'checkUserLoginStatus.php';?>
        <script type="text/javascript">
			$(document).ready(function() {
			});
		</script>
	</body>
</html>
