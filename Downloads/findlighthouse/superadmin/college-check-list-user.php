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
                  <h3>User College Check List</h3>
                  <div class="clear"></div>
                </div>
              </div>
            
              <div class="row">
	              <div class="col-md-12 col-sm-12 col-xs-12">
	                <?php $schoolRecords = getCustomResult("select DISTINCT UL.user_id, U.fullname, U.photo from `vpb_user_college_check_list` as UL, `vpb_users` as U WHERE U.id = UL.user_id order by U.id desc");?>
                    <div id="posts_content">
	                <div class="table-responsive">
  						<table class="table" id="datatable">
  							<thead>
  								<tr>
  									<th>#</th>
  									<th>User Details</th>
  									<th>Selected Colleges</th>
  								</tr>
  							</thead>
  							<tbody>
  								<?php if(count($schoolRecords) > 0) {?>
  									<?php for($i = 0; $i < count($schoolRecords); $i++) {?>
		  								<tr>
		  									<td><?php echo $i+1;?></td>
		  									<td><?php echo $schoolRecords[$i]['fullname'];?></td>
		  									<td>
												<?php 
													$sqll = "select C.* from `vpb_college_check_list` as C, `vpb_user_college_check_list` as CU WHERE CU.c_id = C.id AND CU.user_id = '".$schoolRecords[$i]['user_id']."' order by C.id desc";
													//echo $sqll;
													$collegeDetails = getCustomResult($sqll);
													if(count($collegeDetails) > 0) {
														for($s = 0;  $s < count($collegeDetails); $s++) {
															echo $collegeDetails[$s]['title'].',<br />';
														}
													}
												?>
                                            </td>
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
