	<?php include 'head.php';?>
	</head>
  	<body class="inner-page">
	  	<?php include 'header.php';?>
        <div class="body-section">
            <div class="container">
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
                        'photo' => trim(addslashes($photoUrl)),
                        'school_id' => trim(addslashes($_POST['school_id'])),
						'fullname' => trim(addslashes($_POST['first_name'])).' '.trim(addslashes($_POST['last_name']))
                    );
                    $resturnVal = dbRowUpdate(trim('vpb_users'), $form_data, " WHERE `id` = '".$_SESSION['user_id']."'");
            ?>
                <script>
                    window.location = '';
                </script>
            <?php
                }
            ?>
                <?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>
                <?php 
                    if($resultArr[0]['photo'] == '') {
                        $imagePath = 'assets/img/noimage.jpg';
                    } else {
                        $imagePath = 'vasplus_chat/photos/'.$resultArr[0]['photo'];
                    }
                ?>
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"><?php include 'user-menu.php';?></div>
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
                        <h3>Edit Profile</h3>
	  					<?php $editMentorArr = getCustomResult("select * from `vpb_users` WHERE `id` = '".$resultArr[0]['id']."'");?>
                          <div class="row form-group">
                            <div class="col-md-3 col-sm-3 col-xs-12 text-right"><strong>Email Address </strong></div>
                            <div class="col-md-6 col-sm-6 col-xs-12"><?php echo trim($editMentorArr[0]['email'])?></div>
                          </div>
                        <form id="userIconForm" method="post" class="login-form" enctype="multipart/form-data" action='ajaximage.php'>
                            <div class="row row-close form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile Picture: <span class="required">*</span></label>
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
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extra_note">Extra Note</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <textarea id="extra_note" class="form-control col-md-7 col-xs-12" name="extra_note" placeholder="Extra Note"><?php echo trim($editMentorArr[0]['extra_note'])?></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                              <input id="send" name="save_data" type="submit" class="btn btn-success btn-xs" value="Save Profile" />
                              <input name="saveData" type="hidden" value="1" />
                            </div>
                          </div>
                            
                          <input type="hidden" name="user_id" value="<?php echo trim($editMentorArr[0]['id'])?>" />
                          <input type="hidden" name="oldPassword" value="<?php echo trim($editMentorArr[0]['password'])?>" />
                          <input type="hidden" value="<?php echo $resultArr[0]['photo']?>" name="oldImg" />
                        </form>
                        
                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                </div>
            </div>
		</div>
		
		<?php include 'footer.php';?>
		
		<!--<script type="text/javascript"> jQuery.noConflict(); </script>
		<link rel="stylesheet" type="text/css" href="vasplus_chat/css/vasplus_chat.css">
		<script type="text/javascript" src="vasplus_chat/js/jQuery_v1.8.3.js"></script> 
		<script type="text/javascript" src="vasplus_chat/js/jquery.cookie.js"></script>
		<script type="text/javascript" src="vasplus_chat/js/jquery.eventsource.js"></script>
		<script type="text/javascript" src="vasplus_chat/js/vasplus_chat.js"></script>-->
		
		<?php
			//$_SESSION["from_username"] = 'victor'; // Set your logged in user username as it is in your database users table here
			/*$userName = '';
			if(isset($_SESSION["from_username"])) {
				//$_SESSION["from_username"] = isset($_GET["username"]) ? strip_tags($_GET["username"]) : 'victor'; // This is a demo for username passed to the URL	
				//$_SESSION["from_username"] = $_SESSION['first_name'].' '.$_SESSION['last_name'];;
				echo '<input type="hidden" id="from_username_identity" value="'.strip_tags($_SESSION["from_username"]).'" />';
			}*/
		?>
	</body>
</html>
