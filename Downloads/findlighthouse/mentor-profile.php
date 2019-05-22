	<?php include 'head.php';?>
	</head>
  	<body class="inner-page">
	  	<?php include 'header.php';?>

	  	<?php $resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$_SESSION["user_id"]."'");?>

        <div class="body-section">
            <div class="container">
                <div class="row mt grid">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 centered">
                        <?php include 'user-menu.php';?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 text-left">
                        <p><strong>Full Name : </strong> <?php echo $resultArr[0]['fullname']?></p>
                        <p><strong>Email ID : </strong> <?php echo $resultArr[0]['email']?></p>
                        <p><strong>Grade : </strong> <?php echo $resultArr[0]['study']?></p>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 centered"></div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <!--<div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Necessary </th>
                                        <th>Actions</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Test 1</td>
                                        <td>$45.00</td>
                                        <td>06-June-2016</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Test 2</td>
                                        <td>$50.00</td>
                                        <td>06-June-2016</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Test 3</td>
                                        <td>$66.00</td>
                                        <td>06-June-2016</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Test 4</td>
                                        <td>$75.00</td>
                                        <td>06-June-2016</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Test 5</td>
                                        <td>$42.00</td>
                                        <td>06-June-2016</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>

		<?php include 'footer.php';?>
		
		<!--<script type="text/javascript"> jQuery.noConflict(); </script>
		<link rel="stylesheet" type="text/css" href="vasplus_chat/css/vasplus_chat.css">
		<script type="text/javascript" src="vasplus_chat/js/jQuery_v1.8.3.js"></script> 
		<script type="text/javascript" src="vasplus_chat/js/jquery.cookie.js"></script>
		<script type="text/javascript" src="vasplus_chat/js/jquery.eventsource.js"></script>
		<script type="text/javascript" src="vasplus_chat/js/vasplus_chat.js"></script>
		
		<?php
			//$_SESSION["from_username"] = 'victor'; // Set your logged in user username as it is in your database users table here
			$userName = '';
			if(isset($_SESSION["user_id"])) {
				//$_SESSION["from_username"] = isset($_GET["username"]) ? strip_tags($_GET["username"]) : 'victor'; // This is a demo for username passed to the URL	
				//$_SESSION["from_username"] = $_SESSION['first_name'].' '.$_SESSION['last_name'];;
				echo '<input type="hidden" id="from_username_identity" value="'.strip_tags($_SESSION["from_username"]).'" />';
			}
		?>-->
	</body>
</html>
