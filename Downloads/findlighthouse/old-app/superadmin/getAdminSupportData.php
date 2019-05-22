<?php
if(isset($_POST['page'])){
	include_once('configuration.php');

    //Include pagination class file
    include('Pagination.php');
    
    //Include database configuration file
    include('dbConfig.php');
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 20;
    
    //set conditions for search
    $whereSQL = $orderSQL = '';
    /*$keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if(!empty($keywords)){
        $whereSQL = "WHERE title LIKE '%".$keywords."%'";
    }*/
	$whereSQL = " WHERE `parent_id` = '0' ";
	$orderSQL = " ORDER BY `id` DESC ";

    //get number of rows

	$resultNum = getCustomResult("SELECT * FROM `vpb_admin_support` ".$whereSQL.$orderSQL);
    $rowCount = count($resultNum);

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
	$msgArr = getCustomResult("SELECT * FROM `vpb_admin_support` $whereSQL $orderSQL LIMIT $start,$limit");
	//echo '<pre>';print_r($musicList);
?>
		<div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ticket No.</th>
                        <th>From</th>
                        <th>Message Details</th>
                        <th>Create at</th>
                        <th>Replay</th>
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
                            <td><?php if(count($msgReplayArr) == 0){ ?><a href="javascript:;" data-id="<?php echo $msgArr[$msg]['id']?>" class="btn btn-success replayBtn">Replay</a><?php }?></td>
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
                                    <h4>Replay</h4>
                                    <p><strong>Subject:</strong> <?php echo $msgReplayArr[0]['title']?></p>
                                    <p><strong>Message:</strong> <?php echo $msgReplayArr[0]['messages']?></p>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
<?php
	if(count($msgArr) > 0) {
		echo $pagination->createLinks(); 
	}
} 
?>

