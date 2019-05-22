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
	              <h3>Edit College Check List</h3>
	            </div>
	        </div>
	        <?php 
				$parentCollegeArr = getCustomResult("select * from `vpb_college_check_list` WHERE `parent_id` = '0' AND `id` != '".$_REQUEST['id']."'");
				$editCollegeArr = getCustomResult("select * from `vpb_college_check_list` WHERE `id` = '".$_REQUEST['id']."'");
			?>
            <div class="x_content">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">

                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="title" class="form-control col-md-7 col-xs-12" name="title" placeholder="College Title" required="required" type="text" value="<?php echo $editCollegeArr[0]['title']?>" />
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">Parent Collage</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="parent_id" class="form-control col-md-7 col-xs-12" name="parent_id">
                            	<option value="0">Parent Collage</option>
                                <?php for($cou = 0; $cou < count($parentCollegeArr); $cou++) {?>
                                    <option value="<?php echo $parentCollegeArr[$cou]['id']?>" <?php if($parentCollegeArr[$cou]['id'] == $editCollegeArr[0]['parent_id']) {?> selected="selected" <?php }?>><?php echo $parentCollegeArr[$cou]['title']?></option>
                                <?php }?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                            <input id="send" name="save_data" type="submit" class="btn btn-success" value="Submit" />
                            <input name="id" type="hidden" value="<?php echo $_REQUEST['id']?>" />
                            <input name="save_data" type="hidden" value="1" />
                          </div>
                        </div>
                        
                      </form>
                  </div>
                </div>
            </div>
        <div class="clearfix"></div>
        <?php 
			//echo '<pre>';print_r($_POST);
			if(isset($_POST['save_data'])) {
				$form_data1 = array(
				    'title' => trim(addslashes($_POST['title'])),
				    'parent_id' => trim(addslashes($_POST['parent_id']))
				);
				dbRowUpdate(trim('vpb_college_check_list'), $form_data1, "WHERE `id` = '".$_POST['id']."'");
		?>
				<script>
					window.location = 'college-check-list.php';
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
