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
	              <h3>Edit Page <small>Edit Page Details</small></h3>
	            </div>
	        </div>
	        <?php $resultArr = getRowResult(trim('tbl_urls'), " WHERE `id` = '".$_REQUEST['id']."'");?>
			<div class="row">
		      <div class="col-md-12 col-sm-12 col-xs-12">
		        <div class="x_content">
		        	<div class="row">
			          <div class="col-md-12 col-sm-12 col-xs-12">
			            <form method="post" class="form-horizontal form-label-left">

		                    <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Page Name <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Page Name" value="<?php echo $resultArr[0]['page_url'] ?>" required="required" type="text" />
		                      </div>
		                    </div>
		                    <div class="ln_solid"></div>
		                    <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_title">Page Title <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="page_title" class="form-control col-md-7 col-xs-12" name="page_title" placeholder="Page Title" value="<?php echo $resultArr[0]['page_title'] ?>" required="required" type="text" />
		                      </div>
		                    </div>
		                    <div class="ln_solid"></div>
		                    <div class="item form-group">
		                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span></label>
		                      <div class="col-md-6 col-sm-6 col-xs-12">
		                        <input id="url" class="form-control col-md-7 col-xs-12" name="url" placeholder="URL" value="<?php echo $resultArr[0]['link'] ?>" required="required" type="text" />
		                      </div>
		                    </div>
		                    <div class="ln_solid"></div>
		                    
		                    <div class="form-group">
		                      <div class="col-md-6 col-md-offset-3">
		                        <a href="index.php" class="btn btn-primary">Cancel</a>
		                        <input id="send" name="save_data" type="submit" class="btn btn-success" value="Submit" />
		                        <input name="save_data" type="hidden" value="1" />
		                        <input name="id" type="hidden" value="<?php echo $_REQUEST['id']?>" />
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
				$form_data = array(
				    'page_url' => seoUrl(trim(addslashes($_POST['name']))),
				    'page_title' => trim(addslashes($_POST['page_title'])),
				    'link' => trim(addslashes($_POST['url']))
				);
				$resturnVal = dbRowUpdate(trim('tbl_urls'), $form_data, "WHERE `id` = '".$_POST['id']."'");
		?>
				<script>
					window.location = 'index.php';
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
