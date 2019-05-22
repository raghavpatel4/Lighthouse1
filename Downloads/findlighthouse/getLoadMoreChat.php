<?php
	@session_start();
	ob_start();
	include 'superadmin/configuration.php';
	$resArr = array();
	if(isset($_REQUEST['to_username']) && isset($_REQUEST['lastChatIds'])) {
		$to_username = $_REQUEST['to_username'];
		$lastChatIds = $_REQUEST['lastChatIds'];
		if($_REQUEST['readNew'] == 0) {
			$sqlQuery = "select * from vpb_chat_messages WHERE ((`from_username` = '".$_SESSION["user_id"]."' AND `to_username` = '".$to_username."') || (`to_username` = '".$_SESSION["user_id"]."' AND `from_username` = '".$to_username."')) AND `id` < '".$lastChatIds."' order by `id` desc limit 0, 5";
		} else {
			//$sqlQuery = "select * from vpb_chat_messages WHERE ((`from_username` = '".$_SESSION["user_id"]."' AND `to_username` = '".$to_username."') || (`to_username` = '".$_SESSION["user_id"]."' AND `from_username` = '".$to_username."')) AND `id` > '".$lastChatIds."' AND `read` = 'no' order by `id` desc limit 0, 3";
			$sqlQuery = "select * from `vpb_chat_messages` WHERE `to_username` = '".$_SESSION['user_id']."' AND `id` > '".$lastChatIds."' AND `read` = 'no' order by `id` desc limit 0, 5";
		}
		//echo $sqlQuery;
		$chatArr = getCustomResult($sqlQuery);
		if(count($chatArr) > 0) {
			$lastId = count($chatArr)-1;
			
			$lastMsgId = $chatArr[$lastId]['id'];
			
			$resArr['totalRecord'] = count($chatArr);
			$resArr['lastMsgId'] = $lastMsgId;
			
			//for($chat = (count($chatArr) - 1); $chat >= 0; $chat--) {
			for($chat = 0; $chat < count($chatArr); $chat++) {
				if($_SESSION["user_id"] == $chatArr[$chat]["from_username"]) {
					$userTypes = 'me';
				} else {
					$userTypes = 'you';
				}
				$resArr['res'][$chat]['date_sent'] = date("m-d-y, h:i", $chatArr[$chat]['date_sent']);
				$resArr['res'][$chat]['userTypes'] = $userTypes;
				$resArr['res'][$chat]['message'] = trim($chatArr[$chat]['message']);
				$resArr['res'][$chat]['chat_id'] = trim($chatArr[$chat]['id']);
				$resArr['res'][$chat]['attachment'] = trim($chatArr[$chat]['attachment']);
				
				$form_data = array(
					'read' => 'yes'
				);
				$resturnVal = dbRowUpdate(trim('vpb_chat_messages'), $form_data, " WHERE `to_username` = '".$_SESSION['user_id']."' AND `from_username` = '".$to_username."'");
			}
		} else {
			$resArr['totalRecord'] = 0;
			$resArr['lastMsgId'] = $lastChatIds;
		}
	}
	echo json_encode($resArr);
?>
