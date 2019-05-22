<?php
if(isset($_POST['dataSave'])) {
	session_start();
	include 'superadmin/configuration.php';
	$sql = "SELECT * FROM `vpb_online_users` WHERE `lastTime` < ADDDATE('".date('Y-m-d h:i:s')."', INTERVAL -60 MINUTE)";
	//echo '<p>'.date('Y-m-d h:i:s').'</p>';
	//echo $sql;
	$session = 0;
	$resArr = getCustomResult($sql);
	//echo '<pre>';print_r($resArr);
	for($d = 0; $d < count($resArr); $d++) {
		if($resArr[$d]['user_id'] == $_SESSION['user_id']) {
			$session = 1;
			session_unset(); 
			session_destroy(); 
		}
		//$dataArr = array('user_id' => $resArr[$d]['user_id']);
		dbRowDelete('vpb_online_users', " WHERE `user_id` = '".$resArr[$d]['user_id']."'");
	}
	echo $session;
}
?>