	<?php include 'head.php';?>
	</head>
  	<body class="inner-page">
	  	<?php include 'header.php';?>
        <div class="body-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 centered">
                        <?php include 'user-menu.php';?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 text-left">
                        <p><strong>Full Name : </strong> <?php echo $resultArr[0]['fullname']?></p>
                        <p><strong>Email ID : </strong> <?php echo $resultArr[0]['email']?></p>
                        <p><strong>Grade : </strong> <?php echo $resultArr[0]['study']?></p>
                        <p><strong>School : </strong> <?php echo $resultArr[0]['school']?></p>
                        <p><strong>Interests : </strong> <?php echo $resultArr[0]['interests']?></p>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 centered"></div>
                </div>
                
            </div>
    
        </div>
		
		<?php include 'footer.php';?>
		
		<!--<script type="text/javascript"> jQuery.noConflict(); </script>
		<link rel="stylesheet" type="text/css" href="vasplus_chat/css/vasplus_chat.css">
		<script type="text/javascript" src="vasplus_chat/js/jQuery_v1.8.3.js"></script> 
		<script type="text/javascript" src="vasplus_chat/js/jquery.cookie.js"></script>
		<script type="text/javascript" src="vasplus_chat/js/jquery.eventsource.js"></script>
		<script type="text/javascript" src="vasplus_chat/js/vasplus_chat.js"></script>-->
		
		<?php
			//$_SESSION["from_username"] = 'victor'; // Set your logged in user username as it is in your database users table here
			/*$userName = '';
			if(isset($_SESSION["from_username"])) {
				//$_SESSION["from_username"] = isset($_GET["username"]) ? strip_tags($_GET["username"]) : 'victor'; // This is a demo for username passed to the URL	
				//$_SESSION["from_username"] = $_SESSION['first_name'].' '.$_SESSION['last_name'];;
				echo '<input type="hidden" id="from_username_identity" value="'.strip_tags($_SESSION["from_username"]).'" />';
			}*/
		?>
	</body>
</html>
