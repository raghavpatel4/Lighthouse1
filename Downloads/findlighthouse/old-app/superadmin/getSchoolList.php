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
	$whereSQL = " WHERE `id` > '0' ";
	$orderSQL = " ORDER BY `id` DESC ";

    //get number of rows

	$resultNum = getCustomResult("SELECT * FROM `vpb_school` ".$whereSQL.$orderSQL);
    $rowCount = count($resultNum);

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
	$schoolRecords = getCustomResult("SELECT * FROM `vpb_school` $whereSQL $orderSQL LIMIT $start,$limit");
	//echo '<pre>';print_r($musicList);
?>
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
<?php
	if(count($schoolRecords) > 0) {
		echo $pagination->createLinks(); 
	}
} 
?>

