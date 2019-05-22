<?php 
	if(isset($_POST['itm_val'])) {
		include 'configuration.php';
		if($_POST['itm_type'] == '2') {
			if($_POST['user_type'] == 0) {
				$routeArr = getRowResult(trim('tbl_admin'), " WHERE `username` = '".trim($_POST['itm_val'])."'");
			} else {
				$routeArr = getRowResult(trim('tbl_admin'), " WHERE `username` = '".trim($_POST['itm_val'])."' AND `id` != '".trim($_POST['user_type'])."'");
			}
		} else {
			if($_POST['user_type'] == 0) {
				$routeArr = getRowResult(trim('tbl_admin'), " WHERE `email_id` = '".trim($_POST['itm_val'])."'");
			} else {
				$routeArr = getRowResult(trim('tbl_admin'), " WHERE `email_id` = '".trim($_POST['itm_val'])."' AND `id` != '".trim($_POST['user_type'])."'");
			}
		}
		//echo '<pre>';print_r($routeArr);
		echo  count($routeArr);
	}
?>
