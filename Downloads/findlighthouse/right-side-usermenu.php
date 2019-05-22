<?php
	if(isset($_SESSION["user_id"])) {
		$totalMsgArr = getCustomResult("select * from `vpb_admin_support` WHERE `user_id` = '".$_SESSION["user_id"]."' AND `user_read` = '0' order by `id` desc");
	} else {
		$totalMsgArr = array();
	}
?>
<div class="leftmenu-user-bar">

	<div class="navbar navbar-inverse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          	<li><a href="dashboard.php"><img src="images/icons/LighthouseLogo.png" alt="" /></a> </li>
            <li><a href="messaging.php"> <span class="totalMsg"><?php if(count($totalUnReadMsg) > 0) {?><span><?php echo count($totalUnReadMsg);?></span><?php }?></span> <img src="images/icons/MessagingIcon.png" alt="" /> <span>Message</span></a> </li>
            <li><a href="my-files.php"><img src="images/icons/FilesIcon.png" alt="" /> <span>Files</span></a> </li>
            <li><a href="college-comparison-tool.php"><img src="images/icons/CollegeComparisonToolIcon.png" alt="" /> <span>College Comparison Tool</span></a> </li>
            <li><a href="personal-stats.php"><img src="images/icons/StatsIcon.png" alt="" /> <span>Personal Stats</span></a> </li>
            <li><a href="edit_profile.php"><img src="images/icons/SettingsIconwhite.png" alt="" /> <span>Settings</span></a> </li>
            <li><a href="contact-us.php"><img src="images/icons/ContactIcon.png" alt="" /> <span>Contact Us</span></a> </li>
            <li><a href="logout.php"><img src="images/icons/LogOutIconWight.png" alt="" /> <span>Log Out</span></a></li>
          </ul>
        </div>
    </div> 
    
    <!--<a class="active" href="#"><i class="fa fa-home"></i></a> 
    <a href="#"><i class="fa fa-search"></i></a> 
    <a href="#"><i class="fa fa-envelope"></i></a> 
    <a href="#"><i class="fa fa-globe"></i></a>
    <a href="#"><i class="fa fa-trash"></i></a> -->
    
</div>
