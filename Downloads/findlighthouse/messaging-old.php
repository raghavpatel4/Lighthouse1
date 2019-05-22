	<?php 
		include 'head.php';
		$resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");
		if(count($resultArr) == 0) {
	?>
    	<script type="text/javascript">
			window.location  = 'index.php';
		</script>
    <?php
		}
	?>
	</head>
  	<body class="inner-page">
	  	<?php include 'header.php';?>
        <div class="body-section">
            <div class="container">
                <?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>
                <?php 
                    if($resultArr[0]['photo'] == '') {
                        $imagePath = 'assets/img/noimage.jpg';
                    } else {
                        $imagePath = 'vasplus_chat/photos/'.$resultArr[0]['photo'];
                    }
                    if(isset($_REQUEST['user_id'])) {
                        $to_username = $_REQUEST['user_id'];
                        $form_data = array(
                            'read' => 'yes'
                        );
                        $resturnVal = dbRowUpdate(trim('vpb_chat_messages'), $form_data, " WHERE `to_username` = '".$_SESSION['user_id']."' AND `from_username` = '".$to_username."'");
                    }
                ?>
                <div class="row mt grid">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                        <?php include 'user-menu.php';?>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
                        <div class="chat-box rounded">
                            
                            <div class="current-user rounded">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 text-right">
                                        <div class="user-icon"><img src="<?php echo $imagePath;?>" class="img-responsive img-circle"  alt="" /></div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 text-left">
                                        <div class="user-detail"><?php echo $resultArr[0]['fullname']?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr />
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right">
                                    <?php $friendArr = getRowResult(trim('vpb_chat_friends'), " WHERE `user` = '".$_SESSION["user_id"]."'");?>
                                    <?php //echo '<pre>'; print_r($friendArr);echo '</pre>';?>
                                    <div class="rounded" id="chatUsers">
                                        <?php for($user = 0; $user < count($friendArr); $user++) {?>
                                            <?php 
                                                $resultArr1 = getRowResult(trim('vpb_users'), " WHERE `id` = '".$friendArr[$user]["friend"]."'");
                                                if($resultArr1[0]['photo'] == '') {
                                                    $imagePath1 = 'assets/img/noimage.jpg';
                                                } else {
                                                    $imagePath1 = 'vasplus_chat/photos/'.$resultArr1[0]['photo'];
                                                }
                                                $unReadMsg = getRowResult(trim('vpb_chat_messages'), " WHERE `to_username` = '".$_SESSION['user_id']."' AND `from_username` = '".$resultArr1[0]['id']."' AND `read` = 'no'");
                                            ?>
                                        <a href="messaging.php?user_id=<?php echo $resultArr1[0]['id']?>" <?php if($resultArr1[0]['id'] == $_REQUEST['user_id']) {?> class="currentBGUsers"<?php }?>>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                                    <div class="user-icon"><img src="<?php echo $imagePath1;?>" class="img-responsive img-circle"  alt="" /></div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">
                                                    <div class="user-detail"><?php echo $resultArr1[0]['fullname']?> <span class="totalMsg"><?php if(count($unReadMsg) > 0) {?><span><?php echo count($unReadMsg);?></span><?php }?></span></div>
                                                </div>
                                            </div>
                                        </a>
                                        <hr />
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 text-left">
                                    
                                        <div id="chatLineHolder" style="padding: 0px;">
                                            <div class="jspContainer">
                                                <?php 
                                                    if(isset($_REQUEST['user_id'])) {
                                                        $to_username = $_REQUEST['user_id'];
                                                        include 'chat-message.php';
                                                    } else { 
                                                        $to_username = 0;
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="rounded" id="chatBottomBar">
                                        <div class="tip"></div>
                                        <form action="" method="post" id="submitForm" style="display: block;">
                                            <input maxlength="255" class="rounded form-control" name="chatText" id="chatText">
                                            <input type="submit" value="Submit" class="blueButton btn-success btn btn-xs" />
                                            <input type="hidden" name="to_username" id="to_username" value="<?php echo $to_username;?>" />
                                            <input type="hidden" name="from_username" value="<?php echo $_SESSION["user_id"];?>" />
                                            <input type="hidden" name="chat" value="1" />
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>	
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                        <?php //echo '<pre>'; print_r($_SESSION);echo '</pre>';?>
                        
                    </div>
                </div>
                
            </div>
		</div>
		
		<?php include 'footer.php';?>
        <?php include 'user-details-alert.php';?>
	</body>
</html>
