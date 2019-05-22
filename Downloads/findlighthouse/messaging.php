	<?php include 'head.php';?>
	<?php include 'checkUserLogin.php';?>
	</head>
  	<body class="home-page black-bg">
    	<i id="home-page"></i>
        <?php //include 'header.php';?>
        <div class="header-section full_width_section container white-bg">
        	<div class="row chat_container">
            	<div class="chat_sidebar col-md-4 clean-space">
                	<?php include 'new-left-menu-mess.php';?>
                </div>
            	<div class="col-md-8">
                	<div class="box">
                    	<?php include 'user-top-right.php';?>
                        <div class="box-header"><h3>Select a conversation</h3></div>
                        <div class="box-body dashbord-box-body">
                        	<?php if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0) {?>
                            <div class="userOnlineStatus">
                            	<div class="pull-right">
                                
                                	<?php 
										$to_username = $_REQUEST['user_id'];
										$resultArr = getRowResult(trim('vpb_users'), " WHERE `id` = '".$to_username."'");
										$sqlQuery = "select * from vpb_chat_messages WHERE (`from_username` = '".$_SESSION["user_id"]."' AND `to_username` = '".$to_username."') || (`to_username` = '".$_SESSION["user_id"]."' AND `from_username` = '".$to_username."') order by `id` desc limit 0, 5";
										//echo $sqlQuery;
										$chatArr = getCustomResult($sqlQuery);
			
                                        if($resultArr[0]['photo'] == '') {
                                            $imagePath = 'assets/img/noimage.jpg';
                                        } else {
                                            $imagePath = 'vasplus_chat/photos/'.$resultArr[0]['photo'];
                                        }
                                        if(isset($_REQUEST['user_id'])) {
                                            $to_username = $_REQUEST['user_id'];
                                            $form_data = array(
                                                'read' => 'yes'
                                            );
                                            $resturnVal = dbRowUpdate(trim('vpb_chat_messages'), $form_data, " WHERE `to_username` = '".$to_username."' AND `from_username` = '".$to_username."'");
                                        }
										$onlineStatus = "select * from `vpb_online_users` WHERE `user_id` = '".$to_username."'";
										//echo $sqlQuery;
										$rsOnlineStatus = getCustomResult($onlineStatus);
										if(count($rsOnlineStatus) > 0) {
											$onlineIcons = 'images/icons/greenNotificationDot.png';
										} else {
											$onlineIcons = 'images/icons/redNotificationDot.png';
										}
                                    ?>
                                    
                                    <span class="onlineIcons"><img src="<?php echo $onlineIcons;?>" class="online-status" alt="" /></span> &nbsp; <span class="userNames"><?php echo $resultArr[0]['fullname']?></span><br><small>Last message 2h ago</small>
                                </div>
                            </div>
                        	
                            <div class="row">
                            	<div class="col-sm-8 messageBoxes">
                                
                                    <div class="frame">
                                    	<div class="messageBody">
                                        	<ul class="messageUI"></ul>
                                        </div>
                                        <div class="messageForms">
                                            <div class="msj-rta macro" style="margin:auto">                        
                                                <div class="text text-l message-text-box">
                                                    <input class="mytext message-text" placeholder="Type a message" />
                                                </div> 
                                                <div class="formBtns text-r"><a href="javascript:;" class="f-btns"><img src="images/icons/SendIcon.png" alt="" /></a></div>
                                            </div>
                                        </div>
                                        <p class=""><a href="javascript:;" class="uploadFile">Upload File</a></p>
                                        <div class="uploadFileSection">
                                            <input type="file" id="chatFile" name="file" /> <button id="upload" class="btn btn-success btn-xs">Upload</button>
                                        </div>
                                        <div class="alertMessage" style="display:none"><small><i class="btn btn-success btn-xs">File is Successfullu Upload.</i></small></div>
                                    </div>
                                
                                </div>
                            	<div class="col-sm-4">
                                	<div class="message-right-section">
                                    	<div class="user-icons"><img src="<?php echo $imagePath;?>" alt="" class="img-responsive" /></div>
                                        <div class="user-details">
                                        	<p><?php echo $resultArr[0]['study']?><br>
                                            <?php echo $resultArr[0]['position']?><br>
                                            Mentor since 
											<?php 
												$newDayes = date('F Y', strtotime($resultArr[0]['date']));
												echo $newDayes;
											?><br>
                                            <?php echo $resultArr[0]['extra_note']?><br>
                                            Works with: <?php echo $resultArr[0]['address']?></p>
                                        </div>
                                        <div class="SharedFiles">
                                        	<div class="heading">Shared Files</div>
                                            <?php
												$sqlFileQuery = "select * from vpb_chat_messages WHERE ((`from_username` = '".$_SESSION["user_id"]."' AND `to_username` = '".$to_username."') || (`to_username` = '".$_SESSION["user_id"]."' AND `from_username` = '".$to_username."')) AND `attachment` != '' order by `id` desc limit 0, 10";
												//echo $sqlQuery;
												$fileArr = getCustomResult($sqlFileQuery);
											?>
                                            <ul class="chatFilesAtt">
                                            	<?php for($f = 0; $f < count($fileArr); $f++) {?>
                                            		<li><img src="images/icons/attachment-icon.png" alt="" /> &nbsp; <a href="vasplus_chat/vpb_chat_attachments/<?php echo $fileArr[$f]['attachment']?>" target="_blank"><?php echo $fileArr[$f]['attachment']?></a></li> 
                                                <?php }?>
                                            </ul>
                                        </div>
                                        
                                        <!--<div class="SponcerIcons">
                                        	<div class="row">
                                            	<div class="col-xs-6"><a href="#"><img src="images/icons/bottom-spocer.png" alt="" /></a></div>
                                                <div class="col-xs-6">
                                                	<?php
														$mapAddress = ''; 
														if($resultArr[0]['address'] != '') {
															$mapAddress = str_replace(" ", "+", trim($resultArr[0]['address']));
													?>
                                                    		<iframe width="161" height="161" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCIaE_O4szjBRKRDBnPjqyqc9DXlMTTQx0&q=<?php echo $mapAddress?>&zoom=12" allowfullscreen></iframe>
                                                    <?php
														}
													?>
                                                    <a href="#"><img src="images/icons/MapIcon.png" alt="" /></a>
                                                </div>
                                            </div>
                                        </div>-->
                                        
                                    </div>
                                </div>
                            </div>
                            <?php 
								//$chatArr = array_reverse($chatArr, true);
								$lastId = count($chatArr)-1;
								$lastMsgId = $chatArr[$lastId]['id'];
							?>
                            <input type="hidden" id="LstChatId" value="<?php echo $lastMsgId;?>" />
                            <input type="hidden" id="to_username" value="<?php echo $to_username;?>" />
                            <?php } else {?>
                            	<p align="center">Please Select any one User in Left side.</p>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'user-footer.php';?>
        </div>
        <?php include 'footer.php';?>
        <?php include 'user-details-alert.php';?>
        <?php include 'checkUserLoginStatus.php';?>
        <?php //include 'checkUserLoginStatus.php';?>
        
        <script type="text/javascript">
			var me = {};

			var you = {};
			
			function formatAMPM(date) {
				var hours = date.getHours();
				var minutes = date.getMinutes();
				var ampm = hours >= 12 ? 'PM' : 'AM';
				hours = hours % 12;
				hours = hours ? hours : 12; // the hour '0' should be '12'
				minutes = minutes < 10 ? '0'+minutes : minutes;
				var strTime = hours + ':' + minutes + ' ' + ampm;
				return strTime;
			}            
			
			function insertChat(who, text, dates = '', time = 0, app = 0){
				var control = "";
				//var date = formatAMPM(new Date());
				if(dates == '') {
					var date = formatAMPM(new Date());
				} else {
					var date = dates;
				}
				if (who == "me"){
					control = '<li style="width:100%">' +
									'<div class="msj macro">' +
										'<div class="text text-l">' +
											'<p>'+ text +'</p>' +
											'<p><small>'+date+'</small></p>' +
										'</div>' +
									'</div>' +
								'</li>';               
				} else {
					control = '<li style="width:100%;">' +
									'<div class="msj-rta macro">' +
										'<div class="text text-r">' +
											'<p>'+text+'</p>' +
											'<p><small>'+date+'</small></p>' +
										'</div>' +
									'<div class="avatar" style="padding:0px 0px 0px 10px !important"></div>' +                                
							  '</li>';
				}
				setTimeout(
					function() {
						//$("ul.messageUI").append(control);
						if(app == 0) {
							$("ul.messageUI").prepend(control);
						} else {
							$("ul.messageUI").append(control);
						}
					}, time);
			}
			function LoadMore(loading = 0){
				var LoadMore = '';
				if (loading == "1"){
					LoadMore = '<li style="width:100%" class="load-more-li"><p class="load-more-chat"><a class="btn btn-success" href="javascript:;">Load More</a></p></li>';
					
					setTimeout(
						function() {
							//$("ul.messageUI li:eq(0)").append(LoadMore);
							$("ul.messageUI").prepend(LoadMore);
						}, 0);
				}
			}
			function resetChat(){
				$("ul.messageUI").empty();
			}
			$(".mytext").on("keyup", function(e){
				if (e.which == 13){
					var text = $(this).val();
					if (text !== ""){
						insertChat("me", text, '', 0, 1);
						$(this).val('');
						
						$.ajax({
							type: 'POST',
							url: 'saveChat.php',
							data: 'chat=1&chatText='+text+'&to_username='+$('#to_username').val(),
							success: function(data) {
							}
						});
						
					}
				}
			});
			$(".f-btns").on("click", function(e){
				var text = $(".mytext").val();
				if (text !== ""){
					insertChat("me", text, '', 0, 1);
					$(this).val('');
					
					$.ajax({
						type: 'POST',
						url: 'saveChat.php',
						data: 'chat=1&chatText='+text+'&to_username='+$('#to_username').val(),
						success: function(data) {
						}
					});	
				}
			});
			resetChat();
			<?php 
				for($chat = 0; $chat < count($chatArr); $chat++) {
				//for($chat = (count($chatArr) - 1); $chat >= 0; $chat--) {
					if($_SESSION["user_id"] == $chatArr[$chat]["from_username"]) {
						$userTypes = 'me';
					} else {
						$userTypes = 'you';
					}
					$newDate = date("m-d-y, h:i", $chatArr[$chat]['date_sent']);
					
					$form_data = array(
						'read' => 'yes'
					);
					$resturnVal = dbRowUpdate(trim('vpb_chat_messages'), $form_data, " WHERE `to_username` = '".$_SESSION['user_id']."' AND `from_username` = '".$to_username."'");
			?>
				insertChat("<?php echo $userTypes?>", "<?php echo trim($chatArr[$chat]['message']);?>", "<?php echo $newDate;?>", 0);  
			<?php }?>
            function checkUserOnline(user_id) { 
            	$.ajax({
				  type : 'POST',
				  url  : 'checkOnlineIcon.php',
				  data : 'user_id='+user_id,
				  success :  function(data) {
					$('.onlineIcons').html('<img src="'+data+'" class="online-status" alt="" />');
				  }
				});
				//$.post("onlineStatusUpdates.php");
            } 
			$(document).ready(function() {
				var $rows = $('#chatUsers li');
				$('.search-query').keyup(function() {
					var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
					
					$rows.show().filter(function() {
						var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
						return !~text.indexOf(val);
					}).hide();
				});
				<?php if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0) {?>
					setInterval(function(){
						$.ajax({
							type: 'POST',
							url: 'getLoadMoreChat.php',
							data: 'readNew=1&lastChatIds='+$('#LstChatId').val()+'&to_username='+$('#to_username').val(),
							success: function(data) {
								var dataArray = jQuery.parseJSON(data);
								$.each(dataArray.res, function(_, item){
									insertChat(item.userTypes, item.message, item.date_sent, 0, 1);
									//$('#title').append('<p> Title: ' + item.title + '</p>'); 
									if(item.attachment != '') {
										$('.chatFilesAtt').append('<li><img src="images/icons/attachment-icon.png" alt=""> &nbsp; <a href="vasplus_chat/vpb_chat_attachments/'+item.attachment+'" target="_blank">'+ item.attachment +'</a></li>');
									}
								});
							}
						});
					}, 5000);
					setInterval("checkUserOnline(<?php echo $_REQUEST['user_id']?>)", 25000);
				<?php }?>
				$(document).on('click', '.uploadFile', function () {
					$('.uploadFileSection').show();
				});
				$(document).on('click', '.load-more-chat a', function () {
					$('.load-more-li').remove();
					
					$.ajax({
						type: 'POST',
						url: 'getLoadMoreChat.php',
						data: 'readNew=0&lastChatIds='+$('#LstChatId').val()+'&to_username='+$('#to_username').val(),
						success: function(data) {
							var dataArray = jQuery.parseJSON(data);

							$('#LstChatId').val( dataArray.lastMsgId );
							$.each(dataArray.res, function(_, item){
								insertChat(item.userTypes, item.message, item.date_sent, 0);
								//$('#title').append('<p> Title: ' + item.title + '</p>');
								/*if(item.attachment != '') {
									$('.chatFilesAtt').append('<li><img src="images/icons/attachment-icon.png" alt=""> &nbsp; <a href="vasplus_chat/vpb_chat_attachments/'+item.attachment+'" target="_blank">'+ item.attachment +'</a></li>');
								}*/
							});
							if(dataArray.totalRecord > 4) {
								LoadMore(1);
							}
						}
					});
				});
				
				$('#upload').on('click', function () {
                    var file_data = $('#chatFile').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);
					form_data.append('chatFiles', 1);
					form_data.append('to_username', $('#to_username').val());
                    $.ajax({
						type: 'POST',
                        url: 'saveChat.php',
						data: form_data,
						dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
							var dataArray = jQuery.parseJSON(response);
                            //$('#msg').html(response);
							if(dataArray.errorType == 1) {
								alert('Sorry, File is Wrong. Please try again.');
							} else {
								if(dataArray.fullPathFileNmae != '') {
									$('.alertMessage').show('slow');
									$(".alertMessage").delay(5000).fadeOut("slow");
									$('.uploadFileSection').hide();
									$('#chatFiles').val('');
									insertChat("me", 'File uploaded: '+dataArray.FileNmae, '', 0, 1);
									$('.chatFilesAtt').append('<li><img src="images/icons/attachment-icon.png" alt=""> &nbsp; <a href="'+dataArray.fullPathFileNmae+'" target="_blank">'+ dataArray.FileNmae +'</a></li>');
								}
							}
                        },
                        error: function (response) {
							alert('Sorry, File is Wrong. Please try again.');
                            //$('#msg').html(response); // display error response from the PHP script
                        }
                    });
                });
				
			});
			LoadMore(1);	
			
		</script>
        
	</body>
</html>
