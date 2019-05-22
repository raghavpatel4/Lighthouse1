<?php
	if(isset($_POST['imgName'])) {
		unlink('vasplus_chat/photos/'.$_POST['imgName']);
	}
?>