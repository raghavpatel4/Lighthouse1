<?php
	if(isset($_POST['chat'])) {
		@session_start();
		ob_start();
		include 'superadmin/configuration.php';
		//date_default_timezone_set('US/Eastern');
		$to_username = $_POST['to_username'];
		if($_POST['chatText'] != '') {
			$form_data = array(
				'from_username' => trim(addslashes($_SESSION["user_id"])),
				'to_username' => trim(addslashes($_POST['to_username'])),
				'message' => trim(addslashes($_POST['chatText'])),
				'read' => 'no',
				'date_sent' => strtotime(date('Y-m-d h:i:s'))
			);
			$resturnVal = dbRowInsert(trim('vpb_chat_messages'), $form_data);
		}
	}
	if(isset($_POST['refreshData'])) {
		@session_start();
		ob_start();
		include 'superadmin/configuration.php';
		$to_username = $_POST['to_username'];
	}
	//echo '<pre>';print_r($_SESSION);echo '</pre>';
	$form_data = array(
		'read' => 'yes'
	);
	$resturnVal = dbRowUpdate(trim('vpb_chat_messages'), $form_data, " WHERE `to_username` = '".$_SESSION['user_id']."' AND `from_username` = '".$to_username."'");
 ?>

	<?php $chatArr = getRowResult(trim('vpb_chat_messages'), " WHERE (`from_username` = '".$_SESSION["user_id"]."' AND `to_username` = '".$to_username."') || (`to_username` = '".$_SESSION["user_id"]."' AND `from_username` = '".$to_username."')", 0);?>
	<?php //$chatArr = getRowResult(trim('vpb_chat_messages'));?>
	<?php for($chat = 0; $chat < count($chatArr); $chat++) {?>
	<div class="jspPane">
		<?php 
			$resultArr2 = getRowResult(trim('vpb_users'), " WHERE `id` = '".$chatArr[$chat]["from_username"]."'");
			if($resultArr2[0]['photo'] == '') {
				$imagePath2 = 'assets/img/noimage.jpg';
			} else {
				$imagePath2 = 'vasplus_chat/photos/'.$resultArr2[0]['photo'];
			}
			if($_SESSION["user_id"] == $chatArr[$chat]["from_username"]) {
		?>
            <div class="chat chat-10 rounded current-users">
                <span class="text"><?php echo $chatArr[$chat]['message']?></span>
                <span class="time">
                <?php 
                    $newDate = date("m-d-y, h:i", $chatArr[$chat]['date_sent']);
                    echo $newDate;
                ?>
                </span>
                <!--<span class="author"><?php echo $resultArr2[0]['fullname']?>:</span>
                <span class="gravatar"><img width="23" height="23" onload="this.style.visibility='visible'" src="<?php echo $imagePath2;?>" style="visibility: visible;"></span>-->
            </div>
        <?php } else {?>
            <div class="chat chat-10 rounded">
                <!--<span class="gravatar"><img width="23" height="23" onload="this.style.visibility='visible'" src="<?php echo $imagePath2;?>" style="visibility: visible;"></span>
                <span class="author"><?php echo $resultArr2[0]['fullname']?>:</span>-->
                <span class="text"><?php echo $chatArr[$chat]['message']?></span>
                <span class="time">
                <?php 
                    $newDate = date("m-d-y, h:i", $chatArr[$chat]['date_sent']);
                    echo $newDate;
                ?>
                </span>
            </div>
        <?php }?>
	</div>
<?php }?>