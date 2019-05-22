	<?php include 'head.php';?>
	</head>
  	<body class="inner-page">
	  	<?php include 'header.php';?>
        <div class="body-section">
            <div class="container">
            
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
                <script>
                    window.location = '';
                </script>
            <?php
                }
            ?>
                <?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"><?php include 'user-menu.php';?></div>
                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                        <h3>Contact Us</h3>
                        <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Subject <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="subject" class="form-control col-md-7 col-xs-12" name="subject" placeholder="Subject" required="required" type="text" />
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Message <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <textarea id="message" class="form-control col-md-7 col-xs-12" name="message" placeholder="Message"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                              <input id="send" name="save_data" type="submit" class="btn btn-success btn-xs" value="Send" />
                              <input name="saveData" type="hidden" value="1" />
                            </div>
                          </div>
                            
                          <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"]?>" />
                        </form>
                        
                        <?php $msgArr = getCustomResult("select * from `vpb_admin_support` WHERE `user_id` = '".$_SESSION["user_id"]."' AND `parent_id` = '0' order by `id` desc");?>
                        <!--<div class="table-responsive">
  							<table class="table">
                            	<thead>
                                	<tr>
                                    	<th>Ticket No.</th>
                                        <th>From</th>
                                    	<th>Message Details</th>
                                    	<th>Create at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php /*for($msg = 0; $msg < count($msgArr); $msg++) {?>
                                    	<?php $msgReplayArr = getCustomResult("select * from `vpb_admin_support` WHERE `parent_id` = '".$msgArr[$msg]['id']."' order by `id` desc");?>
                                    	<tr class="topMessage">
                                        	<td><?php echo $msgArr[$msg]['ticket_no']?></td>
                                        	<td>Me</td>
                                        	<td>
												<p><strong>Subject:</strong> <?php echo $msgArr[$msg]['title']?></p>
												<p><strong>Message:</strong> <?php echo $msgArr[$msg]['messages']?></p>
                                            </td>
                                        	<td><?php echo $msgArr[$msg]['create_at']?></td>
                                        </tr>
                                        <?php if(count($msgReplayArr) > 0){ ?>
                                        	<tr>
                                                <td></td>
                                                <td>Admin Replay</td>
                                                <td>
                                                    <p><strong>Subject:</strong> <?php echo $msgReplayArr[0]['title']?></p>
                                                    <p><strong>Message:</strong> <?php echo $msgReplayArr[0]['messages']?></p>
                                                </td>
                                                <td><?php echo $msgReplayArr[0]['create_at']?></td>
                                            </tr>
                                        <?php }?>
                                    <?php }*/?>
                                </tbody>
                            </table>
                      	</div>-->
                        
                    </div>
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
