<div class="dashboard-left-menu">
    <div class="user-calander-icon user-box">
        <h3>Important Dates</h3>
        <div class="calender">
        	<div id="my-calendar"></div>
        	<!--<img src="images/calender-icon.png" alt="" />-->
        </div>
        <h3><a href="my-reminders.php">Reminders</a></h3>
    </div>
    <div class="user-box">
        <h3 class="pull-right"><strong>Today</strong></h3>
        <?php $todayRem = getCustomResult("select * from `reminders` WHERE `user_id` = '".$_SESSION["user_id"]."' AND `re_date` = '".date('Y-m-d')."' order by `reminder_id` desc");?>
        <ul class="user-activites">
        	<?php for($t = 0; $t < count($todayRem); $t++) {?>
            <li><a href="my-reminders.php"><img src="images/user-left-icon-1.png" alt="" class="img-icons" /> <?php echo trim(stripslashes($todayRem[$t]['title']));?></a></li>
            <?php }?>
        </ul>
    </div>
    <div class="user-box">
        <h3 class="pull-right"><strong>Tomorrow</strong></h3>
        <?php 
			$tomorrow = date("Y-m-d", strtotime("+1 day"));

			$tomorrowRem = getCustomResult("select * from `reminders` WHERE `user_id` = '".$_SESSION["user_id"]."' AND `re_date` = '".$tomorrow."' order by `reminder_id` desc");
		?>
        <ul class="user-activites">
        	<?php for($tom = 0; $tom < count($tomorrowRem); $tom++) {?>
            <li><a href="my-reminders.php"><img src="images/user-left-icon-1.png" alt="" class="img-icons" /> <?php echo trim(stripslashes($tomorrowRem[$tom]['title']));?></a></li>
            <?php }?>
        </ul>
    </div>
    <div class="user-box">
        <br><h3>College Check-List</h3>
    </div>
    <div class="user-box">
    	<?php $collegeList = getCustomResult("select * from `vpb_college_check_list` WHERE (`parent_id` = '0') && (`is_admin` = '0' || `is_admin` = '".$_SESSION['user_id']."') order by `id` asc");?>
        <ul class="user-activites college_list_ul">
            <?php 
				for($college = 0; $college < count($collegeList); $college++) {
					$checkActiveClass = getCustomResult("select * from `vpb_user_college_check_list` WHERE `user_id` = '".$_SESSION['user_id']."' AND `c_id` = '".$collegeList[$college]['id']."'");
					if(count($checkActiveClass) > 0) {
						$activeClass1 = ' text-through ';
						$activeChecked1 = ' checked="checked" ';
					} else {
						$activeClass1 = '';
						$activeChecked1 = '';
					}
			?>
            	<li>
                    <input type="checkbox" class="checkbox-inline college-checkbox-list" <?php echo $activeChecked1?> id="p_college_<?php echo $collegeList[$college]['id']?>" data-id="<?php echo $collegeList[$college]['id']?>" /> <label for="p_college_<?php echo $collegeList[$college]['id']?>" class="str_<?php echo $collegeList[$college]['id']?> <?php echo $activeClass1?>"><?php echo $collegeList[$college]['title']?></label>
    				<?php 
						$subCollegeList = getCustomResult("select * from `vpb_college_check_list` WHERE `parent_id` = '".$collegeList[$college]['id']."' order by `id` asc");
                    	if(count($subCollegeList) > 0) {
                    ?>
                            <ul class="user-activites sub-activites">
                            	<?php 
									for($sC = 0; $sC < count($subCollegeList); $sC++) {
										$checkActiveClass1 = getCustomResult("select * from `vpb_user_college_check_list` WHERE `user_id` = '".$_SESSION['user_id']."' AND `c_id` = '".$subCollegeList[$sC]['id']."'");
										if(count($checkActiveClass1) > 0) {
											$activeClass2 = ' text-through ';
											$activeChecked2 = ' checked="checked" ';
										} else {
											$activeClass2 = '';
											$activeChecked2 = '';
										}
								?>
                                	<li><input type="checkbox" data-id="<?php echo $subCollegeList[$sC]['id']?>" class="checkbox-inline college-checkbox-list" <?php echo $activeChecked2?> id="p_college_<?php echo $subCollegeList[$sC]['id']?>" /> <label for="p_college_<?php echo $subCollegeList[$sC]['id']?>" class="str_<?php echo $subCollegeList[$sC]['id']?> <?php echo $activeClass2?>"><?php echo $subCollegeList[$sC]['title']?></label></li>
                    			<?php }?>
                            </ul>
                    <?php }?>
            	</li>
			<?php }?>
        </ul>
        <p class="text-center"><a href="javascript:;" class="add-more-college-list">Add More</a></p>
    </div>
</div>