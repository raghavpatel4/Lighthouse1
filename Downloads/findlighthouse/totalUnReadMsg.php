<?php
	@session_start();
	ob_start();
	include 'superadmin/configuration.php';
	$totalUnReadMsg = getRowResult(trim('vpb_chat_messages'), " WHERE `to_username` = '".$_SESSION['user_id']."' AND `read` = 'no'");
?>
<?php if(count($totalUnReadMsg) > 0) {?><span><?php echo count($totalUnReadMsg);?></span><?php }?>
