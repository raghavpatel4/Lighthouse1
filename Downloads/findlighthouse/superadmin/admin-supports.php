<?php include 'head.php';?>
</head>
<body class="nav-md">
<div class="container body">
  <div class="main_container">
  	<?php
		$statusChange = array(
			'admin_read' => '1'
		);
		$resturnVal = dbRowUpdate(trim('vpb_admin_support'), $statusChange, " WHERE `id` > '0'");
	?>
    <?php include 'nav-bar.php';?>
    <?php include 'header.php';?>
    <div class="right_col" role="main">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="dashboard_graph">
            <div class="row x_title">
              	<div class="col-md-12">
          		<?php
					if(isset($_POST['saveData'])) {
						$form_data = array(
							'title' => trim(addslashes($_POST['subject'])),
							'messages' => trim(addslashes($_POST['message'])),
							'admin_read' => 1,
							'user_id' => $_POST['user_id'],
							'parent_id' => $_POST['parent_id']
						);
						$resturnVal = dbRowInsert(trim('vpb_admin_support'), $form_data);
				?>
					<script>
						window.location = '';
					</script>
				<?php
					}
					include('Pagination.php');
					include('dbConfig.php');
					
					$limit = 20;
					//$musicList = getRowResult('musics', "  WHERE `id` > '0' order by `id` desc limit 0, 20");
					//echo '<pre>';print_r($musicList);echo '</pre>';
					
					
					$queryNum = $db->query("SELECT COUNT(*) as postNum FROM `vpb_admin_support` WHERE `parent_id` = '0'");
					$resultNum = $queryNum->fetch_assoc();
					$rowCount = $resultNum['postNum'];
					
					$pagConfig = array(
						'totalRows' => $rowCount,
						'perPage' => $limit,
						'link_func' => 'searchFilter'
					);
					$pagination =  new Pagination($pagConfig);
				?>
                	<h3>Admin Supports</h3>
                  	<div class="clear"></div>
              	</div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              		<?php $msgArr = getCustomResult("select * from `vpb_admin_support` WHERE `parent_id` = '0' order by `id` desc LIMIT 0, $limit");?>
                    <div id="posts_content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ticket No.</th>
                                    <th>From</th>
                                    <th>Message Details</th>
                                    <th>Create at</th>
                                    <th>Reply</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($msg = 0; $msg < count($msgArr); $msg++) {?>
                                	<?php $msgReplayArr = getCustomResult("select * from `vpb_admin_support` WHERE `parent_id` = '".$msgArr[$msg]['id']."' order by `id` desc");?>
                                    <tr>
                                        <td><?php echo $msgArr[$msg]['ticket_no']?></td>
                                        <td>
                                        <?php 
											$teachArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$msgArr[$msg]['user_id']."'");
											if(count($teachArr) > 0) {
												if($teachArr[0]['photo'] == '') {
													$imagePath = '../assets/img/noimage.jpg';
												} else {
													$imagePath = '../vasplus_chat/photos/'.$teachArr[0]['photo'];
												}
										?>
											<img src="<?php echo $imagePath;?>" class="img-responsive img-circle" style="max-height: 45px; max-width:45px;" alt="" /> <?php echo $teachArr[0]['fullname'];?> 
                                            <?php 
												if($teachArr[0]['user_type'] == '1') {
													echo '<small>(Student)</small>';
												} else {
													echo '<small>(Mentor)</small>';
												}
											}
										?>
                                        </td>
                                        <td>
                                            <p><strong>Subject:</strong> <?php echo $msgArr[$msg]['title']?></p>
                                            <p><strong>Message:</strong> <?php echo $msgArr[$msg]['messages']?></p>
                                        </td>
                                        <td><?php echo $msgArr[$msg]['create_at']?></td>
                                        <td><?php if(count($msgReplayArr) == 0){ ?><a href="javascript:;" data-id="<?php echo $msgArr[$msg]['id']?>" class="btn btn-success replayBtn">Reply</a><?php }?></td>
                                    </tr>
                                    <tr <?php if(count($msgReplayArr) == 0){ ?>class="replyForm replyForm_<?php echo $msgArr[$msg]['id']?>" style="display:none;"<?php }?>>
                                    	<td colspan="5" align="right">
                                        	<?php if(count($msgReplayArr) == 0){ ?>
                                            <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                              <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Subject <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                  <input id="subject" class="form-control col-md-7 col-xs-12" name="subject" placeholder="Subject" required="required" type="text" />
                                                </div>
                                              </div>
                                              <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Message <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                  <textarea id="message" class="form-control col-md-7 col-xs-12" name="message" placeholder="Message" required="required"></textarea>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                  <input id="send" name="save_data" type="submit" class="btn btn-success btn-xs" value="Send" />
                                                  <input id="send" type="button" class="btn btn-success btn-xs replyFormCancel" value="Cancel" />
                                                  <input name="saveData" type="hidden" value="1" />
                                                </div>
                                              </div>

                                              <input type="hidden" name="user_id" value="<?php echo $msgArr[$msg]['user_id']?>" />
                                              <input type="hidden" name="parent_id" value="<?php echo $msgArr[$msg]['id']?>" />
                                            </form>
                                            <?php } else {?>
                                            	<h4>Reply</h4>
                                            	<p><strong>Subject:</strong> <?php echo $msgReplayArr[0]['title']?></p>
                                            	<p><strong>Message:</strong> <?php echo $msgReplayArr[0]['messages']?></p>
                                            <?php }?>
                                        </td>
                                    </tr>
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
    </div>
    <br />
    <?php include 'footer.php';?>
  </div>
</div>
</div>
<?php include 'footer-js.php';?>
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('click', '.replayBtn', function () {
			var form_id = $(this).attr('data-id');
			$('.replyForm_'+form_id).show();
		});
		$(document).on('click', '.replyFormCancel', function () {
			$('.replyForm').hide();
		});
	});
</script>
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    //var keywords = $('#keywords').val();
    //var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'getAdminSupportData.php',
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