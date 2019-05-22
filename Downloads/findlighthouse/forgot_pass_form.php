<?php
	if(isset($_POST['action']) && $_POST['action'] == 2) {
		$action = 2;
		$actionText = 'Teacher ';
	} else {
		$action = 1;
		$actionText = 'Student ';
	}
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<form action="" method="post" class="login-form">
			<input type="text" class="form-control" name="email" placeholder="Email Address" />
		</form>
	</div>
</div>
