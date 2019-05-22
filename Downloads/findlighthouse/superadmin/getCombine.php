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
	$whereSQL = " WHERE  `id` > '0' ";
	$orderSQL = " ORDER BY `id` DESC ";

    //get number of rows

	$resultNum = getCustomResult("SELECT * FROM `tbl_combine` ".$whereSQL.$orderSQL);
    $rowCount = count($resultNum);

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
	$combArr = getCustomResult("SELECT * FROM `tbl_combine` $whereSQL $orderSQL LIMIT $start,$limit");
	//echo '<pre>';print_r($musicList);
?>
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
<?php
	if(count($combArr) > 0) {
		echo $pagination->createLinks(); 
	}
} 
?>

