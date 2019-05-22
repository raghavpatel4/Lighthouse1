<?php include 'head.php';?>
</head>
<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <?php include 'nav-bar.php';?>
    <?php include 'header.php';?>
    <div class="right_col" role="main">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="dashboard_graph">
            <div class="row x_title">
              	<div class="col-md-12">
              	<?php 
					$combArr = getRowResult(trim('tbl_combine'), " WHERE `id` = '".$_REQUEST['id']."'");
					$teachCombArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$combArr[0]['teacher_id']."'");
					$stdCombArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$combArr[0]['user_id']."'");
					
					$communicationArr = getRowResult(trim('vpb_chat_messages'), " WHERE (`from_username` = '".$combArr[0]['teacher_id']."' AND `to_username` = '".$combArr[0]['user_id']."') || (`from_username` = '".$combArr[0]['user_id']."' AND `to_username` = '".$combArr[0]['teacher_id']."')");
				?>
                	<h3><?php echo $teachCombArr[0]['fullname']?> (Mentor) and <?php echo $stdCombArr[0]['fullname']?> (Student) Communication</h3>
                  	<div class="pull-right"><a href="teacher-user-combine.php" class="btn btn-success">Back</a></div>
                  	<div class="clear"></div>
              	</div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Mentor Name</th>
                        <th>Communication</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(count($communicationArr) > 0) {?>
                      <?php for($i = 0; $i < count($communicationArr); $i++) {?>
                      <tr>
                        <td><?php echo $i+1;?></td>
                        <td>
							<?php 
								$teachArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$communicationArr[$i]['from_username']."' AND `user_type` = '1'");
								if(count($teachArr) > 0) {
									if($teachArr[0]['photo'] == '') {
										$imagePath = '../assets/img/noimage.jpg';
									} else {
										$imagePath = '../vasplus_chat/photos/'.$teachArr[0]['photo'];
									}
                            ?>
                              	<?php echo $teachArr[0]['fullname'];?>
                            <?php }?>
                        </td>
                        <td>
							<?php 
								$stdArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$communicationArr[$i]['from_username']."' AND `user_type` = '2'");
								if(count($stdArr) > 0) {
									if($stdArr[0]['photo'] == '') {
										$imagePath = '../assets/img/noimage.jpg';
									} else {
										$imagePath = '../vasplus_chat/photos/'.$stdArr[0]['photo'];
									}
							?>
                          		<?php echo $stdArr[0]['fullname'];?> 
                        	<?php }?>
                        </td>
                        <td><?php echo trim($communicationArr[$i]['message']);?></td>
                        <td>
						<?php 
							$newDate = date("m-d-y, h:i", trim($communicationArr[$i]['date_sent']));
							echo $newDate;
						?>
                        </td>
                      </tr>
                      <?php }?>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <?php include 'footer.php';?>
  </div>
</div>
</div>
<?php include 'footer-js.php';?>
</body>
</html>