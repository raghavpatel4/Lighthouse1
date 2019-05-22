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
	$whereSQL = " WHERE  `user_type` = '2' ";
	$orderSQL = " ORDER BY `id` DESC ";

    //get number of rows

	$resultNum = getCustomResult("SELECT * FROM `vpb_users` ".$whereSQL.$orderSQL);
    $rowCount = count($resultNum);

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
	$totalNoTeahcer = getCustomResult("SELECT * FROM `vpb_users` $whereSQL $orderSQL LIMIT $start,$limit");
	//echo '<pre>';print_r($musicList);
?>
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
                                    <p><strong>School:</strong> <?php echo $totalNoTeahcer[$i]['school'];?></p>
                                    <p><strong>Interests:</strong> <?php echo $totalNoTeahcer[$i]['interests'];?></p>
                                    <p><strong>Extra Note:</strong> <?php echo $totalNoTeahcer[$i]['extra_note'];?></p>
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
                                        <a href="mentor-list.php?acc_act=<?php echo $totalNoTeahcer[$i]['id'];?>&status=1" class="btn btn-warning xs-btn" onClick="return confirm('Are you sure this Account Active?')">Pending</a>
                                    <?php
                                        } else {
                                    ?>
                                        <a href="mentor-list.php?acc_act=<?php echo $totalNoTeahcer[$i]['id'];?>&status=0" class="btn btn-success xs-btn" onClick="return confirm('Are you sure this Account Disable?')">Active</a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td> <a href="edit_mentor.php?id=<?php echo $totalNoTeahcer[$i]['id'];?>">Edit</a> | <a href="mentor-list.php?dele_id=<?php echo $totalNoTeahcer[$i]['id'];?>" onClick="return confirm('Are you sure this item delete?')"><i class="fa fa-remove"></i></a></td>
                            </tr>
                        <?php }?>
                    <?php }?>
                </tbody>
            </table>
            </div>
<?php
	if(count($totalNoTeahcer) > 0) {
		echo $pagination->createLinks(); 
	}
} 
?>

