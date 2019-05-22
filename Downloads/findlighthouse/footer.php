
<!--<footer  class="body-section">
    <p class="centered">&copy; COPYRIGHT LIGHTHOUSE 2017 | DESIGNED BY SALONI DOSHI DESIGNS </p>
    <p class="centered"><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a> <a href=""><i class="fa fa-pinterest" aria-hidden="true"></i></a></p>
</footer>-->

<link rel="stylesheet" href="superadmin/css/front-bootstrap.min.css">
<script src="superadmin/js/bootstrap.min.js"></script>

<link href="superadmin/js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="superadmin/js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="superadmin/js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="superadmin/js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="superadmin/js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="assets/jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script type="text/javascript" src="assets/js/jquery.formdata.js"></script>

<script type="text/javascript" src="superadmin/js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/jszip.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/pdfmake.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/vfs_fonts.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/buttons.print.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/responsive.bootstrap.min.js"></script>
<script type="text/javascript" src="superadmin/js/datatables/dataTables.scroller.min.js"></script>

<script src="assets/zabuto_calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/zabuto_calendar/zabuto_calendar.min.css">

<script type="text/javascript">
	function goToByScroll(id) {
		$('html,body').animate({scrollTop: $("#"+id).offset().top}, 'slow');
	}

	$(document).ready(function() {
		$("#my-calendar").zabuto_calendar({
			ajax: {
				//url: "show_data.php",
				url: 'reminder_data.php',
				modal: true
			}
		});
		$('.dynamicFiltter').dataTable();
		$( ".datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
		
		$(document).on('submit', '.LoginForm', function() {
			//alert('Hi');
			$.ajax({
			  type: 'post',
			  url: 'new-login.php',
			  data: $(this).serialize(),
			  success: function (response) {
				if(response == 'Wrong') {
					swal({
					  title: "Sorry!",
					  text: "Your Email Address and Password are wrong please try again.",
					  type: "warning",
					  timer: 4000,
					  showConfirmButton: false
					});
				} else {
					window.location = 'dashboard.php';
				}
			  }
			});
			return false;
		});
		
		$(document).on('click', '.add-more-college-list', function () {
			swal({
			  title: "Write College Check List!",
			  text: "Create College Check List:",
			  type: "input",
			  showCancelButton: true,
			  closeOnConfirm: true,
			  inputPlaceholder: "College Check List"
			}, function (inputValue) {
			  if (inputValue === false) return false;
			  if (inputValue === "") {
				swal.showInputError("You need to write College Check List!");
				return false
			  }
			  
			  $.ajax ({
				type: "POST",
				url: 'college-action.php',
				data: "method=createNew&collegeTitle="+inputValue,
				success: function(msg) {
					//alert(msg);
					if(msg > '0') {
						//$('ul.college_list_ul').append('<li><input type="checkbox" class="checkbox-inline college-checkbox-list" checked="checked" id="p_college_'+msg+'" data-id="'+msg+'"> <label for="p_college_'+msg+'" class="str_'+msg+' text-through">'+inputValue+'</label></li>');
						$('ul.college_list_ul').append('<li><input type="checkbox" class="checkbox-inline college-checkbox-list" id="p_college_'+msg+'" data-id="'+msg+'"> <label for="p_college_'+msg+'" class="str_'+msg+'">'+inputValue+'</label></li>');
					} else {
						alert("Something wrong, Please try again.");
					}
				}
			  });
			  
			  //swal("Nice!", "You wrote: " + inputValue, "success");
			});
		});
		$(document).on('change', '.college-checkbox-list', function() {
			var checkboxId = $(this).attr('data-id');
			if($(this).prop('checked')) {
				var process = 1;
				$('.str_'+checkboxId).addClass('text-through');
			} else {
				var process = 0;
				$('.str_'+checkboxId).removeClass('text-through');
			}
			$.ajax({
			  type: 'post',
			  url: 'college-action.php',
			  data: "method=createCheck&c_id="+checkboxId+'&process='+process,
			  success: function (response) {
				
			  }
			});
		});
		$(document).on('submit', '.contactUsForm', function() {
			//alert('Hi');
			$.ajax({
			  type: 'post',
			  url: 'contact-mail.php',
			  data: $(this).serialize(),
			  success: function (response) {
				if(response == '1') {
					swal({
					  title: "Thank you!",
					  text: "Your Message has been sent.",
					  type: "success",
					  timer: 4000,
					  showConfirmButton: false
					});
					$('#contactName').val('');
					$('#contactEmail').val('');
					$('#contactMsg').val('');
				} else {
					swal({
					  title: "Sorry!",
					  text: "Your Email Address not sent please try again.",
					  type: "warning",
					  timer: 4000,
					  showConfirmButton: false
					});
				}
			  }
			});
			return false;
		});
		$(".menuBar a").click(function() { 
			goToByScroll($(this).attr("class"));
		});
		<?php if(isset($_SESSION["user_id"])) {?>
			setInterval(function(){
			   //alert('ttt');
			   $.ajax({
				  type : 'POST',
				  url  : 'totalUnReadMsg.php',
				  data : '',
				  success :  function(data) {
					//$(".user-menu .totalMsg").html(data);
					$(".icon-bar .totalMsg").html(data);
				  }
				});
			}, 5000);
		<?php }?>
		$(document).on('submit', '#submitForm', function() {
			if($('#to_username').val() == 0) {
				alert('Please Select any User!');
				return false;
			} else {
				if($('#chatText').val() != '') {
					var data = $(this).serialize();
					$.ajax({
					  type : 'POST',
					  url  : 'chat-message.php',
					  data : data,
					  success :  function(data) {
						$(".jspContainer").html(data);
						$('#chatText').val('');
						$('#chatLineHolder').animate({scrollTop: $('#chatLineHolder')[0].scrollHeight}, 500);
					  }
					});
				}
				return false;
			}
		});

		//$("button").click(function(){
		$(document).on('click', '.aboutPopUpButtons', function () {
			var filename = $(this).attr('data-title');
			var action = $(this).attr('data-id');
			$.ajax({
				type: 'POST',
				url: filename,
				data: 'action='+action,
				success: function(data) {
					//$('#footers').html(data);
					swal({   
						title: "About Us",
						text: data,
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Ok",
						html: true
					});
				}
			});
		});
		
		$(document).on('change', '#forgotEmailId', function () {
			var email_id = $(this).val();
			$.ajax({
				type: 'POST',
				url: 'check-user-email.php',
				data: 'email_id='+email_id,
				success: function(data) {
					if(data == 0) {
						//$("#login_errors").html('Sorry, This Email ID is already Registered. Please Try again.');
						swal({
						  title: "Wrong!",
						  text: "Sorry, This Email ID is Not available. Please Try again.",
						  type: "warning",
						  confirmButtonColor: "#DD6B55",
						  confirmButtonText: "Oh, Ok"
						});
						$('#forgotEmailId').val('');
						$('#forgotEmailId').focus();
					}
				}
			});
		});
		$(document).on('change', '#signUpEmailId', function () {
			var email_id = $(this).val();
			$.ajax({
				type: 'POST',
				url: 'check-user-email.php',
				data: 'email_id='+email_id,
				success: function(data) {
					if(data == 1) {
						//$("#login_errors").html('Sorry, This Email ID is already Registered. Please Try again.');
						swal({
						  title: "Wrong!",
						  text: "Sorry, This Email ID is already Registered. Please Try again.",
						  type: "warning",
						  confirmButtonColor: "#DD6B55",
						  confirmButtonText: "Oh, Ok"
						});
						$('#signUpEmailId').val('');
						$('#signUpEmailId').focus();
					}
				}
			});
		});
		
		$(document).on('click', '.popUpButtons', function () {
			var filename = $(this).attr('data-title');
			var action = $(this).attr('data-id');
			var title = $(this).attr('title');
			$.ajax({
				type: 'POST',
				url: 'login-form.php',
				data: 'action='+action,
				success: function(data) {
					//$('#footers').html(data);
					swal({   
						title: title,
						text: data,
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Login",   
						cancelButtonText: "Cancel",   
						closeOnConfirm: false,   
						//closeOnCancel: false
						html: true
					}, function(isConfirm){
						window.onkeydown = null;
						window.onfocus = null;
						if (isConfirm) {
							
							var email_id = $('#login-email').val();
							var password = $('#login-password').val();

							$.ajax({
								type: 'POST',
								url: 'create-login.php',
								data: 'action='+action+'&email_id='+email_id+'&password='+password,
								success: function(data) {
									//$('#footers').html(data);
									if(data == 0) {
										$("#login_errors").html('Sorry, Your Email ID and Password wrong. Please Try again.');
									} else {
										if(action == '1') {
											window.location = 'user-profile.php';	
										} else {
											window.location = 'teacher-profile.php';	
										}
									}
								}
							});
						} else {
						} 
					});
					$('.cancel').removeAttr( "tabindex" );
					$('.confirm').removeAttr( "tabindex" );
					$('.sweet-overlay').removeAttr( "tabindex" );
					//$('fieldset input').removeAttr( "tabindex" );
				}
			});
		});
		
		$(document).on('click', '.popUpRegistration', function () {
			var action = $(this).attr('data-id');
			var title = $(this).attr('title');
			$.ajax({
				type: 'POST',
				url: 'signup_form.php',
				data: 'action='+action,
				success: function(data) {
					//$('#footers').html(data);
					swal({   
						title: title,
						text: data,
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Sign Up",   
						cancelButtonText: "Cancel",   
						closeOnConfirm: false,   
						//closeOnCancel: false
						html: true
					}, function(isConfirm){   
						if (isConfirm) {
							
							var first_name = $('#first_name').val();
							var last_name = $('#last_name').val();
							var email_id = $('#signUpEmailId').val();
							var password = $('#registration-password').val();
							var confirm_password = $('#confirm-password').val();
							var profileIcon = $('#profileIcon').val();
							
							if(profileIcon == '') {
								alert('Please Select Your Profile Image.');
								$('#profile_img').focus();
							} else if(first_name == '') {
								alert('Please Enter Your First Name.');
								$('#first_name').focus();
							} else if(last_name == '') {
								alert('Please Enter Your Last Name.');
								$('#last_name').focus();
							} else if(email_id == '') {
								alert('Please Enter Your Email Address.');
								$('#signUpEmailId').focus();
							} else if(password.length < 8) {
								alert('Password Should be Minimum 8 Characters.');
								$('#registration-password').focus();
							} else if($('#passwordVal').val() == 0) {
								alert('Password must contain at least one uppercase (A-Z) and one lowercase (a-z) and one number and one special character!');
								$('#registration-password').focus();
							} else if(password != confirm_password) {
								alert('Please Enter Correct Confirm Password.');
								$('#registration-password').focus();
							} else {
								$.ajax({
									type: 'POST',
									url: 'create-new-registration.php',
									data: 'action='+action+'&email_id='+email_id+'&password='+password+'&first_name='+first_name+'&last_name='+last_name+'&profileIcon='+profileIcon,
									success: function(data) {
										//$('#footers').html(data);
										if(data == 0) {
											$("#login_errors").html('Sorry, Your Data is wrong. Please Try again.');
										} else {
											$("#login_errors").html('Your Account is Successfully Create. Now Admin Create Active so, You can All Access.');
											/*if(action == '1') {
												window.location = 'user-profile.php';	
											} else {
												window.location = 'teacher-profile.php';	
											}*/
										}
									}
								});	
							}

						} else {
						} 
					});
					$('.cancel').removeAttr( "tabindex" );
					$('.confirm').removeAttr( "tabindex" );
					$('.sweet-overlay').removeAttr( "tabindex" );
				}
			});
		});
		
		$(document).on('click', '.popUpForgotPass', function () {
			var action = $(this).attr('data-id');
			var title = $(this).attr('title');
			$.ajax({
				type: 'POST',
				url: 'forgot_pass_form.php',
				data: 'action='+action,
				success: function(data) {
					//$('#footers').html(data);
					swal({   
						title: title,
						text: data,
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Send",   
						cancelButtonText: "Cancel",   
						closeOnConfirm: false,   
						//closeOnCancel: false
						html: true
					}, function(isConfirm){   
						if (isConfirm) {
							if(action == '1') {
								//window.location = 'user-profile.php';	
							} else {
								//window.location = 'teacher-profile.php';	
							}
						} else {
						} 
					});
				}
			});
		});
		$(document).on( "click", ".removeImg", function () {
			var imgName = $(this).attr('data-id');
			//var userIconPreview = $(this).attr('data-title');
			var userIconPreview = $(this).attr('name');
			
			$.ajax ({
				type: "POST",
				url: 'removeImg.php',
				data: "imgName="+imgName,
				success: function(msg) {
					//$("#DataContainer").ajaxComplete(function(event, request, settings) {
					$("#"+userIconPreview).html('<input type="hidden" name="profileIcon" value="" id="profileIcon" />');
					//});
				}
			});
		});
		
		$(document).on( "change", ".userIcon", function () {
			$("#userIconPreview").html('');
			$("#userIconPreview").html('<img src="loader.gif" alt="Uploading...."/>');
			$("#userIconForm").ajaxForm({
				target: '#userIconPreview'
			}).submit();
			$('.saveProfileLogo').show();
		});
		
	});
	
	function CheckPasswordStrength(password) {
		var password_strength = document.getElementById("password_strength");

		//TextBox left blank.
		if (password.length == 0) {
			password_strength.innerHTML = "";
			return;
		}

		//Regular Expressions.
		var regex = new Array();
		regex.push("[A-Z]"); //Uppercase Alphabet.
		regex.push("[a-z]"); //Lowercase Alphabet.
		regex.push("[0-9]"); //Digit.
		regex.push("[$@$!%*#?&]"); //Special Character.

		var passed = 0;

		//Validate for each Regular Expression.
		for (var i = 0; i < regex.length; i++) {
			if (new RegExp(regex[i]).test(password)) {
				passed++;
			}
		}

		//Validate for length of Password.
		if (passed > 2 && password.length > 8) {
			passed++;
		}

		//Display status.
		var color = "";
		var strength = "";
		switch (passed) {
			case 0:
			case 1:
				strength = "Weak";
				color = "red";
				$('#passwordVal').val('0');
				break;
			case 2:
				strength = "Good";
				color = "darkorange";
				$('#passwordVal').val('0');
				break;
			case 3:
			case 4:
				strength = "Strong";
				color = "green";
				$('#passwordVal').val('1');
				break;
			case 5:
				strength = "Very Strong";
				color = "darkgreen";
				$('#passwordVal').val('1');
				break;
		}
		password_strength.innerHTML = strength;
		password_strength.style.color = color;
	}

</script>
