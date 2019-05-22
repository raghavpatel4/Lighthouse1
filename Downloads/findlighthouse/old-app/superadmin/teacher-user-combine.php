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
            
	            <?php 
		        	if(isset($_REQUEST['dele_id'])) {
		        		$combArr = getRowResult(trim('tbl_combine'), "WHERE `id` = '".$_REQUEST['dele_id']."'");

		        		dbRowDelete(trim('vpb_chat_friends'), "WHERE `user` = '".$combArr[0]['teacher_id']."' AND `friend` = '".$combArr[0]['user_id']."'");
		        		dbRowDelete(trim('vpb_chat_friends'), "WHERE `user` = '".$combArr[0]['user_id']."' AND `friend` = '".$combArr[0]['teacher_id']."'");

		        		dbRowDelete(trim('tbl_combine'), "WHERE `id` = '".$_REQUEST['dele_id']."'");
		        	}
		        ?>

              <div class="row x_title">
                <div class="col-md-12">
                  <h3>Mentor and Student Combine</h3>
                </div>
              </div>

              <div class="row">
	              <div class="col-md-6 col-sm-6 col-xs-12">  
	              	<form action="" method="post">
		                <?php $totalNoTeahcer = getRowResult(trim('vpb_users'), " WHERE `user_type` = '2' AND `id` > '1' AND `status` = '1'");?>
						<?php if(count($totalNoTeahcer) > 0) {?>
							Mentor:
							<select name="teacher_id" class="form-control" required="">
								<option value="">Select Mentor</option>
								<?php for($i = 0; $i < count($totalNoTeahcer); $i++) {?>
									<option value="<?php echo $totalNoTeahcer[$i]['id'];?>"><?php echo $totalNoTeahcer[$i]['first_name'];?> <?php echo $totalNoTeahcer[$i]['last_name'];?></option>
								<?php }?>
							</select>
						<?php }?>
						<br />
		                <?php $totalNoTeahcer = getRowResult(trim('vpb_users'), " WHERE `user_type` = '1' AND `id` > '1' AND `status` = '1'");?>
		                <?php if(count($totalNoTeahcer) > 0) {?>
		                	Student: 
							<select name="std_id" class="form-control" required="">
								<option value="">Select Student</option>
								<?php for($i = 0; $i < count($totalNoTeahcer); $i++) {?>
									<option value="<?php echo $totalNoTeahcer[$i]['id'];?>"><?php echo $totalNoTeahcer[$i]['first_name'];?> <?php echo $totalNoTeahcer[$i]['last_name'];?></option>
								<?php }?>
							</select>
						<?php }?>
						<br />
						<p align="center"><input type="submit" name="save" class="btn btn-success" /></p>
                        <input type="hidden" name="save" value="1" />
					</form>
					
					<?php
						if(isset($_REQUEST['save'])) {
							$form_data = array(
							    'user_id' => trim(addslashes($_POST['std_id'])),
							    'teacher_id' => $_POST['teacher_id']
							);
							$resturnVal = dbRowInsert(trim('tbl_combine'), $form_data);
							if($resturnVal > 0) {
								$form_data_2 = array(
								    'friend' => $_POST['std_id'],
								    'user' => $_POST['teacher_id']
								);
								$resturnVal_2 = dbRowInsert(trim('vpb_chat_friends'), $form_data_2);
								
								$form_data_3 = array(
								    'user' => $_POST['std_id'],
								    'friend' => $_POST['teacher_id']
								);
								$resturnVal_3 = dbRowInsert(trim('vpb_chat_friends'), $form_data_3);	
							}
						}
						
						include('Pagination.php');
						include('dbConfig.php');
						
						$limit = 20;
						//$musicList = getRowResult('musics', "  WHERE `id` > '0' order by `id` desc limit 0, 20");
						//echo '<pre>';print_r($musicList);echo '</pre>';
						
						
						$queryNum = $db->query("SELECT COUNT(*) as postNum FROM `tbl_combine` WHERE `id` > '0'");
						$resultNum = $queryNum->fetch_assoc();
						$rowCount = $resultNum['postNum'];
						
						$pagConfig = array(
							'totalRows' => $rowCount,
							'perPage' => $limit,
							'link_func' => 'searchFilter'
						);
						$pagination =  new Pagination($pagConfig);
					?>
	              </div>
	              
	              <div class="col-md-6 col-sm-6 col-xs-12">  
	                
	              </div>
	              
              </div>

              <div class="clearfix"></div>
              
              <div class="row x_title">
                <div class="col-md-12">
                  <h3>Mentor and Student Combine List</h3>
                </div>
              </div>

              <div class="row">
	              <div class="col-md-12 col-sm-12 col-xs-12"> 
                    <?php $combArr = getCustomResult("select * from `tbl_combine` WHERE `id` > '0' order by`id` desc LIMIT 0, $limit");?>
                    <div id="posts_content">
	              	
	              	<div class="table-responsive">
  						<table class="table">
  							<thead>
  								<tr>
  									<th>#</th>
  									<th>Mentor Name</th>
  									<th>Student Name</th>
  									<th>Communication</th>
  									<th>Action</th>
  								</tr>
  							</thead>
  							<tbody>
  								<?php if(count($combArr) > 0) {?>
  									<?php for($i = 0; $i < count($combArr); $i++) {?>
		  								<tr>
		  									<td><?php echo $i+1;?></td>
		  									<td>
		  										<?php $teachArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$combArr[$i]['teacher_id']."'");?>
		  										<?php 
		  											if($teachArr[0]['photo'] == '') {
		  												$imagePath = '../assets/img/noimage.jpg';
	  												} else {
														$imagePath = '../vasplus_chat/photos/'.$teachArr[0]['photo'];
													}
		  										?>
		  										<img src="<?php echo $imagePath;?>" class="img-responsive img-circle" style="max-height: 80px; max-width:80px;" alt="" />
		  										<?php echo $teachArr[0]['fullname'];?>
		  									</td>
		  									<td>
		  										<?php $stdArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$combArr[$i]['user_id']."'");?>
		  										<?php 
		  											if($stdArr[0]['photo'] == '') {
		  												$imagePath = '../assets/img/noimage.jpg';
	  												} else {
														$imagePath = '../vasplus_chat/photos/'.$stdArr[0]['photo'];
													}
		  										?>
		  										<img src="<?php echo $imagePath;?>" class="img-responsive img-circle" style="max-height: 80px; max-width:80px;" alt="" />
		  										<?php echo $stdArr[0]['fullname'];?>
		  									</td>
                                            <td> <a href="teacher-user-communication.php?id=<?php echo $combArr[$i]['id'];?>">Communication</a></td>
		  									<td> <a href="teacher-user-combine.php?dele_id=<?php echo $combArr[$i]['id'];?>" onClick="return confirm('Are you sure this item delete?')"><i class="fa fa-remove"></i></a></td>
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
        url: 'getCombine.php',
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
