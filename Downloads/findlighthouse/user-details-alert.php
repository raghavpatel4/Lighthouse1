<?php /*$resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".trim($_SESSION["user_id"])."'");?>
<?php if($resultArr[0]['photo'] == '' || $resultArr[0]['study'] == '' || $resultArr[0]['interests'] == '') {?>
<script type="text/javascript">
	swal({   
		title: "Sorry",
		text: 'Please Fill up full profile details.',
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Ok",
		closeOnConfirm: false,
		type: "warning",
		html: true
	}, function(isConfirm){   
		if (isConfirm) {
			window.location = 'edit_profile.php';	
		} else {
		} 
	});
</script>
<?php }*/?>