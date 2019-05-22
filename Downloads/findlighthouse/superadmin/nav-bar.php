<?php $totalMsgArr = getCustomResult("select * from `vpb_admin_support` WHERE `admin_read` = '0' order by `id` desc");?>
<div class="col-md-3 left_col">
	<div class="left_col scroll-view">

	  	<div class="navbar nav_title" style="border: 0;">
	    	<a href="index.php" class="site_title"><img class="logo-img" src="images/logo.png" alt="Lighthouse Admin" /> &nbsp; &nbsp; Lighthouse</a>
	  	</div>
	  	<div class="clearfix"></div>

	  	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
		      	<ul class="nav side-menu">
		      		<li><a href="school-list.php"><i class="fa fa-user"></i> School List </a></li>
                    <li><a href="mentor-list.php"><i class="fa fa-user"></i> Mentor List </a></li>
		      		<li><a href="user-list.php"><i class="fa fa-user"></i> Students List </a></li>
		      		<li><a href="teacher-user-combine.php"><i class="fa fa-user"></i> Mentor and Students Combine </a></li>
                    <li><a href="college-check-list.php"><i class="fa fa-user"></i> College Check List </a></li>
                    <li><a href="college-check-list-user.php"><i class="fa fa-user"></i> User College Check List </a></li>
		      		<li><a href="admin-supports.php"><i class="fa fa-user"></i> Admin Supports  <span class="totalMsg"><?php if(count($totalMsgArr) > 0) {?><span><?php echo count($totalMsgArr);?></span><?php }?></span></a></li>
		        	<li><a href="profile.php"><i class="fa fa-user"></i> Edit Profile </a></li>
		        	<li><a href="logout.php"><i class="fa fa-sign-out"></i> Sign Out </a></li>
		      	</ul>
			</div>		
	  </div>
	  
	</div>
</div>
<style type="text/css">
	.totalMsg span {
		padding:5px 10px;
		background-color:rgb(243, 243, 243);
		color:#666666;
		border-radius:50%;
	}
</style>
