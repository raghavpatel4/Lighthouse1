<?php include 'head.php';?>

</head>
<body class="nav-md">

  <div class="container body">
    <div class="main_container">
		<?php include 'nav-bar.php';?>
      
		<?php include 'header.php';?>

      <div class="right_col" role="main">

        <div class="row tile_count">
          <div class="animated flipInY col-md-6 col-sm-6 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <?php $totalNoTeahcer = getRowResult(trim('vpb_users'), " WHERE `user_type` = '2' AND `id` > '1'");?>
              <span class="count_top"><i class="fa fa-user"></i> Total Mentor</span>
              <div class="count"><?php echo count($totalNoTeahcer);?></div>
              <span class="count_bottom"></span>
            </div>
          </div>
          <div class="animated flipInY col-md-6 col-sm-6 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <?php $totalNoStd = getRowResult(trim('vpb_users'), " WHERE `user_type` = '1' AND `id` > '1'");?>
              <span class="count_top"><i class="fa fa-user"></i> Total Students</span>
              <div class="count"><?php echo count($totalNoStd);?></div>
              <span class="count_bottom"></span>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

              <div class="row x_title">
                <div class="col-md-12">
                  <h3>All Activities <small>Daily New Registration User and Mentor</small></h3>
                </div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                <div style="width: 100%;">
                  <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                </div>
              </div>

              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        <br />
        <?php include 'footer.php';?>
      </div>
    </div>

  </div>

  <?php include 'footer-js.php';?>
  
</body>
</html>
