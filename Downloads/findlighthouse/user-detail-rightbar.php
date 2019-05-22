<?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>
<?php 
	if($resultArr[0]['photo'] == '') {
		$imagePath = 'assets/img/noimage.jpg';
	} else {
		$imagePath = 'vasplus_chat/photos/'.$resultArr[0]['photo'];
	}
?>

<div class="user-icon-img user-box">
    <div class="user-img-box">
        <img src="<?php echo $imagePath;?>" alt="" class="right-user-icon" />
    </div>
    <div class="rightbar-user-detail">
        <h3><?php echo $resultArr[0]['first_name']?> <?php echo $resultArr[0]['last_name']?></h3>
        <?php echo $resultArr[0]['position']?> <?php echo $resultArr[0]['address']?> &nbsp; &nbsp; <a href="edit_profile.php"><i class="fa fa-pencil"></i></a>
    </div>

</div>