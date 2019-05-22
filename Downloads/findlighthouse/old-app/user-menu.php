<?php if(isset($_SESSION["admin_id"]) && $_SESSION["admin_id"] > 0) {?>
		<script type="text/javascript">
			window.location = 'superadmin/index.php';
		</script>
<?php
	}
	if($_SESSION["user_type"] == 1) {
		$homeUrl = 'user-profile.php';
	} else {
		$homeUrl = 'mentor-profile.php';
	}
?>
<?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>
<?php 
	if($resultArr[0]['photo'] == '') {
		$imagePath = 'assets/img/noimage.jpg';
	} else {
		$imagePath = 'vasplus_chat/photos/'.$resultArr[0]['photo'];
	}
	$totalUnReadMsg = getRowResult(trim('vpb_chat_messages'), " WHERE `to_username` = '".$_SESSION['user_id']."' AND `read` = 'no'");
	$totalMsgArr = getCustomResult("select * from `vpb_admin_support` WHERE `user_id` = '".$_SESSION["user_id"]."' AND `user_read` = '0' order by `id` desc");
?>
<img src="<?php echo $imagePath;?>" class="img-responsive profile-img"  alt="" />
<h3 class="text-center"><?php echo $resultArr[0]['fullname']?></h3>
<div class="margintop20">
	<ul class="nav nav-pills nav-stacked user-menu">
	  <li<?php if(isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF'] == '/messaging.php') {?> class="active"<?php }?>><a href="messaging.php"> Messages <span class="totalMsg"><?php if(count($totalUnReadMsg) > 0) {?><span><?php echo count($totalUnReadMsg);?></span><?php }?></span></a></li>
	  <li<?php if(isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF'] == '/admin-supports.php') {?> class="active"<?php }?>><a href="admin-supports.php"> Contact Us <span class="totalInboxMsg"><?php /*if(count($totalMsgArr) > 0) {?><span><?php echo count($totalMsgArr);?></span><?php }*/?></span></a></li>
      <li<?php if(isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF'] == '/edit_profile.php') {?> class="active"<?php }?>><a href="edit_profile.php"> Edit Profile</a></li>
	  <li><a href="logout.php"> Logout</a></li>
	</ul>
</div>
