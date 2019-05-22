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
                  <h3>School List</h3>
                  <div class="pull-right"><a href="add_school.php" class="btn btn-success">Add New School</a></div>
                  <div class="clear"></div>
                </div>
              </div>
              
              <?php 
	        	if(isset($_REQUEST['dele_id'])) {
					dbRowDelete(trim('vpb_school'), "WHERE `id` = '".$_REQUEST['dele_id']."'");
	        		
					$removeStd = getRowResult(trim('vpb_users'), " WHERE `school_id` = '".$_REQUEST['dele_id']."'");
					for($std = 0; $std < count($removeStd); $std++) {
	        			dbRowDelete(trim('vpb_chat_friends'), "WHERE `user` = '".$removeStd[$std]['user_id']."' || `friend` = '".$removeStd[$std]['user_id']."'");
					}	        	
					dbRowDelete(trim('vpb_users'), "WHERE `school_id` = '".$_REQUEST['dele_id']."'");
				}
	        	if(isset($_REQUEST['acc_act'])) {
			        $form_data_1 = array(
					    'status' => $_REQUEST['status']
					);
					$resturnVal_1 = dbRowUpdate(trim('vpb_school'), $form_data_1, "WHERE `id` = '".$_REQUEST['acc_act']."'");
					
					/*if($_REQUEST['status'] == 1) {
						$form_data_2 = array(
						    'user' => $_REQUEST['acc_act'],
						    'friend' => '1'
						);
						$resturnVal_2 = dbRowInsert(trim('vpb_chat_friends'), $form_data_2);

						$form_data_3 = array(
						    'user' => '1',
						    'friend' => $_REQUEST['acc_act']
						);
						$resturnVal_3 = dbRowInsert(trim('vpb_chat_friends'), $form_data_3);
					} else {
						dbRowDelete(trim('vpb_chat_friends'), "WHERE `user` = '".$_REQUEST['acc_act']."' || `friend` = '".$_REQUEST['acc_act']."'");

						dbRowDelete(trim('tbl_combine'), "WHERE `teacher_id` = '".$_REQUEST['acc_act']."'");
					}*/
	        	}
				include('Pagination.php');
				include('dbConfig.php');
				
				$limit = 20;
				//$musicList = getRowResult('musics', "  WHERE `id` > '0' order by `id` desc limit 0, 20");
				//echo '<pre>';print_r($musicList);echo '</pre>';
				
				
				$queryNum = $db->query("SELECT COUNT(*) as postNum FROM `vpb_school`");
				$resultNum = $queryNum->fetch_assoc();
				$rowCount = $resultNum['postNum'];
				
				$pagConfig = array(
					'totalRows' => $rowCount,
					'perPage' => $limit,
					'link_func' => 'searchFilter'
				);
				$pagination =  new Pagination($pagConfig);
			?>

              <div class="row">
	              <div class="col-md-12 col-sm-12 col-xs-12">
	                <?php $schoolRecords = getCustomResult("select * from `vpb_school` WHERE `id` > 0 order by `id` desc LIMIT 0, $limit");?>
                    <div id="posts_content">
	                <div class="table-responsive">
  						<table class="table">
  							<thead>
  								<tr>
  									<th>#</th>
  									<th>Details</th>
  									<th>Image</th>
  									<th>School Admin Details</th>
  									<th>Create at</th>
  									<th>Status</th>
  									<th>Action</th>
  								</tr>
  							</thead>
  							<tbody>
  								<?php if(count($schoolRecords) > 0) {?>
  									<?php for($i = 0; $i < count($schoolRecords); $i++) {?>
		  								<tr>
		  									<td><?php echo $i+1;?></td>
		  									<td>
		  										<p><strong>School Title:</strong> <?php echo $schoolRecords[$i]['title'];?></p>
		  										<p><strong>School Address:</strong> <?php echo $schoolRecords[$i]['address'];?></p>
		  										<p><strong>School City:</strong> <?php echo $schoolRecords[$i]['city'];?></p>
		  										<p><strong>School State:</strong> <?php echo $schoolRecords[$i]['state'];?></p>
		  										<p><strong>School Country:</strong> <?php echo getCountryName($schoolRecords[$i]['country']);?></p>
		  									</td>
		  									<td>
		  										<?php 
		  											if($schoolRecords[$i]['img_logo'] == '') {
		  												$imagePath = '../assets/img/noimage.jpg';
	  												} else {
														$imagePath = '../images/school_logo/'.$schoolRecords[$i]['img_logo'];
													}
		  										?>
		  										<img src="<?php echo $imagePath;?>" class="img-responsive" style="height: 120px; width:150px;" alt="" />
		  									</td>
		  									<td>
												<?php $schoolUsers = getRowResult(trim('tbl_admin'), " WHERE `id` = '".$schoolRecords[$i]['user_id']."'");?>
                                                <p><strong>Full Name:</strong> <?php echo $schoolUsers[0]['full_name'];?></p>
                                                <p><strong>Email Address:</strong> <?php echo $schoolUsers[0]['email_id'];?></p>
                                                <p><strong>Username:</strong> <?php echo $schoolUsers[0]['username'];?></p>
                                                <p><a href="<?php echo $schoolUsers[0]['id'];?>" target="_blank">Change Password</a></p>
                                            </td>
		  									<td><?php echo $schoolRecords[$i]['create_at'];?></td>
		  									<td>
		  										<?php 
		  											if($schoolRecords[$i]['status'] == 0) {
		  										?>
		  											<a href="school-list.php?acc_act=<?php echo $schoolRecords[$i]['id'];?>&status=1" class="btn btn-warning xs-btn" onClick="return confirm('Are you sure this Account Active?')">Pending</a>
		  										<?php
		  											} else {
												?>
													<a href="school-list.php?acc_act=<?php echo $schoolRecords[$i]['id'];?>&status=0" class="btn btn-success xs-btn" onClick="return confirm('Are you sure this Account Disable?')">Active</a>
		  										<?php
		  											}
		  										?>
		  									</td>
		  									<td> <a href="edit_school.php?id=<?php echo $schoolRecords[$i]['id'];?>">Edit</a> | <a href="school-list.php?dele_id=<?php echo $schoolRecords[$i]['id'];?>" onClick="return confirm('Are you sure this item delete?')"><i class="fa fa-remove"></i></a></td>
		  								</tr>
  									<?php }?>
  								<?php }?>
  							</tbody>
  						</table>
  					</div>
                    
                    <?php echo $pagination->createLinks(); ?>
                    </div>
                    
	              </div>
              </div>

              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        <br />
        <?php include 'footer.php';?>
      </div>
    </div>

  </div>

  <?php include 'footer-js.php';?>
  
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    //var keywords = $('#keywords').val();
    //var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'getSchoolList.php',
        data:'page='+page_num,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#posts_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
</body>
</html>
