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
        <div class="box-header">
          <h3>My Reminders</h3>
        </div>
        <div class="box-body dashbord-box-body">
          <?php
			if(isset($_POST['saveData'])) {
				$form_data = array(
					'title' => trim(addslashes($_POST['subject'])),
					'description' => trim(addslashes($_POST['description'])),
					're_date' => trim(addslashes($_POST['re_date'])),
					'user_id' => $_SESSION['user_id']
				);
				$resturnVal = dbRowInsert(trim('reminders'), $form_data);
		?>
			<script type="text/javascript">
				window.location = '';
			</script>
		<?php
			}
		?>
          <?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>
          <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Title <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="subject" class="form-control col-md-7 col-xs-12" name="subject" placeholder="Title" required="required" type="text" />
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="re_date">Date <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="re_date" class="form-control col-md-7 col-xs-12 datepicker" name="re_date" placeholder="<?php echo date('Y-m-d')?>" required="required" type="text" />
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="description" class="form-control col-md-7 col-xs-12" rows="6" name="description" placeholder="Description"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <input id="send" name="save_data" type="submit" class="btn btn-success" value="Send" />
                <input name="saveData" type="hidden" value="1" />
              </div>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"]?>" />
          </form>
          <?php $msgArr = getCustomResult("select * from `reminders` WHERE `user_id` = '".$_SESSION["user_id"]."' order by `reminder_id` desc");?>
          <div class="table-responsive">
            <table class="table dynamicFiltter">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Reminder Date</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                <?php for($msg = 0; $msg < count($msgArr); $msg++) {?>
                    <tr class="topMessage">
                      <td><?php echo $$msg+1?></td>
                      <td><?php echo $msgArr[$msg]['re_date']?></td>
                      <td>
                      	<div><strong>Title: </strong> <?php echo $msgArr[$msg]['title']?></div><br />
                        <div><strong>Description: </strong> <?php echo $msgArr[$msg]['description']?></div>
                      </td>
                    </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'user-footer.php';?>
</div>
<?php include 'checkUserLoginStatus.php';?>
<?php include 'footer.php';?>
<?php include 'user-details-alert.php';?>
<?php //include 'checkUserLoginStatus.php';?>
</body>
</html>
