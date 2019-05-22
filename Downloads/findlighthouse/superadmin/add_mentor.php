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
          <h3>Add New Mentor</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_content">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">First Name <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="first_name" class="form-control col-md-7 col-xs-12" name="first_name" placeholder="First Name" required="required" type="text" />
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Last Name <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="last_name" class="form-control col-md-7 col-xs-12" name="last_name" placeholder="Last Name" required="required" type="text" />
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="checkSchoolEmailId">Email Address <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="checkUserEmailId" data-id="2" class="form-control col-md-7 col-xs-12" name="email_id" placeholder="Email Address" required="required" type="email" />
                      <div id="email_errors"></div>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password" class="form-control col-md-7 col-xs-12" name="password" placeholder="Password" type="password" required="required" />
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="interests">Interests</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="interests" class="form-control col-md-7 col-xs-12" name="interests" placeholder="Interests" type="text" />
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extra_note">Extra Note</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea id="extra_note" class="form-control col-md-7 col-xs-12" name="extra_note" placeholder="Extra Note"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                      <input id="send" name="save_data" type="submit" class="btn btn-success" value="Submit" />
                      <input name="save_data" type="hidden" value="1" />
                    </div>
                  </div>
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
			$password1 = trim($_REQUEST['password']);
			$password = md5($password1);
			$email_add = trim(addslashes($_POST['email_id']));
			$first_name = trim(addslashes($_POST['first_name']));
			$last_name = trim(addslashes($_POST['last_name']));
			$full_name = trim(addslashes($_POST['first_name'])).' '.trim(addslashes($_POST['last_name']));
			
			$form_data = array(
				'first_name' => $first_name,
		    	'last_name' => $last_name,
				'email' => $email_add,
				'interests' => trim(addslashes($_POST['interests'])),
				'extra_note' => trim(addslashes($_POST['extra_note'])),
				'fullname' => $full_name,
				'user_type' => '2',
				'status' => '1',
				'org_pass' => $password1,
				'password' => trim(addslashes($password))
			);
			$user_id = dbRowInsert(trim('vpb_users'), $form_data);
			if($user_id > 0) {
				$to = $email_add;
				$subject = "Your New Mentor Account Active in Lighthouse!";
				
				$htmlContent = '<html>
				<body>
					<p align="center"><img src="'.$webUrl.'assets/img/site-logo.png" alt="Lighthouse" /></p>
					<h1>Your New Mentor Account Active in Lighthouse!</h1>
					<p>Hello '.$full_name.',<br />Your Mentor Account is Now Active.</p>
					<p>So, Now You can Login and Create All student activites.</p>
					<p>Email Address:- '.$email_add.'<br />Password:- '.$password1.'</p>
					<p><a href="'.$webUrl.'" target="_blank">Click Here!</a></p>
					<p><br /></p>
					<h4>Questions?</h4>
					<p>24 / 7 Days support : hello@findlighthouse.com</p>
				</body>
				</html>';
				
				// Set content-type header for sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				// Additional headers
				$headers .= 'From: '.$first_name.' <'.$email_add.'>' . "\r\n";
				$headers .= 'Cc: karan@vovance.com' . "\r\n";
				//$headers .= 'Bcc: welcome2@example.com' . "\r\n";
				
				// Send email
				if(mail($to,$subject,$htmlContent,$headers)):
					$successMsg = 'Email has sent successfully.';
				else:
					$errorMsg = 'Email sending fail.';
				endif;
				
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