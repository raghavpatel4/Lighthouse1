<script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  
  <script src="js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="js/flot/date.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>
  
  <!-- form wizard -->
  <script type="text/javascript" src="js/wizard/jquery.smartWizard.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(document).ready(function() {
		$(document).on('change', '#checkSchoolUsername', function () {
			var itm_val = $(this).val();
			var user_type = $(this).attr('data-id');
			if(itm_val != '') {
				$.ajax({
					type: 'POST',
					url: 'check-add-school-val.php',
					data: 'itm_val='+itm_val+'&user_type='+user_type+'&itm_type=2',
					success: function(data) {
						if(data > 0) {
							$("#username_errors").html('Sorry, This Username is already Registered. Please Try again.');
							$('#checkSchoolUsername').val('');
							$('#checkSchoolUsername').focus();
						} else {
							$("#username_errors").html('');
						}
					}
				});
			}
		});
		$(document).on('change', '#checkSchoolEmailId', function () {
			var itm_val = $(this).val();
			var user_type = $(this).attr('data-id');
			if(itm_val != '') {
				$.ajax({
					type: 'POST',
					url: 'check-add-school-val.php',
					data: 'itm_val='+itm_val+'&user_type='+user_type+'&itm_type=1',
					success: function(data) {
						if(data > 0) {
							$("#email_errors").html('Sorry, This Email ID is already Registered. Please Try again.');
							$('#checkSchoolEmailId').val('');
							$('#checkSchoolEmailId').focus();
						} else {
							$("#email_errors").html('');
						}
					}
				});
			}
		});
		$(document).on('change', '#checkUserEmailId', function () {
			var itm_val = $(this).val();
			var user_type = $(this).attr('data-id');
			if(itm_val != '') {
				$.ajax({
					type: 'POST',
					url: 'check-add-user-email.php',
					data: 'itm_val='+itm_val+'&user_type='+user_type,
					success: function(data) {
						if(data > 0) {
							$("#email_errors").html('Sorry, This Email ID is already Registered. Please Try again.');
							$('#checkUserEmailId').val('');
							$('#checkUserEmailId').focus();
						} else {
							$("#email_errors").html('');
						}
					}
				});
			}
		});
    	$('#wizard').smartWizard();
      // [17, 74, 6, 39, 20, 85, 7]
      //[82, 23, 66, 9, 99, 6, 2]
      var data1 = [
        [gd(2012, 1, 1), 17],
        [gd(2012, 1, 2), 74],
        [gd(2012, 1, 3), 6],
        [gd(2012, 1, 4), 39],
        [gd(2012, 1, 5), 20],
        [gd(2012, 1, 6), 85],
        [gd(2012, 1, 7), 7]
      ];

      var data2 = [
        [gd(2012, 1, 1), 82],
        [gd(2012, 1, 2), 23],
        [gd(2012, 1, 3), 66],
        [gd(2012, 1, 4), 9],
        [gd(2012, 1, 5), 119],
        [gd(2012, 1, 6), 6],
        [gd(2012, 1, 7), 9]
      ];
      $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
        data1, data2
      ], {
        series: {
          lines: {
            show: false,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 0,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          verticalLines: true,
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#fff'
        },
        colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
        xaxis: {
          tickColor: "rgba(51, 51, 51, 0.06)",
          mode: "time",
          tickSize: [1, "day"],
          //tickLength: 10,
          axisLabel: "Date",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Verdana, Arial',
          axisLabelPadding: 10
            //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
        },
        yaxis: {
          ticks: 8,
          tickColor: "rgba(51, 51, 51, 0.06)",
        },
        tooltip: false
      });

      function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
      }
    });
  </script>
<script src="js/validator/validator.js"></script>

<!-- Datatables -->
        <!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

<!-- Datatables-->
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js/datatables/dataTables.bootstrap.js"></script>
<script src="js/datatables/dataTables.buttons.min.js"></script>
<script src="js/datatables/buttons.bootstrap.min.js"></script>
<script src="js/datatables/jszip.min.js"></script>
<script src="js/datatables/pdfmake.min.js"></script>
<script src="js/datatables/vfs_fonts.js"></script>
<script src="js/datatables/buttons.html5.min.js"></script>
<script src="js/datatables/buttons.print.min.js"></script>
<script src="js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="js/datatables/dataTables.keyTable.min.js"></script>
<script src="js/datatables/dataTables.responsive.min.js"></script>
<script src="js/datatables/responsive.bootstrap.min.js"></script>
<script src="js/datatables/dataTables.scroller.min.js"></script>

<!-- select2 -->
<script src="js/select/select2.full.js"></script>

<script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);
    $('#datatable').dataTable();
    $(".select2_single").select2({
    	placeholder: "Select a state",
    	allowClear: true
  	});
  	$('.datepicker').daterangepicker({
	    singleDatePicker: true,
	    calender_style: "picker_1"
	  }, function(start, end, label) {
	    console.log(start.toISOString(), end.toISOString(), label);
  });
</script>
<script>
    NProgress.done();
</script>
<!-- /datepicker -->

	<!--<link rel="stylesheet" type="text/css" href="../vasplus_chat/css/vasplus_chat.css">

	<script type="text/javascript" src="../vasplus_chat/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="../vasplus_chat/js/jquery.eventsource.js"></script>
	<script type="text/javascript" src="../vasplus_chat/js/vasplus_chat.js"></script>-->

	<?php
		//$_SESSION["from_username"] = 'victor'; // Set your logged in user username as it is in your database users table here
		/*$userName = '';
		if(isset($_SESSION["from_username"])) {
			//$_SESSION["from_username"] = isset($_GET["username"]) ? strip_tags($_GET["username"]) : 'victor'; // This is a demo for username passed to the URL	
			//$_SESSION["from_username"] = $_SESSION['first_name'].' '.$_SESSION['last_name'];;
			echo '<input type="hidden" id="from_username_identity" value="'.strip_tags($_SESSION["from_username"]).'" />';
		}*/
	?>