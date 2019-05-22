<?php include 'head.php';?>
<?php 
	//echo '<pre>';print_r($_POST);
	if(isset($_POST['save_data'])) {
		$form_data1 = array(
			'title' => trim(addslashes($_POST['title'])),
		    'parent_id' => trim(addslashes($_POST['parent_id']))
		);
		dbRowInsert(trim('vpb_college_check_list'), $form_data1);
?>
	<script type="text/javascript">
        window.location = '';
    </script>
<?php }?>
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
                  <h3>College Check List</h3>
                  <div class="clear"></div>
                </div>
              </div>
              <?php $parentCollegeArr = getCustomResult("select * from `vpb_college_check_list` WHERE `parent_id` = '0'");?>
                <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                      	<h3>Add New College Check</h3>
                        <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12" name="title" placeholder="College Title" required="required" type="text" />
                              </div>
                            </div>
                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">Parent Collage</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="parent_id" class="form-control col-md-7 col-xs-12" name="parent_id">
                                    <option value="0">Parent Collage</option>
									<?php for($cou = 0; $cou < count($parentCollegeArr); $cou++) {?>
                                        <option value="<?php echo $parentCollegeArr[$cou]['id']?>"><?php echo $parentCollegeArr[$cou]['title']?></option>
                                    <?php }?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <input id="send" name="save_data" type="submit" class="btn btn-success" value="Submit" />
                            	<input name="save_data" type="hidden" value="1" />
                              </div>
                            </div>
                          </form>
                      </div>
                    </div>
                </div>
                <div class="clearfix"></div>
              
              <?php 
	        	if(isset($_REQUEST['dele_id'])) {
					dbRowDelete(trim('vpb_college_check_list'), "WHERE `id` = '".$_REQUEST['dele_id']."'");
	        		
					$removeStd = getRowResult(trim('vpb_college_check_list'), " WHERE `id` = '".$_REQUEST['dele_id']."'");
					for($std = 0; $std < count($removeStd); $std++) {
	        			dbRowDelete(trim('vpb_user_college_check_list'), "WHERE `c_id` = '".$removeStd[$std]['id']."'");
					}
				}
				include('Pagination.php');
				include('dbConfig.php');
				
				$limit = 20;
				//$musicList = getRowResult('musics', "  WHERE `id` > '0' order by `id` desc limit 0, 20");
				//echo '<pre>';print_r($musicList);echo '</pre>';

				$queryNum = $db->query("SELECT COUNT(*) as postNum FROM `vpb_college_check_list`");
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
	                <?php $schoolRecords = getCustomResult("select * from `vpb_college_check_list` WHERE `id` > 0 order by `id` desc");?>
                    <div id="posts_content">
	                <div class="table-responsive">
  						<table class="table" id="datatable">
  							<thead>
  								<tr>
  									<th>#</th>
  									<th>Title</th>
  									<th>Parent ID</th>
  									<th>Create By</th>
  									<th>Action</th>
  								</tr>
  							</thead>
  							<tbody>
  								<?php if(count($schoolRecords) > 0) {?>
  									<?php for($i = 0; $i < count($schoolRecords); $i++) {?>
		  								<tr>
		  									<td><?php echo $i+1;?></td>
		  									<td><?php echo $schoolRecords[$i]['title'];?></td>
		  									<td>
												<?php 
													$subDetails = getRowResult(trim('vpb_college_check_list'), " WHERE `id` = '".$schoolRecords[$i]['parent_id']."'");
													if(count($subDetails) > 0) {
														echo $subDetails[0]['title'];
													} else {
														echo 'Parent Collage';
													}
												?>
                                            </td>
                                            <td>
												<?php 
													if($schoolRecords[$i]['is_admin'] > 0) {
														$useDetails = getRowResult(trim('vpb_users'), " WHERE `id` = '".$schoolRecords[$i]['is_admin']."'");
														echo $useDetails[0]['fullname'];
													} else {
														echo 'Admin';
													}
												?>
                                            </td>
		  									<td> <a href="edit_college-check-list.php?id=<?php echo $schoolRecords[$i]['id'];?>">Edit</a> | <a href="college-check-list.php?dele_id=<?php echo $schoolRecords[$i]['id'];?>" onClick="return confirm('Are you sure this item delete?')"><i class="fa fa-remove"></i></a></td>
		  								</tr>
  									<?php }?>
  								<?php }?>
  							</tbody>
  						</table>
  					</div>
                    
                    <?php //echo $pagination->createLinks(); ?>
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
  
<script type="text/javascript">
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
