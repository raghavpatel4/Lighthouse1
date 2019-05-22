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
          <h3>Admin Supports</h3>
        </div>
        <div class="box-body dashbord-box-body">
        	<div class="row">
                <div class="col-sm-12">
          <?php
			if(isset($_SESSION['user_id'])) {
				$statusChange = array(
					'user_read' => '1'
				);
				dbRowUpdate(trim('vpb_admin_support'), $statusChange, " WHERE `user_id` = '".$_SESSION['user_id']."'");
			}
			if(isset($_POST['saveData'])) {
				$form_data = array(
					'title' => trim(addslashes($_POST['subject'])),
					'messages' => trim(addslashes($_POST['message'])),
					'user_read' => 1,
					'user_id' => $_SESSION['user_id'],
					'ticket_no' => time()
				);
				$resturnVal = dbRowInsert(trim('vpb_admin_support'), $form_data);
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Subject <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="subject" class="form-control col-md-7 col-xs-12" name="subject" placeholder="Subject" required="required" type="text" />
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Message <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="message" class="form-control col-md-7 col-xs-12" rows="6" name="message" placeholder="Message"></textarea>
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
          <?php $msgArr = getCustomResult("select * from `vpb_admin_support` WHERE `user_id` = '".$_SESSION["user_id"]."' AND `parent_id` = '0' order by `id` desc");?>
          <div class="table-responsive">
            <table class="table dynamicFiltter">
              <thead>
                <tr>
                  <td>#</td>
                  <th>Ticket No.</th>
                  <th>From</th>
                  <th>Message Details</th>
                  <th>Create at</th>
                </tr>
              </thead>
              <tbody>
                <?php for($msg = 0; $msg < count($msgArr); $msg++) {?>
                <?php $msgReplayArr = getCustomResult("select * from `vpb_admin_support` WHERE `parent_id` = '".$msgArr[$msg]['id']."' order by `id` desc");?>
                <tr class="topMessage">
                  <td><?php echo $msg+1?></td>
                  <td><?php echo $msgArr[$msg]['ticket_no']?></td>
                  <td>Me</td>
                  <td><p><strong>Subject:</strong> <?php echo $msgArr[$msg]['id']?> <?php echo $msgArr[$msg]['title']?></p>
                    <p><strong>Message:</strong> <?php echo $msgArr[$msg]['messages']?></p>
                  
                  	<?php if(count($msgReplayArr) > 0){ ?>
						<?php for($msg1 = 0; $msg1 < count($msgReplayArr); $msg1++) {?>
                        <hr />
                        <div class="adminReplay">
                            <p><strong>Admin Replay</strong><br>
                            <strong>Subject:</strong> <?php echo $msgReplayArr[$msg1]['id']?> <?php echo $msgReplayArr[$msg1]['title']?></p>
                           	<p><strong>Message:</strong> <?php echo $msgReplayArr[$msg1]['messages']?></p>
                            <p><strong>Send Replay:</strong> <?php echo $msgReplayArr[$msg1]['create_at']?></p>
                        </div>
                        <?php }?>
                    <?php }?>  
                    
                  </td>
                  <td><?php echo $msgArr[$msg]['create_at']?></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
          </div>
          <div class="col-md-1"></div>
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