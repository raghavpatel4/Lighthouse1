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
                  <h3>Student List</h3>
                  <div class="pull-right"><a href="add_user.php" class="btn btn-success">Add New Student</a></div>
                  <div class="clear"></div>
                </div>
              </div>
              
              <?php 
	        	if(isset($_REQUEST['dele_id'])) {
	        		dbRowDelete(trim('vpb_users'), "WHERE `id` = '".$_REQUEST['dele_id']."'");
	        		dbRowDelete(trim('vpb_chat_friends'), "WHERE `user` = '".$_REQUEST['dele_id']."' || `friend` = '".$_REQUEST['dele_id']."'");
	        	} 
	        	if(isset($_REQUEST['acc_act'])) {
			        $form_data_1 = array(
					    'status' => $_REQUEST['status']
					);
					$resturnVal_1 = dbRowUpdate(trim('vpb_users'), $form_data_1, "WHERE `id` = '".$_REQUEST['acc_act']."'");
					if(isset($_REQUEST['as_active'])) {
						$form_data_2 = array(
							'as_active' => $_REQUEST['as_active']
						);
						dbRowUpdate(trim('vpb_users'), $form_data_2, "WHERE `id` = '".$_REQUEST['acc_act']."'");
					}
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
						dbRowDelete(trim('tbl_combine'), "WHERE `user_id` = '".$_REQUEST['acc_act']."'");
					}*/
	        	}
				include('Pagination.php');
				include('dbConfig.php');
				
				$limit = 20;
				//$musicList = getRowResult('musics', "  WHERE `id` > '0' order by `id` desc limit 0, 20");
				//echo '<pre>';print_r($musicList);echo '</pre>';
				
				
				$queryNum = $db->query("SELECT COUNT(*) as postNum FROM `vpb_users` WHERE `user_type` = '1'");
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
	                
	                <?php $totalNoTeahcer = getCustomResult("select * from `vpb_users` WHERE `user_type` = '1' order by`id` desc LIMIT 0, $limit");?>
                    <div id="posts_content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Details</th>
                                        <th>Image</th>
                                        <th>Email ID</th>
                                        <th>Create Account</th>
                                        <th>Status</th>
                                        <th>Active Account?</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($totalNoTeahcer) > 0) {?>
                                        <?php for($i = 0; $i < count($totalNoTeahcer); $i++) {?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                <td>
                                                    <p><strong>First Name:</strong> <?php echo $totalNoTeahcer[$i]['first_name'];?></p>
                                                    <p><strong>Last Name:</strong> <?php echo $totalNoTeahcer[$i]['last_name'];?></p>
                                                    <p><strong>Study:</strong> <?php echo $totalNoTeahcer[$i]['study'];?></p>
                                                    <p><strong>School:</strong> <?php echo getSchoolName($totalNoTeahcer[$i]['school_id']);?></p>
                                                    <p><strong>Interests:</strong> <?php echo $totalNoTeahcer[$i]['interests'];?></p>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($totalNoTeahcer[$i]['photo'] == '') {
                                                            $imagePath = '../assets/img/noimage.jpg';
                                                        } else {
                                                            $imagePath = '../vasplus_chat/photos/'.$totalNoTeahcer[$i]['photo'];
                                                        }
                                                    ?>
                                                    <img src="<?php echo $imagePath;?>" class="img-responsive" style="height: 120px; width:150px;" alt="" />
                                                </td>
                                                <td><?php echo $totalNoTeahcer[$i]['email'];?></td>
                                                <td><?php echo $totalNoTeahcer[$i]['date'];?></td>
                                                <td>
                                                    <?php 
                                                        if($totalNoTeahcer[$i]['status'] == 0) {
                                                    ?>
                                                        <a href="user-list.php?acc_act=<?php echo $totalNoTeahcer[$i]['id'];?>&status=1" class="btn btn-warning xs-btn" onClick="return confirm('Are you sure you want to active this account?')">Block</a>
                                                    <?php
                                                        } else {
                                                    ?>
                                                        <a href="user-list.php?acc_act=<?php echo $totalNoTeahcer[$i]['id'];?>&status=0" class="btn btn-success xs-btn" onClick="return confirm('Are you sure you want to disable this account?')">Active</a>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($totalNoTeahcer[$i]['as_active'] == 0) {
                                                    ?>
                                                        <a href="user-list.php?acc_act=<?php echo $totalNoTeahcer[$i]['id'];?>&as_active=1&status=<?php echo $totalNoTeahcer[$i]['status'];?>" class="btn btn-warning xs-btn" onClick="return confirm('Are you sure this Account Active without Confirmation Link?')">Pending</a>
                                                    <?php
                                                        } else {
                                                    ?>
                                                        <a href="#" class="btn btn-success xs-btn">Confirm</a>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td> <a href="edit_user.php?id=<?php echo $totalNoTeahcer[$i]['id'];?>">Edit</a> | <a href="user-list.php?dele_id=<?php echo $totalNoTeahcer[$i]['id'];?>" onClick="return confirm('Are you sure this item delete?')"><i class="fa fa-remove"></i></a></td>
                                            </tr>
                                        <?php }?>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    
                    	<?php echo $pagination->createLinks(); ?>
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
        url: 'getStdList.php',
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
