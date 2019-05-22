<?php 
	if(isset($_POST['itm_val'])) {
		include 'configuration.php';

		$routeArr = getRowResult(trim('vpb_users'), " WHERE `email` = '".trim($_POST['itm_val'])."'");

		//echo '<pre>';print_r($routeArr);
		echo  count($routeArr);
	}
?>
