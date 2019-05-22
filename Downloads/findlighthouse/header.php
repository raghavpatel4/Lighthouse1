<?php
	//echo '<pre>';print_r($_SESSION);echo '</pre>';
?>
<div class="full-section home-top-section">
    <header>
    	<div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>
                  <?php 
                    //echo '<pre>';print_r($_SERVER);echo '</pre>';die;
                    if(isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF'] == '/dev/index.php') {
                        include 'home-menu.php';
                    } else {
                        include 'inner-menu.php';
                    }
                  ?>
                </div>
            </nav>
		</div>    
        <!--<div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="home-box">
                        <p align="center"><a href="index.php"><img src="assets/img/home-logo.png" class="web-logo" alt="" /></a></p>
                        <h3 align="center">Lighthouse</h3>
                        <p align="center">Guiding future leaders today</p>
                    </div>
                </div>
            </div>
        </div>-->
    </header>
    
    <!--<div class="wrapper">
        <div class="triangle-down"><div></div></div>
    </div>-->
</div>