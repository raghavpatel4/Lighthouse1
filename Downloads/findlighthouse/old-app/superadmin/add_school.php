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
	              <h3>Add New School</h3>
	            </div>
	        </div>
	        <?php $countryArr = getCustomResult("select * from `vpb_country` WHERE `country_id` > '0'");?>
			<div class="row">
		      <div class="col-md-12 col-sm-12 col-xs-12">
		        <div class="x_content">
		        	<div class="row">
			          <div class="col-md-12 col-sm-12 col-xs-12">
			            <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">

		                    <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="title" class="form-control col-md-7 col-xs-12" name="title" placeholder="School Title" required="required" type="text" />
		                      </div>
		                    </div>
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <textarea id="description" class="form-control col-md-7 col-xs-12" rows="10" name="description" placeholder="School Description" required="required"></textarea>
		                      </div>
		                    </div>
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <textarea id="address" class="form-control col-md-7 col-xs-12" name="address" placeholder="School Address" required="required"></textarea>
		                      </div>
		                    </div>
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="city" class="form-control col-md-7 col-xs-12" name="city" placeholder="City" required="required" type="text" />
		                      </div>
		                    </div>
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">State <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="state" class="form-control col-md-7 col-xs-12" name="state" placeholder="State" required="required" type="text" />
		                      </div>
		                    </div>
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Country <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <select id="country" class="form-control col-md-7 col-xs-12" name="country">
                                	<?php for($cou = 0; $cou < count($countryArr); $cou++) {?>
                                		<option value="<?php echo $countryArr[$cou]['country_id']?>" <?php if($countryArr[$cou]['country_id'] == '223') {?> selected="selected" <?php }?>><?php echo $countryArr[$cou]['country_name']?></option>
                                    <?php }?>
                                </select>
		                      </div>
		                    </div>
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">School Logo <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="img_logo" name="img_logo" required="required" type="file" />
		                      </div>
		                    </div>
                            
                            <!--<div class="ln_solid"></div>
		                    <div class="item form-group">
                            	<h4>School Admin Details</h4>
                            </div>
                            
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullName">Full Name <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="fullName" class="form-control col-md-7 col-xs-12" name="fullName" placeholder="Full Name" required="required" type="text" />
		                      </div>
		                    </div>                            
                            
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="checkSchoolUsername">Username <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="checkSchoolUsername" data-id="0" class="form-control col-md-7 col-xs-12" name="username" placeholder="Username" required="required" type="text" />
                                <div id="username_errors"></div>
		                      </div>
		                    </div>                            
                            
                            <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="checkSchoolEmailId">Email Address <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="checkSchoolEmailId" data-id="0" class="form-control col-md-7 col-xs-12" name="email_id" placeholder="Email Address" required="required" type="email" />
		                      	<div id="email_errors"></div>
                              </div>
		                    </div>
                            
		                    <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password</label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="password" class="form-control col-md-7 col-xs-12" name="password" placeholder="Password" type="password" />
		                      </div>
		                    </div>-->

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
				/*$password = md5($_REQUEST['password']);
				$form_data = array(
				    'full_name' => trim(addslashes($_POST['fullName'])),
				    'username' => trim(addslashes($_POST['username'])),
				    'email_id' => trim(addslashes($_POST['email_id'])),
				    'user_type' => '1',
				    'password' => trim(addslashes($password))
				);*/
				//$user_id = dbRowInsert(trim('tbl_admin'), $form_data);
				$user_id = 0;
				
				if(isset($_FILES["img_logo"]) && $_FILES["img_logo"]['name'] != '') {
					$schoolImg = time().'_'.basename( $_FILES["img_logo"]["name"] );
					move_uploaded_file( $_FILES["img_logo"]["tmp_name"], '../images/school_logo/'.$schoolImg );
				} else {
					$schoolImg = '';
				}
				
				$form_data1 = array(
				    'title' => trim(addslashes($_POST['title'])),
				    'description' => trim(addslashes($_POST['description'])),
				    'address' => trim(addslashes($_POST['address'])),
				    'city' => trim(addslashes($_POST['city'])),
				    'state' => trim(addslashes($_POST['state'])),
				    'country' => trim(addslashes($_POST['country'])),
				    'address' => trim(addslashes($_POST['address'])),
				    'img_logo' => trim(addslashes($schoolImg)),
				    'status' => '1',
				    'user_id' => trim(addslashes($user_id))
				);
				dbRowInsert(trim('vpb_school'), $form_data1);
		?>
				<script>
					window.location = 'school-list.php';
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
