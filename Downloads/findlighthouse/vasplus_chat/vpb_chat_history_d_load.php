<?php
/********************************************************************************
* Gmail / Facebook Style Chat Application with jQuery and PHP
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: vasplusblog@gmail.com OR info@vasplus.info

*********************************Copyright Info***********************************
* This is a paid script and must not be sold by any client
* Please do not remove this copyright information from the top of this page
* All Copy Rights Reserved by Vasplus Programming Blog
***********************************************************************************/
//No magic Quotes
function vpb_no_magic_quotes($text) 
{
	$query = trim(strip_tags(htmlspecialchars($text)));
	$data = explode("\\",$query);
	$cleaned = implode("",$data);
	return $cleaned;
}

//This function is responsible for date/time formatting
function vpb_time_sent( $timestamp )
{
    if( !is_numeric( $timestamp ) ) {
        $timestamp = strtotime( $timestamp );
        if( !is_numeric( $timestamp ) )
		{
            return "";
        }
    }
    $difference = time() - $timestamp;
    $periods = array( "second", "minute", "hour", "day", "week", "month", "years", "decade" );
    $lengths = array( "60","60","24","7","4.35","12","10");
    if ($difference > 0) {
		// this was in the past
        $ending = "ago";
    }
	else {
		// this was in the future
        $difference = -$difference;
        $ending = "to go";
    }
    for( $j=0; $difference>=$lengths[$j] and $j < 7; $j++ )
        $difference /= $lengths[$j];
    $difference = round($difference);
    if( $difference != 1 ) {
        // Also change this if needed for an other language
        $periods[$j].= "s";
    }
    $vpb_Text = "$difference $periods[$j] $ending";
    return $vpb_Text;
}

//This function formats all URLs in a comment
function vpb_create_links($vpb_Text = '')
{
	$vpb_Text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1:", $vpb_Text);
	$vpb_replacements = ' ' . $vpb_Text;
	$vpb_replacements = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<span class='ccc'><a href=\"\\2\" target=\"_blank\"><font style='font-family: Verdana, Geneva, sans-serif;color: blue;font-size:11px; line-height:20px;'>\\2</font></a></span>", $vpb_replacements);
	$vpb_replacements = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<span class='ccc'><a href=\"http://\\2\" target=\"_blank\"><font style='font-family: Verdana, Geneva, sans-serif;color: blue;font-size:11px; line-height:20px;'>\\2</font></a></span>", $vpb_replacements);
	$vpb_replacements = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<span class='ccc'><a href=\"mailto:\\2@\\3\"><font style='font-family: Verdana, Geneva, sans-serif;color: blue;font-size:11px; line-height:20px;'>\\2@\\3</font></a></span>", $vpb_replacements);
	$vpb_replacements = substr($vpb_replacements, 1);
	return $vpb_replacements;
}

//This function adds smileys to comments
function vpb_chat_smiley($vpb_post_text) 
{
	include "config.php";
	$vpb_codesToConvert = array(
		':)'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'smile.png" title="Smile" align="absmiddle">',
		':('    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'frown.png" title="Frown, Sad" align="absmiddle">',
		'O:)'   =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'angel.png" title="Blushing angel" align="absmiddle">',
		':cat-face:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'colonthree.png" title="Cat face" align="absmiddle">',
		'o.O'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'confused.png" title="Confused" align="absmiddle">',
		'O.o'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'confused.png" title="Confused" align="absmiddle">',
		':cry:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'cry.png" title="Cry" align="absmiddle">',
		':laughing-devil:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'devil.png" title="Laughing devil" align="absmiddle">',
		':O'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'gasp.png" title="Shocked and surprised" align="absmiddle">',
		'B)'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'glasses.png" title="Glasses" align="absmiddle">',
		':D'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'grin.png" title="Grin, Big Smile" align="absmiddle">',
		':grumpy:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'grumpy.png" title="Upset and angry" align="absmiddle">',
		':heart:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'heart.png" title="Heart" align="absmiddle">',
		'^_^'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'kiki.png" title="Kekeke happy" align="absmiddle">',
		':kiss:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'kiss.png" title="Kiss" align="absmiddle">',
		':v'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'pacman.png" title="Pacman" align="absmiddle">',
		':penguin:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'penguin.gif" title="Penguin" align="absmiddle">',
		':unsure:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'unsure.png" title="Unsure" align="absmiddle">',
		'B|'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'sunglasses.png" title="Cool" align="absmiddle">',
		'B-|' =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'sunglasses.png" title="Cool" align="absmiddle">',
		'8-|' =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'sunglasses.png" title="Cool" align="absmiddle">',
		'8|' =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'sunglasses.png" title="Cool" align="absmiddle">',
		'-_-'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'squint.png" title="Annoyed, sighing or bored" align="absmiddle">',
		':lve:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'red_heart_love.gif" title="Love" align="absmiddle">',
		':putnam:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'putnam.gif" title="Christopher Putnam" align="absmiddle">',
		';)'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'wink.png" title="Wink" align="absmiddle">',
		';-)'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'wink.png" title="Wink" align="absmiddle">',
		'(off)'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'no_idea.gif" title="No idea" align="absmiddle">',
		'(on)'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'got_idea.gif" title="Got an idea" align="absmiddle">',
		':tea-cup:'    =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'cup_of_tea.png" title="Cup of tea" align="absmiddle">',
		'(n)' =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'no_thumbs_down.gif" title="No, thumb down" align="absmiddle">',
		'(y)' =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'yes_thumbs_up.gif" title="Yes, thumb up" align="absmiddle">',
		'(^^^)' =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'shark.gif" title="Shark" align="absmiddle">'
	   );
	return (strtr($vpb_post_text, $vpb_codesToConvert));
}
if(isset($_GET["from_username"]) && isset($_GET["to_username"]) && !empty($_GET["from_username"]) && !empty($_GET["to_username"])) 
{
	$from_usernames = trim(strip_tags($_GET['from_username']));
	$to_usernames = trim(strip_tags($_GET['to_username']));
	
	$vpb_filename = 'Chat_history_between_'.$to_usernames.'_and_'.$from_usernames.'_dated_'.date("d-m-Y");
	$doc_heading = 'Chat History Between '.$to_usernames.' and '.$from_usernames.' dated '.date("d-m-Y");
	
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=".$vpb_filename.".doc");
	
	$vpb_blue_b = '#F0F8FF';
	$vpb_white_b = '#FFF';
	$vpb_background = $vpb_white_b;
	
	include "config.php";
	
	if($from_usernames == "" || $from_usernames == "")
	{
		$vpb_contents = 'Sorry, no proper data was passed. Please refresh this page and try again or contact this system developer to report the error should the problem persist (1).<br><br /> Thank You!';
	}
	else
	{
		$check_chats = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($from_usernames)."' and `to_username` = '".mysql_real_escape_string($to_usernames)."' and `from_del` = '".mysql_real_escape_string('0')."' || `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `to_del` = '".mysql_real_escape_string('0')."' order by `id` asc");
		
		
		if(mysql_num_rows($check_chats) < 1)
		{
			$vpb_contents = 'Sorry, it appears there is no recent '.$doc_heading.' in the system at the moment.<br /><br />Thank You!';
		}
		else {
			$vpb_contents .= '<center>';
			
			$vpb_contents .= '
			<center><table width="800" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:\'Times New Roman\', Times, serif; font-size:16px;word-wrap: break-word;max-width:800px;">
			<tr>
			<td colspan="4" style="padding-top:10px; padding-bottom:10px;" align="left">
			<h2 align="left">'.$doc_heading.'</h2>
			</td>
			</tr>
			</table></center>';
		  
		  $vpb_contents .= '
			<center><table width="800" border="1" cellspacing="0" cellpadding="0" align="center" style="break-word;max-width:800px;">';
			
			while($get_chats = mysql_fetch_array($check_chats))
			{
				$from_username = trim(strip_tags($get_chats["from_username"]));
				$chat_message = trim(strip_tags($get_chats["message"]));
				$date = strip_tags($get_chats["date_sent"]);
				$date_sent = date('g:ia m d',$date);
				
				$check_user_details = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
				$get_user_details = mysql_fetch_array($check_user_details);
				
				$fullname = trim(strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_FULLNAME]));
				
				
				if(!empty($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS])) { $photo = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS]); }
				else { $photo = 'avatar.png'; }
				
				if($chat_message == "")
				{
					$attachmentFile = strip_tags($get_chats["attachment"]);
				    $vpb_file_extensions = pathinfo(strtolower($attachmentFile), PATHINFO_EXTENSION);
				
					if($vpb_file_extensions == "txt")
					{
						$vpbChatFile = 'TXT File<br clear="all" />';
					}
					elseif($vpb_file_extensions == "zip")
					{
						$vpbChatFile = 'Zipped File<br clear="all" />';
					}
					elseif($vpb_file_extensions == "pdf")
					{
						$vpbChatFile = 'PDF Document<br clear="all" />';
					}
					elseif($vpb_file_extensions == "doc" || $vpb_file_extensions == "docx")
					{
						$vpbChatFile = 'Microsoft Word Document<br clear="all" />';
					}
					elseif($vpb_file_extensions == "jpg" || $vpb_file_extensions == "jpeg" || $vpb_file_extensions == "gif" || $vpb_file_extensions == "png")
					{
						$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DIRECTORY.$attachmentFile.'" width="150" height="150" border="0" /><br clear="all" />';
					}
					else
					{
						$vpbChatFile = strtoupper($vpb_file_extensions).' File<br clear="all" />';
					}
					
					$vpb_contents .= '<tr style="font-family: Verdana, Geneva, sans-serif;font-size:13px;font-weight:normal;background-color: '.$vpb_background.';box-shadow: 0 0 15px;#cbcbcb;-moz-box-shadow: 0 0 15px #cbcbcb;-webkit-box-shadow: 0 0 15px #cbcbcb;" align="left">
					<td style="width:50px; padding:5px;padding-top:10px; padding-bottom:10px;" align="center">
					<img title="'.$fullname.'" alt="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" width="50" height="50" border="0">
					</td>
					<td align="left" style="width:330px; padding:5px;padding-top:10px; padding-bottom:10px;word-wrap: break-word;">
					 '.vpb_time_sent($date).'<br clear="all" /><br clear="all" />
					 
					 '.$vpbChatFile.'
					 
					</td>
					</tr>';
					if($vpb_background == $vpb_white_b) { $vpb_background = $vpb_blue_b; }
					else { $vpb_background = $vpb_white_b; }
				} else {
					$fetched_url = strip_tags($get_chats["fetched_url"]);
					$fetched_title = trim(strip_tags($get_chats["fetched_title"]));
					$fetched_description = trim(strip_tags($get_chats["fetched_description"]));
					$fetched_image_urls = strip_tags($get_chats["fetched_image_urls"]);
					
					if($fetched_url == "" && $fetched_url == "")
					{
						$vpb_contents .= '<tr style="font-family: Verdana, Geneva, sans-serif;font-size:13px;font-weight:normal;background-color: '.$vpb_background.';box-shadow: 0 0 15px;#cbcbcb;-moz-box-shadow: 0 0 15px #cbcbcb;-webkit-box-shadow: 0 0 15px #cbcbcb;" align="left">
						<td style="width:50px; padding:5px;padding-top:10px; padding-bottom:10px;" align="center">
						<img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" width="50" height="50" border="0">
						</td>
						<td align="left" style="width:330px; padding:5px;padding-top:10px; padding-bottom:10px;">
						 '.vpb_time_sent($date).'<br clear="all" /><br clear="all" />
						 
						 '.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'
						 
						</td>
						</tr>';
					} else {
						if ($fetched_title == "" && preg_match('![?&]{1}v=([^&]+)!', $fetched_url . '&', $display_this_video_now))
						{
							$vpb_contents .= '<tr style="font-family: Verdana, Geneva, sans-serif;font-size:13px;font-weight:normal;background-color: '.$vpb_background.';box-shadow: 0 0 15px;#cbcbcb;-moz-box-shadow: 0 0 15px #cbcbcb;-webkit-box-shadow: 0 0 15px #cbcbcb;" align="left">
							<td style="width:50px; padding:5px;padding-top:10px; padding-bottom:10px;" align="center">
							<img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" width="50" height="50" border="0">
							</td>
							<td align="left" style="width:330px; padding:5px;padding-top:10px; padding-bottom:10px;">
							 '.vpb_time_sent($date).'<br clear="all" /><br clear="all" />
							 
							 '.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'<br clear="all" /><br clear="all" />
							 
							 Video Link: <iframe width="180" height="180" align="left" src="//www.youtube.com/embed/'.$display_this_video_now[1].'?wmode=transparent&theme=light&modestbranding=1&controls=1&showinfo=0" frameborder="0" allowfullscreen></iframe>
							 
							</td>
							</tr>';
						}
						else
						{
							$vpb_contents .= '<tr style="font-family: Verdana, Geneva, sans-serif;font-size:13px;font-weight:normal;background-color: '.$vpb_background.';box-shadow: 0 0 15px;#cbcbcb;-moz-box-shadow: 0 0 15px #cbcbcb;-webkit-box-shadow: 0 0 15px #cbcbcb;" align="left">
							<td style="width:50px; padding:5px;padding-top:10px; padding-bottom:10px;" align="center">
							<img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" width="50" height="50" border="0">
							</td>
							<td align="left" style="width:330px; padding:5px;padding-top:10px; padding-bottom:10px;">
							 '.vpb_time_sent($date).'<br clear="all" /><br clear="all" />
							 
							 '.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'<br clear="all" /><br clear="all" />
							 
							 <a href="'.$fetched_url.'" target="_blank">
								<img src="'.$fetched_image_urls.'" border="0" width="180" height="140">
							  </a><br clear="all" /><br clear="all" />
							  
							  <b>'.$fetched_title.'</b><br clear="all" /><br clear="all" />
							  
							  '.nl2br(vpb_create_links($fetched_description)).'
							 
							</td>
							</tr>';
						}
					}
					
					
					if($vpb_background == $vpb_white_b) { $vpb_background = $vpb_blue_b; }
					else { $vpb_background = $vpb_white_b; }
				}
			}
			$vpb_contents .= '</table></center>';
			$vpb_contents .= '</center>';
		}
	}
			
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	
	echo $vpb_contents;
	
	echo "</body>";
	echo "</html>";
}
else
{
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=vpb_no_data.doc");
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	
	echo '<div style="width:600px; padding:10px; font-family:Verdana, Geneva, sans-serif; font-size:13px; background:#FFFFF9;" align="left">Sorry, no proper data was passed. <br>Please refresh this page and try again or contact this system developer to report the error should the problem persist.<br> Thank You!</div>';
	
	echo "</body>";
	echo "</html>";
}
?>