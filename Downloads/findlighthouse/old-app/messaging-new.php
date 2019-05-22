	<?php include 'head.php';?>
	</head>
  	<body class="home-page ">
    	<i id="home-page"></i>
        <?php //include 'header.php';?>
        <div class="header-section full_width_section">
        	<div class="row">
            	<div class="col-sm-3 clean-space">
                	<?php include 'new-left-menu-mess.php';?>
                </div>
            	<div class="col-sm-9">
                	<div class="box">
                    	<div class="box-head head-icons">
                        	<div class="pull-right">
                        		<a href="" class="setting-opt"><img src="images/setting-icons-1.png" class="icon-imgs" alt="" /></a>
                                <a href="" class="setting-opt"><img src="images/setting-icons-2.png" class="icon-imgs" alt="" /></a>
                                <a href="" class="setting-opt"><img src="images/setting-icons-3.png" class="icon-imgs" alt="" /></a>
                        	</div>
                        </div>
                        <div class="box-header"><h3>Select a conversation</h3></div>
                        <div class="box-body dashbord-box-body">
                            <div class="userOnlineStatus">
                            	<div class="pull-right">
                                	<img src="images/icons/NotificationDot.png" class="online-status" alt="" /> &nbsp; <span class="userNames">Jane Doe</span><br><small>Last message 2h ago</small>
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
                                                <div class="text text-r">
                                                    <input class="mytext" placeholder="Type a message"/>
                                                </div> 
                                                <div class="formBtns"><a href="javascrpt:;" class="f-btns"><img src="images/icons/SendIcon.png" alt="" /></a></div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            	<div class="col-sm-4">
                                	<div class="message-right-section">
                                    	<div class="user-icons"><img src="images/right-user-icon.png" alt="" class="img-responsive" /></div>
                                        <div class="user-details">
                                        	<p>Freshman<br>
                                            Computer Science<br>
                                            Mentor since May 2017<br>
                                            Works with: Orientation, Office of Women's<br>
                                            Affairs, and The UGA Department of Housing.</p>
                                        </div>
                                        <div class="SharedFiles">
                                        	<div class="heading">Shared Files</div>
                                            <ul>
                                            	<li><a href=""><img src="images/icons/attachment-icon.png" alt="" /> &nbsp; example application essay.pdf</a></li>
                                                <li><a href=""><img src="images/icons/attachment-icon.png" alt="" /> &nbsp; example application essay.pdf</a></li>
                                            </ul>
                                        </div>
                                        
                                        <div class="SponcerIcons">
                                        	<div class="row">
                                            	<div class="col-xs-6"><a href=""><img src="images/icons/bottom-spocer.png" alt="" /></a></div>
                                                <div class="col-xs-6"><a href=""><img src="images/icons/MapIcon.png" alt="" /></a></div>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
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
        <?php include 'footer.php';?>
        
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
			
			//-- No use time. It is a javaScript effect.
			function insertChat(who, text, time = 0){
				var control = "";
				var date = formatAMPM(new Date());
				
				if (who == "me"){
					
					control = '<li style="width:100%">' +
									'<div class="msj macro">' +
										'<div class="text text-l">' +
											'<p>'+ text +'</p>' +
											'<p><small>'+date+'</small></p>' +
										'</div>' +
									'</div>' +
								'</li>';                    
				}else{
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
					function(){                        
						$("ul.messageUI").append(control);
			
					}, time);
				
			}
			
			function resetChat(){
				$("ul.messageUI").empty();
			}
			
			$(".mytext").on("keyup", function(e){
				if (e.which == 13){
					var text = $(this).val();
					if (text !== ""){
						insertChat("me", text);              
						$(this).val('');
					}
				}
			});
			
			//-- Clear Chat
			resetChat();
			
			//-- Print Messages
			insertChat("me", "Hello Tom...", 0);  
			insertChat("you", "Hi, Pablo", 1500);
			insertChat("me", "What would you like to talk about today?", 3500);
			insertChat("you", "Tell me a joke",7000);
			insertChat("me", "Spaceman: Computer! Computer! Do we bring battery?!", 9500);
			insertChat("you", "LOL", 12000);
			insertChat("you", "LOL", 15000);
			insertChat("me", "Wow", 18000);
			insertChat("you", "Nice", 20000);
			insertChat("you", "Good", 22000);
			insertChat("me", "well", 24000);
			insertChat("me", "yes", 25000);
			
			//-- NOTE: No use time on insertChat.
		</script>
        
	</body>
</html>
