<?php include 'head.php';?>
<?php include 'checkUserLogin.php';?>
</head>
<body class="home-page black-bg">
<i id="home-page"></i>
<?php //include 'header.php';?>
<div class="header-section full_width_section container white-bg">
  <div class="row">
    <div class="col-md-4 clean-space">
      <?php include 'new-user-left-menu.php';?>
    </div>
    <div class="col-md-8">
      <div class="box">
        <?php include 'user-top-right.php';?>
        <div class="box-header">
          <h3>My Files</h3>
        </div>
        <div class="box-body dashbord-box-body">
        	<div class="row">
                <div class="col-sm-12">
          
				  <?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>
                  
                  <?php
						$sqlFileQuery = "select * from vpb_chat_messages WHERE (`from_username` = '".$_SESSION["user_id"]."' || `to_username` = '".$_SESSION["user_id"]."') AND `attachment` != '' order by `id` desc";
						//echo $sqlQuery;
						$fileArr = getCustomResult($sqlFileQuery);
					?>
                  <div class="table-responsive">
                    <table class="table dynamicFiltter">
                      <thead>
                        <tr>
                          <td>#</td>
                          <th>Sender</th>
                          <th>Reciver</th>
                          <th>Filename</th>
                          <th>Send at</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php for($f = 0; $f < count($fileArr); $f++) {?>
                        <tr>
                          <td><?php echo $f+1?></td>
                          <td>
                          	<?php
								/*$resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");
								if($resultArr[0]['photo'] == '') {
									$imagePath = 'assets/img/noimage.jpg';
								} else {
									$imagePath = 'vasplus_chat/photos/'.$resultArr[0]['photo'];
								}*/
								if($fileArr[$f]['from_username'] == $_SESSION["user_id"]) {
									echo 'Me';
								} else {
									$userDetails = getRowResult(trim('vpb_users'), " WHERE `id` = '".$fileArr[$f]['from_username']."'");
									echo $userDetails[0]['fullname'];
								}
							?>
                          </td>
                          <td>
                          	<?php
								if($fileArr[$f]['to_username'] == $_SESSION["user_id"]) {
									echo 'Me';
								} else {
									$userDetails = getRowResult(trim('vpb_users'), " WHERE `id` = '".$fileArr[$f]['to_username']."'");
									echo $userDetails[0]['fullname'];
								}
								$newDate = date("m-d-y, h:i", $fileArr[$f]['date_sent'])
                           	?>
                          </td>
                          <td><a href="vasplus_chat/vpb_chat_attachments/<?php echo $fileArr[$f]['attachment']?>" target="_blank"><?php echo $fileArr[$f]['attachment']?></a></td>
                          <td><?php echo $newDate?></td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
          </div>
          <div class="col-sm-1"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'user-footer.php';?>
</div>
<?php include 'checkUserLoginStatus.php';?>
<?php include 'footer.php';?>
<?php include 'user-details-alert.php';?>
<?php //include 'checkUserLoginStatus.php';?>
</body>
</html>