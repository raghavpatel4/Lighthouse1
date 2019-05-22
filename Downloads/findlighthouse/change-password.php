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
            	<div class="col-md-8">
                    
                	<div class="box">
                    	<?php include 'user-top-right.php';?>
						<div class="box-header"><h3>Change Password</h3></div>
                        <div class="box-body dashbord-box-body">
                        	
								<?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".trim($_SESSION["user_id"])."'");?>
								
                        	<div class="full-width"><div class="pull-right"><strong>Quickview</strong></div></div>
                            <div class="row">
                            	<div class="col-sm-12">
								    <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data" id="changePasswordForm">
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="old_password">Old Password <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input id="old_password" class="form-control col-md-7 col-xs-12" name="old_password" placeholder="Enter Old Password" required="required" type="password" />
                                        </div>
                                      </div>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new_password">New Password <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input id="new_password" class="form-control col-md-7 col-xs-12" name="new_password" placeholder="Enter New Password" required="required" type="password" />
                                        </div>
                                      </div>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="conf_password">Confirm Password <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input id="conf_password" class="form-control col-md-7 col-xs-12" name="conf_password" placeholder="Enter Confirm Password" required="required" type="password" />
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                          <input id="send" name="save_data" type="submit" class="btn btn-success" value="Change Password" />
                                          <input name="saveData" type="hidden" value="1" />
                                        </div>
                                      </div>
                                        
                                      <input type="hidden" name="user_id" value="<?php echo trim($editMentorArr[0]['id'])?>" />
                                    </form>
                                    
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
        <?php include 'checkUserLoginStatus.php';?>
        <?php include 'footer.php';?>
        <script type="text/javascript">
			$(document).ready(function() {
				$(document).on('submit', '#changePasswordForm', function() {
					//alert('Hi');
					if($('#conf_password').val() == $('#new_password').val()) {
						$.ajax({
						  type: 'post',
						  url: 'checkChangePass.php',
						  data: $(this).serialize(),
						  success: function (response) {
							//alert(response);
							if(response > 0) {
								swal({
								  title: "Sorry!",
								  text: "Your Old Password is wrong please try again.",
								  type: "warning",
								  timer: 4000,
								  showConfirmButton: false
								});
							} else {
								swal({
								  title: "Success!",
								  text: "Your Password is successfully change.",
								  type: "success",
								  timer: 4000,
								  showConfirmButton: false
								}, function(isConfirm){ 
									window.location = '';
								});
							}
						  }
						});
					} else {
						alert('Please Enter Correct Confirm Password.');
						//$('#conf_password').facus();
					}
					return false;
				});
				
			});
		</script>
	</body>
</html>
