<?php include 'head.php';?>
</head>
<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <?php include 'nav-bar.php';?>
    <?php include 'header.php';?>
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="row x_title">
        <div class="col-md-12">
          <h3>Edit Mentor</h3>
        </div>
      </div>
	  <?php $editMentorArr = getCustomResult("select * from `vpb_users` WHERE `id` = '".$_REQUEST['id']."'");?>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_content">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                  <div class="item form-group">
                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">Email Address </div>
                    <div class="col-md-6 col-sm-6 col-xs-12"><?php echo trim($editMentorArr[0]['email'])?></div>
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
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password" class="form-control col-md-7 col-xs-12" name="password" placeholder="Password" type="password" />
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="interests">Interests</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="interests" class="form-control col-md-7 col-xs-12" name="interests" placeholder="Interests" type="text" value="<?php echo trim($editMentorArr[0]['interests'])?>" />
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
                      <input id="send" name="save_data" type="submit" class="btn btn-success" value="Submit" />
                      <input name="save_data" type="hidden" value="1" />
                    </div>
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo trim($editMentorArr[0]['id'])?>" />
                  <input type="hidden" name="oldPassword" value="<?php echo trim($editMentorArr[0]['password'])?>" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <?php 
		//echo '<pre>';print_r($_POST);
		if(isset($_POST['save_data'])) {
			if($_REQUEST['password'] != '') {
				$password = md5($_REQUEST['password']);
			} else {
				$password = $_REQUEST['oldPassword'];
			}
			$form_data = array(
				'first_name' => trim(addslashes($_POST['first_name'])),
		    	'last_name' => trim(addslashes($_POST['last_name'])),
				'interests' => trim(addslashes($_POST['interests'])),
				'extra_note' => trim(addslashes($_POST['extra_note'])),
				'fullname' => trim(addslashes($_POST['first_name'])).' '.trim(addslashes($_POST['last_name'])),
				'password' => trim(addslashes($password))
			);
			$user_id = dbRowInsert(trim('vpb_users'), $form_data);
			if($user_id > 0) {			
				$form_data_1 = array(
					'username' => $user_id
				);
				dbRowUpdate(trim('vpb_users'), $form_data_1, "WHERE `id` = '".$user_id."'");
			}
		?>
      	<script>
			window.location = 'mentor-list.php';
		</script>
      <?php }?>
      <?php include 'footer.php';?>
      <!-- /page content -->
    </div>
  </div>
</div>
<?php include 'footer-js.php';?>
<!-- /footer content -->
</body>
</html>