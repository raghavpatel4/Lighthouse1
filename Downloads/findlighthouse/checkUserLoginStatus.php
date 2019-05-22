<?php
	session_start();
	if(isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
		$resultArr = getRowResult(trim('vpb_online_users'), " WHERE `user_id` = '".trim($user_id)."'");
		if(count($resultArr) > 0) {
			$form_data = array(
				'lastTimeStr' => time(),
				'lastTime' => date('Y-m-d h:i:s')
			);
			$resturnVal = dbRowUpdate('vpb_online_users', $form_data, " WHERE `user_id` = '".trim($user_id)."'");
?>
			<script type="text/javascript">
            setInterval("updateStaus()", 3600000);
			//setInterval("updateStaus()", 60000);
            
            function updateStaus() { 
            	$.ajax({
				  type : 'POST',
				  url  : 'onlineStatusUpdates.php',
				  data : 'dataSave=1',
				  success :  function(data) {
					if(data == 1) {
						window.location = 'index.php';
					}
				  }
				});
				//$.post("onlineStatusUpdates.php");
            } 
            </script>
<?php
	    } else {
?>
			<script type="text/javascript">
                window.location = 'index.php';
            </script>
<?php
		}
	}
?>