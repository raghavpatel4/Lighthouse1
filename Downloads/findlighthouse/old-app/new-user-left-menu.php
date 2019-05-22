<?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>
<?php 
	if($resultArr[0]['photo'] == '') {
		$imagePath = 'assets/img/noimage.jpg';
	} else {
		$imagePath = 'vasplus_chat/photos/'.$resultArr[0]['photo'];
	}
?>

<div class="userMenuBox">
    <div class="icon-bar">
        <a href="dashboard.php"><img src="images/icons/LighthouseLogo.png" alt="" /></a> 
        <a href="message.php"><img src="images/icons/MessagingIcon.png" alt="" /> <span>Message</span></a> 
        <a href="#"><img src="images/icons/FilesIcon.png" alt="" /> <span>Files</span></a> 
        <a href="#"><img src="images/icons/CollegeComparisonToolIcon.png" alt="" /> <span>College Comparison Tool</span></a> 
        <a href="#"><img src="images/icons/StatsIcon.png" alt="" /> <span>Personal Stats</span></a> 
        <a href="edit_profile.php"><img src="images/icons/SettingsIconwhite.png" alt="" /> <span>Settings</span></a> 
        <a href="#"><img src="images/icons/ContactIcon.png" alt="" /> <span>Contact Us</span></a> 
        <a href="logout.php"><img src="images/icons/LogOutIconWight.png" alt="" /> <span>Log Out</span></a> 
        
        <!--<a class="active" href="#"><i class="fa fa-home"></i></a> 
        <a href="#"><i class="fa fa-search"></i></a> 
        <a href="#"><i class="fa fa-envelope"></i></a> 
        <a href="#"><i class="fa fa-globe"></i></a>
        <a href="#"><i class="fa fa-trash"></i></a> -->
        
    </div>
    <div class="grey-bc userMenuDetails">
        <div class="user-icon-img user-box"><img src="<?php echo $imagePath;?>" alt="" /></div>
        <?php include 'dashboard-left-menu.php';?>
        <div class="copyright">&copy; COPYRIGHT LIGHTHOUSE 2017 | ARIANA OLALDE DESIGNS</div>
            
	</div>
</div>
