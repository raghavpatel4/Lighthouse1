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
	              <h3>Edit Profile </h3>
	            </div>
	        </div>
	        <?php $resultArr = getRowResult(trim('tbl_admin'), " WHERE `id` = '1'");?>
			<div class="row">
		      <div class="col-md-12 col-sm-12 col-xs-12">
		        <div class="x_content">
		        	<div class="row">
			          <div class="col-md-12 col-sm-12 col-xs-12">
			            <form method="post" class="form-horizontal form-label-left">

		                    <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="full_name">Full Name <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="full_name" class="form-control col-md-7 col-xs-12" name="full_name" placeholder="Admin" value="<?php echo $resultArr[0]['full_name'] ?>" required="required" type="text" />
		                      </div>
		                    </div>
		                    <div class="ln_solid"></div>
		                    <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_id">Email ID <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="email_id" class="form-control col-md-7 col-xs-12" name="email_id" placeholder="Email ID" value="<?php echo $resultArr[0]['email_id'] ?>" required="required" type="text" />
		                      </div>
		                    </div>
		                    <div class="ln_solid"></div>
		                    <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password</label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="password" class="form-control col-md-7 col-xs-12" name="password" placeholder="Password" type="password" />
		                      </div>
		                    </div>

		                    <div class="form-group">
		                      <div class="col-md-6 col-md-offset-3">
		                        <input id="send" name="save_data" type="submit" class="btn btn-success" value="Submit" />
		                        <input name="save_data" type="hidden" value="1" />
		                      </div>
		                    </div>
		                    <input type="hidden" name="old_password" value="<?php echo $resultArr[0]['password']?>" />
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
					$password = $_REQUEST['old_password'];
				}
				$form_data = array(
				    'full_name' => trim(addslashes($_POST['full_name'])),
				    'email_id' => trim(addslashes($_POST['email_id'])),
				    'password' => trim(addslashes($password))
				);
				$resturnVal = dbRowUpdate(trim('tbl_admin'), $form_data, "WHERE `id` = '1'");
		?>
				<script>
					window.location = '';
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
