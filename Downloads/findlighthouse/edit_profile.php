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
						<div class="box-header"><h3>Edit Profile</h3></div>
                        <div class="box-body dashbord-box-body">
                        	<?php
								if(isset($_POST['saveData'])) {
									if($_POST['profileIcon'] == '') {
										$photoUrl = $_POST['oldImg'];
									} else {
										$photoUrl = $_POST['profileIcon'];
									}
									/*if($_REQUEST['password'] != '') {
										$password = md5($_REQUEST['password']);
									} else {
										$password = $_REQUEST['oldPassword'];
									}*/
									$form_data = array(
										'first_name' => trim(addslashes($_POST['first_name'])),
										'last_name' => trim(addslashes($_POST['last_name'])),
										'study' => trim(addslashes($_POST['study'])),
										'school' => trim(addslashes($_POST['school'])),
										'extra_note' => trim(addslashes($_POST['extra_note'])),
										'interests' => trim(addslashes($_POST['interests'])),
										'address' => trim(addslashes($_POST['address'])),
										'position' => trim(addslashes($_POST['position'])),
										'photo' => trim(addslashes($photoUrl)),
										'school_id' => trim(addslashes($_POST['school_id'])),
										'fullname' => trim(addslashes($_POST['first_name'])).' '.trim(addslashes($_POST['last_name']))
									);
									$resturnVal = dbRowUpdate(trim('vpb_users'), $form_data, " WHERE `id` = '".trim($_SESSION['user_id'])."'");
							?>
								<script>
									window.location = '';
								</script>
							<?php
								}
							?>
								<?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".trim($_SESSION["user_id"])."'");?>
								<?php 
									if($resultArr[0]['photo'] == '') {
										$imagePath = 'assets/img/noimage.jpg';
									} else {
										$imagePath = 'vasplus_chat/photos/'.$resultArr[0]['photo'];
									}
								?>
                        	<div class="full-width"><div class="pull-right"><strong>Quickview</strong></div></div>
                            <div class="row">
                            	<div class="col-sm-12">
									<?php $editMentorArr = getCustomResult("select * from `vpb_users` WHERE `id` = '".$resultArr[0]['id']."'");?>
                                      <div class="row form-group">
                                        <div class="col-md-3 col-sm-3 col-xs-12 text-right"><strong>Email Address </strong></div>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><?php echo trim($editMentorArr[0]['email'])?></div>
                                      </div>
                                    <form id="userIconForm" method="post" class="login-form" enctype="multipart/form-data" action='ajaximage.php'>
                                        <div class="row row-close form-group">
                                          <div class="text-right col-md-3 col-sm-3 col-xs-12"><strong>Profile Picture: <span class="required">*</span></strong></div>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" name="profile_img" id="profile_img" class="userIcon" />
                                          </div>
                                        </div>
                                    </form>
                                    <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <div id='userIconPreview'><input type="hidden" name="profileIcon" value="" id="profileIcon" /><img src="<?php echo $imagePath;?>" class="img-responsive" alt="" /></div>
                                          <div class="saveProfileLogo"></div>
                                        </div>
                                      </div>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">First Name <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input id="first_name" class="form-control col-md-7 col-xs-12" name="first_name" placeholder="First Name" required="required" value="<?php echo trim($editMentorArr[0]['first_name'])?>" type="text" />
                                        </div>
                                      </div>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Last Name <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input id="last_name" class="form-control col-md-7 col-xs-12" name="last_name" placeholder="Last Name" required="required" type="text" value="<?php echo trim($editMentorArr[0]['last_name'])?>" />
                                        </div>
                                      </div>
                                      <?php if($editMentorArr[0]['user_type'] == '1') {?>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="school_id">Select School</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php $schoolArr = getCustomResult("select * from `vpb_school` WHERE `status` = '1' order by `id` desc");?>
                                            <select id="school_id" class="form-control col-md-7 col-xs-12" name="school_id" required="required">
                                                <option value="">Select School</option>
                                                <?php for($scl = 0; $scl < count($schoolArr); $scl++) {?>
                                                    <option value="<?php echo $schoolArr[$scl]['id']?>" <?php if($editMentorArr[0]['school_id'] == $schoolArr[$scl]['id']) {?> selected="selected"<?php }?>><?php echo $schoolArr[$scl]['title']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                      </div>
                                      <?php } else {?>
                                        <input type="hidden" name="school_id" value="<?php echo trim($editMentorArr[0]['school_id'])?>" />
                                      <?php }?>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="interests">Interests <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input id="interests" class="form-control col-md-7 col-xs-12" name="interests" placeholder="Interests" required="required" type="text" value="<?php echo trim($editMentorArr[0]['interests'])?>" />
                                        </div>
                                      </div>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="study">Study <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input id="study" class="form-control col-md-7 col-xs-12" name="study" required="required" placeholder="Study" type="text" value="<?php echo trim($editMentorArr[0]['study'])?>" />
                                        </div>
                                      </div>
                                      <div class="item form-group hide">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        	<input id="address" class="form-control col-md-7 col-xs-12" name="address" placeholder="Address" type="text" value="<?php echo trim($editMentorArr[0]['address'])?>" />
                                        </div>
                                      </div>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position">Position</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        	<input id="position" class="form-control col-md-7 col-xs-12" name="position" placeholder="Position" type="text" value="<?php echo trim($editMentorArr[0]['position'])?>" />
                                        </div>
                                      </div>
                                      <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extra_note">Extra Note</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <textarea id="extra_note" class="form-control col-md-7 col-xs-12" name="extra_note" placeholder="Extra Note"><?php echo trim($editMentorArr[0]['extra_note'])?></textarea>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                          <input id="send" name="save_data" type="submit" class="btn btn-success" value="Save Profile" />
                                          <a href="change-password.php" class="btn btn-success">Change Password</a>
                                          <input name="saveData" type="hidden" value="1" />
                                        </div>
                                      </div>
                                        
                                      <input type="hidden" name="user_id" value="<?php echo trim($editMentorArr[0]['id'])?>" />
                                      <input type="hidden" name="oldPassword" value="<?php echo trim($editMentorArr[0]['password'])?>" />
                                      <input type="hidden" value="<?php echo $resultArr[0]['photo']?>" name="oldImg" />
                                    </form>
                                    
                                </div>
                            	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'user-footer.php';?>
        </div>
	  	<?php include 'checkUserLoginStatus.php';?>
        <?php include 'footer.php';?>
        <?php //include 'checkUserLoginStatus.php';?>
	</body>
</html>
