<?php $editMentorArr = getCustomResult("select * from `vpb_users` WHERE `id` = '".trim($_SESSION["user_id"])."'");?>
<div class="box-head head-icons">
    <div class="pull-right">
        <a href="admin-supports.php" class="setting-opt"><img src="images/setting-icons-1.png" class="icon-imgs" alt="" /></a>
        <a href="edit_profile.php" class="setting-opt"><img src="images/setting-icons-2.png" class="icon-imgs" alt="" /></a>
        <a href="logout.php" class="setting-opt"><img src="images/setting-icons-3.png" class="icon-imgs" alt="" /></a>
    </div>
</div>