<div class="userMenuBox">
	<?php include 'right-side-usermenu.php';?>
    <div class="grey-bc userMenuDetails">
        <?php include 'user-detail-rightbar.php';?>
        
        <?php $friendArr = getRowResult(trim('vpb_chat_friends'), " WHERE `user` = '".$_SESSION["user_id"]."'");?>
        <?php //echo '<pre>'; print_r($friendArr);echo '</pre>';?>
        <div class="member-section">
            <!--<div id="custom-search-input hide">
               <div class="">
               		<button class="btn btn-danger" type="button">
                  		<span class=" glyphicon glyphicon-search"></span>
                  	</button>
                  	<input type="text" class="search-query form-control" placeholder="Search Inbox" />
               </div>
            </div>-->
            <div class="member_list user-lists">
               <ul class="list-unstyled" id="chatUsers">
               	<?php for($user = 0; $user < count($friendArr); $user++) {?>
                    <?php 
                        $resultArr1 = getRowResult(trim('vpb_users'), " WHERE `id` = '".$friendArr[$user]["friend"]."'");
                        if($resultArr1[0]['photo'] == '') {
                            $imagePath1 = 'assets/img/noimage.jpg';
                        } else {
                            $imagePath1 = 'vasplus_chat/photos/'.$resultArr1[0]['photo'];
                        }
                        $unReadMsg = getRowResult(trim('vpb_chat_messages'), " WHERE `to_username` = '".$_SESSION['user_id']."' AND `from_username` = '".$resultArr1[0]['id']."' AND `read` = 'no'");
                    ?>
                
                	<li class="left clearfix <?php if($resultArr1[0]['id'] == $_REQUEST['user_id']) {?> currentBGUsers<?php }?>">
                         <a href="messaging.php?user_id=<?php echo $resultArr1[0]['id']?>">
                             <span class="chat-img pull-left">
                             <img src="<?php echo $imagePath1;?>" alt="User Avatar" class="img-circle">
                             </span>
                             <div class="chat-body clearfix">
                                <div class="header_sec">
                                   <strong class="primary-font"><?php echo $resultArr1[0]['fullname']?></strong> 
                                   <!--<strong class="pull-right">09:45AM</strong>-->
                                </div>
                                <div class="contact_sec">
                                   <span class="primary-font"><small>
								   <?php 
								   	$textarticle = strip_tags(trim($resultArr1[0]['extra_note']));
									//$textarticle = $videoResArr[$video]['synopsis'];
									if (strlen($textarticle) > 40) {
										$stringCut = substr($textarticle, 0, 40);
										$textarticle = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
									} 
									echo $textarticle;
								   ?>
                                   </small></span> 
                                   <span class="badge pull-right totalMsg"><?php if(count($unReadMsg) > 0) {?><span><?php echo count($unReadMsg);?></span><?php }?></span>
                                </div>
                             </div>
                         </a>
                    </li>
                <?php }?>
               </ul>
        	</div>
        </div>
        
        <!--<div class="user-lists"><img src="images/message-user-list.png" alt="" /></div>-->
        <?php //include 'copyright.php';?>
            
	</div>
</div>
