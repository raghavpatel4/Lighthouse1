	<?php include 'head.php';?>
    <?php include 'checkUserLogin.php';?>
	</head>
  	<body class="home-page black-bg">
    	<i id="home-page"></i>
        <?php //include 'header.php';?>
        <div class="header-section full_width_section container white-bg">
        	<div class="row">
            	<div class="col-md-4 clean-space">
                	<?php include 'new-user-left-menu.php';?>
                </div>
            	<div class="col-md-8 col-xs-12">
                	<div class="box">
                    	<?php include 'user-top-right.php';?>
                        <div class="box-header"><h3>College Comparison Tool</h3></div>
                        <div class="box-body dashbord-box-body">
                        	work in progress
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include 'user-footer.php';?>
            
        </div>
	  	<?php 
	  		/*if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0) {
				if($_SESSION["user_type"] == 1) {
		?>
					<script>
						window.location = 'user-profile.php';
					</script>
		<?php
				} else {
		?>
					<script>
						window.location = 'teacher-profile.php';
					</script>
		<?php			
				}
			}*/
	  	?>
        <?php include 'checkUserLoginStatus.php';?>
		<?php include 'footer.php';?>
        <?php include 'user-details-alert.php';?>
        <?php //include 'checkUserLoginStatus.php';?>
        <script type="text/javascript">
			$(document).ready(function() {
			});
		</script>
	</body>
</html>
