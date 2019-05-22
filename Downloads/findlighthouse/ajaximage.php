<?php
//include('db.php');
session_start();
$session_id='1'; //$session id
$path = "vasplus_chat/photos/";

$valid_formats = array("jpg", "png", "gif", "bmp");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
	$name = $_FILES['profile_img']['name'];
	$size = $_FILES['profile_img']['size'];
	
	if(strlen($name)) {
		list($txt, $ext) = explode(".", $name);
		if(in_array($ext,$valid_formats)) {
			if($size<(6024*1024)) {
				$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				$tmp = $_FILES['profile_img']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$actual_image_name)) {
					//mysqli_query($db,"UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
					echo "<img src='vasplus_chat/photos/".$actual_image_name."' class='preview_img' />";
					echo '<a href="javascript:;" data-id="'.$actual_image_name.'" data-title="profileIcon" name="userIconPreview" class="removeImg">Remove Image</a>';
					echo '<input type="hidden" name="profileIcon" value="'.$actual_image_name.'" id="profileIcon" />';
				}
				else
					echo "failed";
			} else
				echo "Image file size max 5 MB";					
		} else
			echo "Invalid file format..";	
	} else
		echo "Please select image..!";

	exit;
}
?>