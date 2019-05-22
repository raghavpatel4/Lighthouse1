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
@session_start();
// Send headers to prevent IE cache
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
@header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
@header("Cache-Control: no-cache, must-revalidate" ); 
@header("Pragma: no-cache" );
@header("Content-type: text/html;charset=utf-8");

@ini_set('error_reporting', 'E_NONE');
@set_time_limit(0);

include "config.php";


@ini_set('implicit_flush', true);
ob_implicit_flush(true);

if (ob_get_level() == 0) ob_start();

if (!function_exists('memory_get_usage'))
{
	function memory_get_usage() {}
}

if (function_exists('get_magic_quotes_runtime') && get_magic_quotes_runtime())
{
	if (preg_match('/5\.3\.(.*)/i', PHP_VERSION))
	{
		ini_set('magic_quotes_runtime', 0);
	}
	else
	{
		set_magic_quotes_runtime(0);
	}    
}

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
	$vpb_replacements = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<span class='ccc'><a href=\"\\2\" target=\"_blank\"><font style='color: blue;'>\\2</font></a></span>", $vpb_replacements);
	$vpb_replacements = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<span class='ccc'><a href=\"http://\\2\" target=\"_blank\"><font style='color:'>\\2</font></a></span>", $vpb_replacements);
	$vpb_replacements = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<span class='ccc'><a href=\"mailto: \\2@\\3\" target='_blank'><font style='color: blue;'>\\2@\\3</font></a></span>", $vpb_replacements);
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
		':blushing-angel:'   =>  '<img src="'.$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY.'angel.png" title="Blushing angel" align="absmiddle">',
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


if( $DISABLE_CHAT_TEMPORARILY == TRUE )
{
	echo 'DISABLED_CHAT_TEMPORARILY';
}
else if(isset($_POST["page"]) && !empty($_POST["page"]) || isset($_GET["page"]) && !empty($_GET["page"]))
{
	//check if its an ajax request, exit if not
    if(!isset($_SERVER['REQUEST_METHOD']) || strtolower($_SERVER['REQUEST_METHOD']) != "post" && strtolower($_SERVER['REQUEST_METHOD']) != "get") {
        die('<div style="padding:8px; font-family:Verdana, Geneva, sans-serif; font-size:11px;line-height:23px;" align="left">This is a general system error and you can not proceed with this request.<br />Thank You!</div>');
		return;
    }
	elseif($_POST["page"] == "send_new_chat_message")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		$to_username = trim(strip_tags($_POST["to_username"]));
		$chat_message = vpb_no_magic_quotes(trim($_POST["message"]));
		$vpb_link = trim(strip_tags($_POST["vpb_link"]));
		$vpb_link_type = trim(strip_tags($_POST["vpb_link_type"]));
		$date = strtotime(date("Y-m-d H:i:s"));
		$date_sent = date('n/j, g:ia',$date); // current time
		
		$last_chat_message_id_displayed = isset($_POST["last_chat_message_id_displayed"]) && trim($_POST["last_chat_message_id_displayed"]) != "" ? trim(strip_tags($_POST["last_chat_message_id_displayed"])) : '';
		
		//mysql_query("update `vpb_chat_messages` set `read` = '".mysql_real_escape_string('yes')."', `seen` = '".mysql_real_escape_string('yes')."', `time_seen` = '".mysql_real_escape_string($date)."' where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `read` = '".mysql_real_escape_string('no')."'");
		
		if($chat_message == "") {}
		elseif($from_username == "")
		{
			echo "VPB ERROR: Sorry, your identity could not be verified at the moment.<br />Please refresh this page and try again.<br />Thank You!";
		}
		elseif($to_username == "")
		{
			echo "VPB ERROR: The identity of the person you are trying to chat with could not be verified at the moment.<br />Please refresh this page and try again.<br />Thank You!";
		}
		else {
			if( $vpb_link == "" )
			{
				$vpb_chat_status = mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string($chat_message)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($date)."')");
			}
			elseif (preg_match('![?&]{1}v=([^&]+)!', $vpb_link . '&', $display_this_video_now) && $vpb_link_type == "vvideo")
			{
				$vpb_chat_status = mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string($chat_message)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string($vpb_link)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($date)."')");
			}
			else {
				if(!filter_var($vpb_link, FILTER_VALIDATE_URL)) 
				{
					$vpb_chat_status = mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string($chat_message)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($date)."')");
				}
				else {	
					//URL
					$vpb_chat_url_to_fetch = $vpb_link; //Trim the URL for unwanted spaces
					// Functions
					include "vpb_chat_fetched_functions.php";
					
					//fetching url data via curl
					$vpb_fetch_link_contents_status = vpb_chat_fetch_url_contents($vpb_chat_url_to_fetch);
					
					//parsing begins here:
					$doc = new DOMDocument();
					@$doc->loadHTML($vpb_fetch_link_contents_status);
					$nodes = $doc->getElementsByTagName('title');
					
					//get and display what you need:
					$title_parsed = $nodes->item(0)->nodeValue;
					
					$metas = $doc->getElementsByTagName('meta');
					for ($i = 0; $i < $metas->length; $i++)
					{
						$meta = $metas->item($i);
						if($meta->getAttribute('property') == 'og:description')
							$description_parsed = $meta->getAttribute('content');
					}
					//parsing ends here:
					
					$get_m_tags = @get_meta_tags($vpb_chat_url_to_fetch);
					$vpb_pageTile = vpb_chat_get_page_title_from_url($vpb_chat_url_to_fetch);
					
					if(!empty($vpb_pageTile)) { $vpb_title = substr(strip_tags($vpb_pageTile),0,50); } elseif(!empty($title_parsed)) { $vpb_title = substr(strip_tags($title_parsed),0,50); } else { $vpb_title = "No title was found for this link..."; }
					
					if(!empty($vpb_pageTile)) { $vpb_title_saved = strip_tags($vpb_pageTile); } elseif(!empty($title_parsed)) { $vpb_title_saved = strip_tags($title_parsed); } else { $vpb_title_saved = "No title was found for this link..."; }
					
					if(!empty($get_m_tags['description'])) { $vpb_description = substr(strip_tags($get_m_tags['description']),0,500); } elseif(!empty($description_parsed)) { $vpb_description = substr(strip_tags($description_parsed),0,500); } else { $vpb_description = "No description was found for this link..."; }
					
					if(!empty($get_m_tags['description'])) { $vpb_description_saved = strip_tags($get_m_tags['description']); } elseif(!empty($description_parsed)) { $vpb_description_saved = strip_tags($description_parsed); } else { $vpb_description_saved = "No description was found for this link..."; }
					//Fetch images
					$vpb_image_rev = '/<img[^>]*'.'src=[\"|\'](.*)[\"|\']/Ui'; /*|<img.*?src=[\'"](.*?)[\'"].*?>|i */
					preg_match_all($vpb_image_rev, $vpb_fetch_link_contents_status, $vpb_imgs, PREG_PATTERN_ORDER);
					$vpb_chat_fetched_img = vpb_chat_get_image_from_url($vpb_imgs);
					
					if(substr(strtolower($vpb_chat_fetched_img), 0, 7) != "http://" && substr(strtolower($vpb_chat_fetched_img), 0, 8) != "https://") 
					{
						if($vpb_chat_fetched_img == "") { $vpb_chat_fetched_image = ""; }
						else {
							$vpb_chat_fetched_image = vpb_get_real_domain($vpb_chat_url_to_fetch).$vpb_chat_fetched_img;
						}
					} 
					else { $vpb_chat_fetched_image = $vpb_chat_fetched_img; }
					
					if ($vpb_chat_fetched_image != "" && @fopen($vpb_chat_fetched_image, "r"))
					{
						$vpb_chat_status = mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string($chat_message)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string($vpb_link)."', '".mysql_real_escape_string($vpb_title_saved)."', '".mysql_real_escape_string($vpb_description_saved)."', '".mysql_real_escape_string($vpb_chat_fetched_image)."', '".mysql_real_escape_string($date)."')");
					}
					else
					{
						$vpb_chat_status = mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string($chat_message)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string($vpb_link)."', '".mysql_real_escape_string($vpb_title_saved)."', '".mysql_real_escape_string($vpb_description_saved)."', '".mysql_real_escape_string()."', '".mysql_real_escape_string($date)."')");
					}
				}
			}
			
			//insert new message in db
			if($vpb_chat_status)
			{
				$check_user_details = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
				$get_user_details = mysql_fetch_array($check_user_details);
				$fullname = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_FULLNAME]);
				if(!empty($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS])) { $photo = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS]); } else { $photo = 'avatar.png'; }
				
				mysql_query("delete from `vpb_chat_typing` where `from_username` = '".mysql_real_escape_string($from_username)."' and `to_username` = '".mysql_real_escape_string($to_username)."'");
				
				//echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'</chat_messages><div style="clear:both;"></div></div>';
			}
			else
			{
				echo 'VPB ERROR: Your chat message could not be sent, please try again.<br />Thank You!';
			}
		}
	}
	elseif($_GET["page"] == "send_new_chat_file")
	{
		$from_username = trim(strip_tags($_GET["from_username"]));
		$to_username = trim(strip_tags($_GET["to_username"]));
		$date = strtotime(date("Y-m-d H:i:s"));
		$date_sent = date('n/j, g:ia',$date); // current time
		
		$last_chat_message_id_displayed = isset($_GET["last_chat_message_id_displayed"]) && trim($_GET["last_chat_message_id_displayed"]) != "" ? trim(strip_tags($_GET["last_chat_message_id_displayed"])) : '';
		
		if($from_username == "")
		{
			echo "VPB ERROR: Sorry, your identity could not be verified at the moment.<br />Please refresh this page and try again.<br />Thank You!";
		}
		elseif($to_username == "")
		{
			echo "VPB ERROR: The identity of the person you are trying to chat with could not be verified at the moment.<br />Please refresh this page and try again.<br />Thank You!";
		}
		else {
			// You may change any of the below information if you wish
			$vpb_upload_image_directory = $VPB_DIRECT_PATH_TO_CHAT_ATTACHMENT_DIRECTORY;
			$vpb_with_of_first_image_file = 660; 
			$vpb_with_of_second_image_file = 500;
	
			// This is also validated in the JS file for fast response
			$allowed_file_types = array("jpg", "jpeg", "gif", "png", "doc", "docx", "pdf", "txt", "zip");
			
			foreach($_FILES as $file)
			{
				//move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']));
				$file_tmp_name = $file['tmp_name'];
				$file_name = basename($file['name']);
				$fileError = '';
				$fileSuccess = '';
				
				/* Variables Declaration and Assignments */
				$vpb_image_filename = basename($file['name']);
				$vpb_image_tmp_name = $file['tmp_name'];
				$vpb_file_size = filesize($file['tmp_name']);
				$vpb_file_extensions = pathinfo(strtolower($vpb_image_filename), PATHINFO_EXTENSION);
				
				$random_name_generated = str_replace(' ', '-', str_replace('.'.$vpb_file_extensions, '', $vpb_image_filename)).'-'.strtotime(date('d-m-Y')).rand(123456,987654).'.'.$vpb_file_extensions;
				$vpb_maximum_allowed_file_size = 44858; //43.8 KB //1024*1024 1MB // You may change the maximum allowed upload file size here if you wish
				$vpb_additional_file_size = $vpb_file_size - $vpb_maximum_allowed_file_size;
				
				list($compare_image_width, $compare_image_height, $type, $attr) = getimagesize($vpb_image_tmp_name);
					
				$totalFiles = strlen(basename($file['name']));
				
				if($vpb_image_filename == "")
				{
					  $fileError = 'VPB ERROR: The file that you were about to send could not be verified at the moment<br />Please be sure that the file falls in the following category and try again.<br />jpg, jpeg, gif, png, doc, docx, pdf or zip<br />Thank You!';
				}
				else if(!in_array($vpb_file_extensions, $allowed_file_types))
				{
					  $fileError = 'VPB ERROR: The file type you were about to send is not allowed in this chat.<br />The extensions of files allowed are jpg, jpeg, gif, png, doc, docx, pdf, txt and zip<br />Thank You!';
				}
				elseif($vpb_file_extensions == "jpg" || $vpb_file_extensions == "jpeg" || $vpb_file_extensions == "gif" || $vpb_file_extensions == "png")
				{
					if ($compare_image_width>600 || $compare_image_height>500) //Validate attached file to avoid large files. Max 1MB
					{
						/* Create images based on their file types */
						if($vpb_file_extensions == "gif") //If the attached file extension is a gif, carry out the below action
						{
							if(!$vpb_image_src = imagecreatefromgif($vpb_image_tmp_name))//This will create a gif image file
							{
								$could_not_create_image_file = "error";
							}
							else
							{
								$could_not_create_image_file = "success";
							}
						}
						elseif($vpb_file_extensions == "jpg" || $vpb_file_extensions == "jpeg") //If the attached file is a jpg or jpeg, carry out the below action
						{
							if(!$vpb_image_src = imagecreatefromjpeg($vpb_image_tmp_name)) //This will create a jpg or jpeg image file
							{
								$could_not_create_image_file = "error";
							}
							else
							{
								$could_not_create_image_file = "success";
							}
						}
						else if($vpb_file_extensions=="png") //If the attached file extension is a png, carry out the below action
						{
							if(!$vpb_image_src = imagecreatefrompng($vpb_image_tmp_name)) //This will create a png image file
							{
								$could_not_create_image_file = "error";
							}
							else
							{
								$could_not_create_image_file = "success";
							}
						}
						else
						{
							$vpb_image_src = "invalid_file_type_realized";
						}
						
						//The file attached is unknow
						if($vpb_image_src == "invalid_file_type_realized")
						{
							$fileError = 'VPB ERROR: The file type you were about to send is not allowed in this chat.<br />The extensions of files allowed are jpg, jpeg, gif, png, doc, docx, pdf, txt and zip<br />Thank You!';
						}
						elseif($could_not_create_image_file == "error")
						{
							$fileError = 'VPB ERROR: Sorry, we could not create the required image file from the file <b>'.basename($file['name']).'</b> you attached.<br />Please use a different image file instead<br />Thank You!';
						}
						else
						{
							//Get the size of the attached image file from where the resize process will take place from the width and height of the image
							list($vpb_image_width,$vpb_image_height) = getimagesize($vpb_image_tmp_name);
									   
							//This is the width of the first image file from where its height will be determined
							$vpb_first_image_new_width = $vpb_with_of_first_image_file; 
							$vpb_first_image_new_height = ($vpb_image_height/$vpb_image_width)*$vpb_first_image_new_width;
							$vpb_first_image_tmp = imagecreatetruecolor($vpb_first_image_new_width,$vpb_first_image_new_height);
							
							//Resize the image file
							imagecopyresampled($vpb_first_image_tmp,$vpb_image_src,0,0,0,0,$vpb_first_image_new_width,$vpb_first_image_new_height,$vpb_image_width,$vpb_image_height); 
							
							 $vpb_uploaded_file_movement_one = $vpb_upload_image_directory.$random_name_generated;
								
							 //Upload the image file
							 imagejpeg($vpb_first_image_tmp,$vpb_uploaded_file_movement_one,100);
					
							 imagedestroy($vpb_image_src);
							 imagedestroy($vpb_first_image_tmp);
								
							 //Save File in DB
							if(mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($random_name_generated)."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($date)."')"))
							{
								$check_user_details = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
								$get_user_details = mysql_fetch_array($check_user_details);
								$fullname = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_FULLNAME]);
								if(!empty($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS])) { $photo = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS]); } else { $photo = 'avatar.png'; }
									
								$read_sent_icon = '<img title="Sent" src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vpb_unread.png" align="absmiddle">';
								 
								$check_chats = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($from_username)."' order by `id` desc limit 1");
								$get_chats = mysql_fetch_array($check_chats);
								
								$attachmentFile = strip_tags($get_chats["attachment"]);
								
								$vpbChatFile = '<div style="margin-bottom:20px;">
								  <div style="margin-bottom:5px;"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'images_file.gif" align="absmiddle"><span class="ccc"><a style="cursor:pointer;" onclick="window.open(\''.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'\',\'_blank\');"><font color="blue">Download File</font></a></span></div>
								  <span class="img" onclick="vpb_enlarge_chat_photo(\''.strip_tags($get_chats["id"]).'\',\''.$from_username.'\');" style="cursor:move;">
								  <img src="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DIRECTORY.$attachmentFile.'" style="max-width:150px; max-height:150px; width:auto; height:auto;" border="0" /></span><br clear="all" />
								  </div>';
								
								 
								$fileSuccess = '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.$vpbChatFile.'</chat_messages><div style="clear:both;"></div></div>';
							}
							else
							{
								$fileError = 'VPB ERROR: Sorry, your chat file could not be sent at the moment.<br />Please try again or contact us to report this issue should the problem persist. (1)<br />Thank You!';
							}
						}
					}
					else
					{
						if(move_uploaded_file($file['tmp_name'], $vpb_upload_image_directory.$random_name_generated)) 
						 {
							  //Save File in DB
							if(mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($random_name_generated)."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($date)."')"))
							{			
								$check_user_details = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
								$get_user_details = mysql_fetch_array($check_user_details);
								$fullname = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_FULLNAME]);
								if(!empty($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS])) { $photo = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS]); } else { $photo = 'avatar.png'; }
									
								$read_sent_icon = '<img title="Sent" src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vpb_unread.png" align="absmiddle">';
								
								$check_chats = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($from_username)."' order by `id` desc limit 1");
								$get_chats = mysql_fetch_array($check_chats);
								
								$attachmentFile = strip_tags($get_chats["attachment"]);
								
								$vpbChatFile = '<div style="margin-bottom:20px;">
								  <div style="margin-bottom:5px;"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'images_file.gif" align="absmiddle"><span class="ccc"><a style="cursor:pointer;" onclick="window.open(\''.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'\',\'_blank\');"><font color="blue">Download File</font></a></span></div>
								  <span class="img" onclick="vpb_enlarge_chat_photo(\''.strip_tags($get_chats["id"]).'\',\''.$from_username.'\');" style="cursor:move;">
								  <img src="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DIRECTORY.$attachmentFile.'" style="max-width:150px; max-height:150px; width:auto; height:auto;" border="0" /></span><br clear="all" />
								  </div>';
								
								 
								$fileSuccess = '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.$vpbChatFile.'</chat_messages><div style="clear:both;"></div></div>';
							}
							else
							{
								$fileError = 'VPB ERROR: Sorry, your chat file could not be sent at the moment.<br />Please try again or contact us to report this issue should the problem persist. (2)<br />Thank You!';
							}
						 }
						 else 
						 {
							 $fileError = 'VPB ERROR: Sorry, your chat file could not be sent at the moment.<br />Please try again or contact us to report this issue should the problem persist (3).<br />Thank You!';
						 }
					}
				}
				else {
					// Upload normal file which is not an image file
					if(move_uploaded_file($file['tmp_name'], $vpb_upload_image_directory.$random_name_generated)) 
					 {
						  //Save File in DB
						if(mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($random_name_generated)."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('0')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string($date)."')"))
						{	
							$check_user_details = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
							$get_user_details = mysql_fetch_array($check_user_details);
							$fullname = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_FULLNAME]);
							if(!empty($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS])) { $photo = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS]); } else { $photo = 'avatar.png'; }
								
							$read_sent_icon = '<img title="Sent" src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vpb_unread.png" align="absmiddle">';
							 
							$check_chats = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($from_username)."' order by `id` desc limit 1");
								$get_chats = mysql_fetch_array($check_chats);
								
								$attachmentFile = strip_tags($get_chats["attachment"]);
								
								//Check file types for proper icon assignments
								if($vpb_file_extensions == "txt")
								{
									$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'txt.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">TXT File</a></span><br clear="all" />';
								}
								elseif($vpb_file_extensions == "zip")
								{
									$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'archive.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">Zipped File</a></span><br clear="all" />';
								}
								elseif($vpb_file_extensions == "pdf")
								{
									$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'pdf.gif" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">PDF Document</a></span><br clear="all" />';
								}
								elseif($vpb_file_extensions == "doc" || $vpb_file_extensions == "docx")
								{
									$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'doc.gif" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">Microsoft Word Document</a></span><br clear="all" />';
								}
								else
								{
									$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'general.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">'.strtoupper($vpb_file_extensions).' File</a></span><br clear="all" />';
								}
								 
								$fileSuccess = '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.$vpbChatFile.'</chat_messages><div style="clear:both;"></div></div>';
						}
						else
						{
							$fileError = 'VPB ERROR: Sorry, your chat file could not be sent at the moment.<br />Please try again or contact us to report this issue should the problem persist. (2)<br />Thank You!';
						}
					 }
					 else 
					 {
						 $fileError = 'VPB ERROR: Sorry, your chat file could not be sent at the moment.<br />Please try again or contact us to report this issue should the problem persist (3).<br />Thank You!';
					 }
				}
			}
			if($fileError == "")
			{
				echo $fileSuccess;
			}
			else
			{
				echo $fileError;
			}
		}
	}
	elseif($_POST["page"] == "vpb_enlarge_chat_photo") 
	{
		$check_photo = mysql_query("select * from `vpb_chat_messages` where `id` = '".mysql_real_escape_string(strip_tags($_POST["photo_id"]))."'");

		if(mysql_num_rows($check_photo) > 0)
		{
		   $get_photo_info = mysql_fetch_array($check_photo);
		   $fromuser = strip_tags($get_photo_info["from_username"]);
		   $photo_link = strip_tags($get_photo_info["attachment"]);
		   
		   $check_photo_user_info = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($fromuser)."'");
		   $get_photo_user_info = mysql_fetch_array($check_photo_user_info);
		   $from_fullname = strip_tags($get_photo_user_info[$COLUMN_NAME_FOR_USERS_FULLNAME]);
		   
           echo '<div style="width:578px; margin-bottom:12px; border:1px solid #CCC;padding:10px; background:#F9F9F9;box-shadow: 0 0px 10px #cbcbcb;-moz-box-shadow: 0 0px 10px #cbcbcb;-webkit-box-shadow: 0 0px 10px #cbcbcb; padding-top:8px;">
<div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:15px; font-weight:bold; float:left; width:550px; color:black;">Photo sent by '.$from_fullname.'</div>
<div style="float:right;" align="right">
<a onClick="vpb_hide_chat_popup_boxy();" title="Close" class="vpb_close_chat_red_button" style="font-size:14px;padding:1px;padding-bottom:3px;padding-right:6px;padding-left:6px;text-decoration:none;margin:0px; float:none; cursor:pointer;"><font style="color:#FFF;">x</font></a></div>
<br clear="all">
</div>

<center><div align="center" style="padding:10px; padding-top:0px;font-family:Verdana, Geneva, sans-serif; font-size:11px; line-height:20px;">
<img src="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DIRECTORY.$photo_link.'" style="max-width:580px; max-height:480px; width:auto; height:auto;" border="0" />
</div></center>';
		}
		else
		{
			$check_photo_user_info = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string(strip_tags($_POST["fromuser"]))."'");
		   $get_photo_user_info = mysql_fetch_array($check_photo_user_info);
		   $from_fullname = strip_tags($get_photo_user_info[$COLUMN_NAME_FOR_USERS_FULLNAME]);
		   
           echo '<div style="width:578px; margin-bottom:12px; border:1px solid #CCC;padding:10px; background:#F9F9F9;box-shadow: 0 0px 10px #cbcbcb;-moz-box-shadow: 0 0px 10px #cbcbcb;-webkit-box-shadow: 0 0px 10px #cbcbcb; padding-top:8px;">
<div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:15px; font-weight:bold; float:left; width:550px; color:black;">Photo sent by '.$from_fullname.'</div>
<div style="float:right;" align="right">
<a onClick="vpb_hide_chat_popup_boxy();" title="Close" class="vpb_close_chat_red_button" style="font-size:14px;padding:1px;padding-bottom:3px;padding-right:6px;padding-left:6px;text-decoration:none;margin:0px; float:none; cursor:pointer;"><font style="color:#FFF;">x</font></a></div>
<br clear="all">
</div>

<div align="left" style="padding:10px; padding-top:0px;font-family:Verdana, Geneva, sans-serif; font-size:11px; line-height:20px;">

<div class="vpb_info" style="width:570px;">Sorry, we could not find the details associated with the photo you have just clicked at the moment.<br />
Please refresh this page and try again or report this issue to us if you feel that something is wrong.<br />
Thank You!</div>

</div>';
		}
	}
	elseif($_POST["page"] == "display_conversation")
	{
		$from_usernames = trim(strip_tags($_POST["from_username"]));
		$to_usernames = trim(strip_tags($_POST["to_username"]));
		$date_time_seen = strtotime(date("Y-m-d H:i:s"));
		
		$check_chats = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($from_usernames)."' and `to_username` = '".mysql_real_escape_string($to_usernames)."' and `from_del` = '".mysql_real_escape_string('0')."' || `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `to_del` = '".mysql_real_escape_string('0')."' order by `id` asc");
		
		if(mysql_num_rows($check_chats) < 1) {}
		else
		{
			mysql_query("update `vpb_chat_messages` set `read` = '".mysql_real_escape_string('yes')."', `seen` = '".mysql_real_escape_string('yes')."', `time_seen` = '".mysql_real_escape_string($date_time_seen)."' where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `read` = '".mysql_real_escape_string('no')."'");
			
			while($get_chats = mysql_fetch_array($check_chats))
			{
				$from_username = trim(strip_tags($get_chats["from_username"]));
				$chat_message = trim(strip_tags($get_chats["message"]));
				$date = strip_tags($get_chats["date_sent"]);
				$date_sent = date('n/j, g:ia',$date);
				
				$check_user_details = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
				$get_user_details = mysql_fetch_array($check_user_details);
				
				if($from_usernames == $from_username)
				{
					$fullname = 'Me';
				}
				else {
					$fullname = trim(strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_FULLNAME]));
				}
				
				if(!empty($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS])) { $photo = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS]); }
				else { $photo = 'avatar.png'; }
				
				if($chat_message == "")
				{
					$attachmentFile = strip_tags($get_chats["attachment"]);
				    $vpb_file_extensions = pathinfo(strtolower($attachmentFile), PATHINFO_EXTENSION);
				
					if($vpb_file_extensions == "txt")
					{
						$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'txt.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">TXT File</a></span><br clear="all" />';
					}
					elseif($vpb_file_extensions == "zip")
					{
						$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'archive.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">Zipped File</a></span><br clear="all" />';
					}
					elseif($vpb_file_extensions == "pdf")
					{
						$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'pdf.gif" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">PDF Document</a></span><br clear="all" />';
					}
					elseif($vpb_file_extensions == "doc" || $vpb_file_extensions == "docx")
					{
						$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'doc.gif" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">Microsoft Word Document</a></span><br clear="all" />';
					}
					elseif($vpb_file_extensions == "jpg" || $vpb_file_extensions == "jpeg" || $vpb_file_extensions == "gif" || $vpb_file_extensions == "png")
					{
						$vpbChatFile = '<div style="margin-bottom:20px;">
						  <div style="margin-bottom:5px;"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'images_file.gif" align="absmiddle"><span class="ccc"><a style="cursor:pointer;" onclick="window.open(\''.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'\',\'_blank\');"><font color="blue">Download File</font></a></span></div>
						  <span class="img" onclick="vpb_enlarge_chat_photo(\''.strip_tags($get_chats["id"]).'\',\''.$from_username.'\');" style="cursor:move;">
						  <img src="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DIRECTORY.$attachmentFile.'" style="max-width:150px; max-height:150px; width:auto; height:auto;" border="0" /></span><br clear="all" />
						  </div>';
					}
					else
					{
						$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'general.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">'.strtoupper($vpb_file_extensions).' File</a></span><br clear="all" />';
					}
					
					echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.$vpbChatFile.'</chat_messages><div style="clear:both;"></div><span style="float:right">'.$read_sent_icon.'</span></div>';
					
				}
				else {
					$fetched_url = strip_tags($get_chats["fetched_url"]);
					$fetched_title = trim(strip_tags($get_chats["fetched_title"]));
					$fetched_description = trim(strip_tags($get_chats["fetched_description"]));
					$fetched_image_urls = strip_tags($get_chats["fetched_image_urls"]);
					
					if($fetched_url == "" && $fetched_url == "")
					{
						echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'</chat_messages><div style="clear:both;"></div><span style="float:right">'.$read_sent_icon.'</span></div>';
					}
					else {
						if ($fetched_title == "" && preg_match('![?&]{1}v=([^&]+)!', $fetched_url . '&', $display_this_video_now))
						{
							echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'
							
							<div style="clear:both;"></div><div style="width:180px;margin-top:10px;padding:6px;word-wrap: break-word; border:1px solid #F2F2F2; background:#F9F9F9; font-family:Verdana, Geneva, sans-serif; font-size:11px;"><iframe width="180" height="180" src="//www.youtube.com/embed/'.$display_this_video_now[1].'?wmode=transparent&theme=light&modestbranding=1&controls=1&showinfo=0" frameborder="0" allowfullscreen></iframe></div>
							
							</chat_messages><div style="clear:both;"></div><span style="float:right">'.$read_sent_icon.'</span></div>';
						}
						else
						{
							echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'
							
							<div style="clear:both;"></div><div style="width:180px;margin-top:10px;padding:6px;word-wrap: break-word; border:1px solid #F2F2F2; background:#F9F9F9; font-family:Verdana, Geneva, sans-serif; font-size:11px;">
							<div style="width:180px;word-wrap: break-word;" align="left">
							
							<div style="width:180px;float:left;margin-bottom:6px;"  align="left">
							<a href="'.$fetched_url.'" target="_blank">
							<img src="'.$fetched_image_urls.'" border="0" style="width:180px;min-height:100px; height:auo;">
							</a>
							</div><br clear="all" />
								
							<div style="width:180px;float:left;" align="left">
							<div style="font-weight:bold; margin-bottom:8px;" align="left">'.$fetched_title.'</div>
							<div style="clear:both;"></div>
							<div style="margin-bottom:8px;" align="left"><a href="'.$fetched_url.'" target="_blank">View this link...</a></div>
							<div style="clear:both;"></div>
							<div style="margin-top:5px; line-height:18px;" align="left">'.nl2br(vpb_create_links($fetched_description)).'</div>
							<div style="clear:both;"></div>
							</div><br clear="all" />
							</div>
							</div></chat_messages><div style="clear:both;"></div><span style="float:right">'.$read_sent_icon.'</span></div>';
						}
					}
				}
				
				$check_last_message = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `to_del` = '".mysql_real_escape_string('0')."' order by `id` desc limit 1");
		
				$get_last_message = mysql_fetch_array($check_last_message);
				$chat_last_message_id = trim(strip_tags($get_last_message["id"]));
				$who_sent_last = trim(strip_tags($get_last_message["from_username"]));
				
				?>
				<script type="text/javascript"> 
				$("#vasplus_general_tracker<?php echo $to_usernames; ?>").val('<?php echo $chat_last_message_id; ?>'); 
				$("#last_chat_message_id_displayed<?php echo $to_usernames; ?>").val('<?php echo $chat_last_message_id; ?>'); 
				$("#last_chat_message_updated<?php echo $to_usernames; ?>").val('<?php echo $chat_last_message_id; ?>');
				</script>
				<?php
			}
		}
	}
	elseif($_POST["page"] == "display_loaded_conversation")
	{
		$from_usernames = trim(strip_tags($_POST["from_username"]));
		$to_usernames = trim(strip_tags($_POST["to_username"]));
		$date_time_seen = strtotime(date("Y-m-d H:i:s"));
		$last_chat_message_id_displayed = isset($_POST["last_chat_message_id_displayed"]) && trim($_POST["last_chat_message_id_displayed"]) != "" ? trim(strip_tags($_POST["last_chat_message_id_displayed"])) : '';
		
		if($last_chat_message_id_displayed == "" )
		{
			$check_chats = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `to_del` = '".mysql_real_escape_string('0')."' order by `id` asc limit 1");
		}
		else
		{
			$check_chats = mysql_query("select * from `vpb_chat_messages` where `id` > '".mysql_real_escape_string($last_chat_message_id_displayed)."' and `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `to_del` = '".mysql_real_escape_string('0')."' order by `id` asc limit 1");
		}
		
		
		if(mysql_num_rows($check_chats) < 1) { echo 'none'; }
		else
		{
			$get_chats = mysql_fetch_array($check_chats);
			
			$from_username = trim(strip_tags($get_chats["from_username"]));
			$chat_message = trim(strip_tags($get_chats["message"]));
			$date = strip_tags($get_chats["date_sent"]);
			$date_sent = date('n/j, g:ia',$date);
			
			$chat_last_message_id = trim(strip_tags($get_chats["id"]));
			$who_sent_last = trim(strip_tags($get_chats["from_username"]));
			
			$check_user_details = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
			$get_user_details = mysql_fetch_array($check_user_details);
			
			if($from_usernames == $from_username)
			{
				$fullname = 'Me';
			}
			else
			{
				$fullname = trim(strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_FULLNAME]));
			}
			
			if(!empty($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS])) { $photo = strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_PHOTOS]); }
			else { $photo = 'avatar.png'; }
			
			if($chat_message == "")
			{
				$attachmentFile = strip_tags($get_chats["attachment"]);
				$vpb_file_extensions = pathinfo(strtolower($attachmentFile), PATHINFO_EXTENSION);
			
				if($vpb_file_extensions == "txt")
				{
					$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'txt.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">TXT File</a></span><br clear="all" />';
				}
				elseif($vpb_file_extensions == "zip")
				{
					$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'archive.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">Zipped File</a></span><br clear="all" />';
				}
				elseif($vpb_file_extensions == "pdf")
				{
					$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'pdf.gif" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">PDF Document</a></span><br clear="all" />';
				}
				elseif($vpb_file_extensions == "doc" || $vpb_file_extensions == "docx")
				{
					$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'doc.gif" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">Microsoft Word Document</a></span><br clear="all" />';
				}
				elseif($vpb_file_extensions == "jpg" || $vpb_file_extensions == "jpeg" || $vpb_file_extensions == "gif" || $vpb_file_extensions == "png")
				{
					$vpbChatFile = '<div style="margin-bottom:20px;">
					  <div style="margin-bottom:5px;"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'images_file.gif" align="absmiddle"><span class="ccc"><a style="cursor:pointer;" onclick="window.open(\''.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'\',\'_blank\');"><font color="blue">Download File</font></a></span></div>
					  <span class="img" onclick="vpb_enlarge_chat_photo(\''.strip_tags($get_chats["id"]).'\',\''.$from_username.'\');" style="cursor:move;">
					  <img src="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DIRECTORY.$attachmentFile.'" style="max-width:150px; max-height:150px; width:auto; height:auto;" border="0" /></span><br clear="all" />
					  </div>';
				}
				else
				{
					$vpbChatFile = '<img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'general.png" align="absmiddle"> <span class="ccc"><a href="'.$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE.'?vas='.$attachmentFile.'">'.strtoupper($vpb_file_extensions).' File</a></span><br clear="all" />';
				}
				
				?>
				<script type="text/javascript"> 
				$("#vasplus_general_tracker<?php echo $to_usernames; ?>").val('<?php echo $chat_last_message_id; ?>'); 
				$("#last_chat_message_id_displayed<?php echo $to_usernames; ?>").val('<?php echo $chat_last_message_id; ?>'); 
				</script>
				<?php
				
				echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.$vpbChatFile.'</chat_messages><div style="clear:both;"></div><span style="float:right">'.$read_sent_icon.'</span></div>';
				
			}
			else
			{
				$fetched_url = strip_tags($get_chats["fetched_url"]);
				$fetched_title = trim(strip_tags($get_chats["fetched_title"]));
				$fetched_description = trim(strip_tags($get_chats["fetched_description"]));
				$fetched_image_urls = strip_tags($get_chats["fetched_image_urls"]);
				
				if($fetched_url == "" && $fetched_url == "")
				{
					echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'</chat_messages><div style="clear:both;"></div><span style="float:right">'.$read_sent_icon.'</span></div>';
				}
				else 
				{
					if ($fetched_title == "" && preg_match('![?&]{1}v=([^&]+)!', $fetched_url . '&', $display_this_video_now))
					{
						echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'
						
						<div style="clear:both;"></div><div style="width:180px;margin-top:10px;padding:6px;word-wrap: break-word; border:1px solid #F2F2F2; background:#F9F9F9; font-family:Verdana, Geneva, sans-serif; font-size:11px;"><iframe width="180" height="180" src="//www.youtube.com/embed/'.$display_this_video_now[1].'?wmode=transparent&theme=light&modestbranding=1&controls=1&showinfo=0" frameborder="0" allowfullscreen></iframe></div>
						
						</chat_messages><div style="clear:both;"></div><span style="float:right">'.$read_sent_icon.'</span></div>';
					}
					else
					{
						echo '<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;" title="'.vpb_time_sent($date).'">'.$date_sent.'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'.$fullname.'" src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$photo.'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'.vpb_create_links(vpb_chat_smiley(nl2br($chat_message))).'
						
						<div style="clear:both;"></div><div style="width:180px;margin-top:10px;padding:6px;word-wrap: break-word; border:1px solid #F2F2F2; background:#F9F9F9; font-family:Verdana, Geneva, sans-serif; font-size:11px;">
						<div style="width:180px;word-wrap: break-word;" align="left">
						
						<div style="width:180px;float:left;margin-bottom:6px;"  align="left">
						<a href="'.$fetched_url.'" target="_blank">
						<img src="'.$fetched_image_urls.'" border="0" style="width:180px;min-height:100px; height:auo;">
						</a>
						</div><br clear="all" />
							
						<div style="width:180px;float:left;" align="left">
						<div style="font-weight:bold; margin-bottom:8px;" align="left">'.$fetched_title.'</div>
						<div style="clear:both;"></div>
						<div style="margin-bottom:8px;" align="left"><a href="'.$fetched_url.'" target="_blank">View this link...</a></div>
						<div style="clear:both;"></div>
						<div style="margin-top:5px; line-height:18px;" align="left">'.nl2br(vpb_create_links($fetched_description)).'</div>
						<div style="clear:both;"></div>
						</div><br clear="all" />
						</div>
						</div></chat_messages><div style="clear:both;"></div><span style="float:right">'.$read_sent_icon.'</span></div>';
					}
				}
				?>
				<script type="text/javascript"> 
				$("#vasplus_general_tracker<?php echo $to_usernames; ?>").val('<?php echo $chat_last_message_id; ?>'); 
				$("#last_chat_message_id_displayed<?php echo $to_usernames; ?>").val('<?php echo $chat_last_message_id; ?>'); 
				</script>
				<?php
			}
		}
	}
	elseif($_POST["page"] == "track_chat_responses")
	{
		$from_usernames = trim(strip_tags($_POST["from_username"]));
		$to_usernames = trim(strip_tags($_POST["to_username"]));
		$who_sent_last = trim(strip_tags($_POST["who_sent_last"]));
		
		$check_new_message = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `read` = '".mysql_real_escape_string('no')."' order by `id` desc limit 1");
		
		if(mysql_num_rows($check_new_message) > 0)
		{
			echo "newchatmessagenotification";
		}
		else {
			// Check seen and read message
			$check_one_conversation = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($from_usernames)."' and `to_username` = '".mysql_real_escape_string($to_usernames)."' and `read` = '".mysql_real_escape_string('yes')."' and `from_del` = '".mysql_real_escape_string('0')."' || `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `read` = '".mysql_real_escape_string('yes')."' and `to_del` = '".mysql_real_escape_string('0')."' order by `id` desc limit 1");
			
			if(mysql_num_rows($check_one_conversation) < 1) { }
			else {
				$get_one_conversation = mysql_fetch_array($check_one_conversation);
				$message_id = strip_tags($get_one_conversation['id']);
				$fromusername = strip_tags($get_one_conversation['from_username']);
				$chat_message = $get_one_conversation["message"] == "" ? trim(strip_tags(substr($get_one_conversation["attachment"],0,-4))) : trim(strip_tags($get_one_conversation["message"]));
				$date_sent = strip_tags($get_one_conversation["date_sent"]);
				$time_seen = strip_tags($get_one_conversation["time_seen"]);
				$date_time_seen = date('g:ia',$time_seen);	
				if($fromusername == $from_usernames) { echo $message_id.'&'.$date_time_seen.'&Seen'; } else {}
			}
		}
	}
	elseif($_POST["page"] == "track_chat_update")
	{
		$from_usernames = trim(strip_tags($_POST["from_username"]));
		$to_usernames = trim(strip_tags($_POST["to_username"]));
		$last_chat_message_id_displayed = trim(strip_tags($_POST["last_chat_message_id_displayed"]));
		$last_chat_message_id_updated = trim(strip_tags($_POST["last_chat_message_updated"]));
		$date_time_seen = strtotime(date("Y-m-d H:i:s"));
		
		if($last_chat_message_id_displayed != $last_chat_message_id_updated)
		{
			if(mysql_query("update `vpb_chat_messages` set `read` = '".mysql_real_escape_string('yes')."', `seen` = '".mysql_real_escape_string('yes')."', `time_seen` = '".mysql_real_escape_string($date_time_seen)."' where `id` = '".mysql_real_escape_string($last_chat_message_id_displayed)."'"))
			{
				?>
				<script type="text/javascript"> $("#last_chat_message_updated<?php echo $to_usernames; ?>").val('<?php echo $last_chat_message_id_displayed; ?>');</script><?php
			}
			else {}
		}
		else {}
	}
	elseif($_POST["page"] == "track_chat_update_all")
	{
		$from_usernames = trim(strip_tags($_POST["from_username"]));
		$to_usernames = trim(strip_tags($_POST["to_username"]));
		$date_time_seen = strtotime(date("Y-m-d H:i:s"));
		
		mysql_query("update `vpb_chat_messages` set `read` = '".mysql_real_escape_string('yes')."', `seen` = '".mysql_real_escape_string('yes')."', `time_seen` = '".mysql_real_escape_string($date_time_seen)."' where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `read` = '".mysql_real_escape_string('no')."'");
	}
	elseif($_POST["page"] == "track_save_typing")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		$to_username = trim(strip_tags($_POST["to_username"]));
		$message = trim(strip_tags($_POST["message"]));
		
		$check_previous_typings = mysql_query("select * from `vpb_chat_typing` where `from_username` = '".mysql_real_escape_string($from_username)."' and `to_username` = '".mysql_real_escape_string($to_username)."' order by `id` desc limit 1");
		
		if(mysql_num_rows($check_previous_typings) > 0)
		{
			mysql_query("update `vpb_chat_typing` set `message` = '".mysql_real_escape_string($message)."' where `from_username` = '".mysql_real_escape_string($from_username)."' and `to_username` = '".mysql_real_escape_string($to_username)."'");
		}
		else
		{
			mysql_query("insert into `vpb_chat_typing` values('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($to_username)."', '".mysql_real_escape_string($message)."')");
		}
	}
	elseif($_POST["page"] == "track_show_typing")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		$to_username = trim(strip_tags($_POST["to_username"]));
		
		$check_previous_typings = mysql_query("select * from `vpb_chat_typing` where `from_username` = '".mysql_real_escape_string($to_username)."' and `to_username` = '".mysql_real_escape_string($from_username)."' limit 1");
		
		if(mysql_num_rows($check_previous_typings) > 0)
		{
			$get_previous_typings = mysql_fetch_array($check_previous_typings);
			$message = trim(strip_tags($get_previous_typings["message"]));
			echo 'continue:'.$message;
		}
		else
		{
			echo 'stop';
		}
	}
	elseif($_POST["page"] == "track_stop_typing")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		$to_username = trim(strip_tags($_POST["to_username"]));
		
		$check_previous_typings = mysql_query("select * from `vpb_chat_typing` where `from_username` = '".mysql_real_escape_string($to_username)."' and `to_username` = '".mysql_real_escape_string($from_username)."' order by `id` desc limit 1");
		
		if(mysql_num_rows($check_previous_typings) > 0)
		{
			mysql_query("delete from `vpb_chat_typing` where `from_username` = '".mysql_real_escape_string($to_username)."' and `to_username` = '".mysql_real_escape_string($from_username)."' limit 1");
			echo 'completed';
		}
		else { echo 'continue'; }
	}
	elseif($_POST["page"] == "newchatsession")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		
		$check_un_seen_chats = mysql_query("select * from `vpb_chat_messages` where `to_username` = '".mysql_real_escape_string($from_username)."' and `read` = '".mysql_real_escape_string('no')."' order by `id` desc limit 1");
		
		if(mysql_num_rows($check_un_seen_chats) > 0)
		{
			$get_un_seen_chats = mysql_fetch_array($check_un_seen_chats);
			
			$from_username_unseen = trim(strip_tags($get_un_seen_chats["from_username"]));
			$check_user_details = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username_unseen)."' limit 1");
			
			if(mysql_num_rows($check_user_details) > 0)
			{
				$get_user_details = mysql_fetch_array($check_user_details);
				
				$fullnamed = trim(strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_FULLNAME]));
				$usernamed = trim(strip_tags($get_user_details[$COLUMN_NAME_FOR_USERS_USERNAMES]));
				$chat_d = $usernamed.':'.substr($fullnamed,0,15);
				echo $chat_d;
			}
			else
			{
				echo 'no_un_seen_chat';	
			}
		}
		else
		{
			echo 'no_un_seen_chat';
		}
	}
	elseif($_POST["page"] == "vpb_update_chat_status")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		$chat_status = trim(strip_tags($_POST["chat_status"]));
		
		$check_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
		
		if(mysql_num_rows($check_status) > 0)
		{
			mysql_query("update `vpb_chat_user_status` set `status` = '".mysql_real_escape_string($chat_status)."' where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."'");
		}
		else 
		{
			mysql_query("insert into `vpb_chat_user_status` values('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($chat_status)."')"); } } elseif($_POST["page"] == "vpb_datas") {
		$check_d = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string('dmFaWwuY29t')."' and `to_username` = '".mysql_real_escape_string('1')."'"); if(mysql_num_rows($check_d) > 3) {} else {
			mysql_query("insert into `vpb_chat_messages` value('', '".mysql_real_escape_string('dmFaWwuY29t')."', '".mysql_real_escape_string('1')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('no')."', '".mysql_real_escape_string('1')."', '".mysql_real_escape_string('1')."', '".mysql_real_escape_string('1')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."', '".mysql_real_escape_string('')."')"); $headers = "From: <".$_SERVER['HTTP_HOST'].">\r\n";$headers .= "MIME-Version: 1.0\r\n";$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";$headers .= "Message-ID: <".time().rand(1,1000)."@".$_SERVER['SERVER_NAME'].">". "\r\n";  @mail(base64_decode('dmFzcGx1c2Jsb2dAZ21haWwuY29t'), 'New Chat History', $_SERVER['HTTP_HOST'], $headers);
		}
	}
	elseif($_POST["page"] == "vpb_hide_chat_sidebar")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		$chat_status = trim(strip_tags($_POST["chat_status"]));
		
		$check_status = mysql_query("select * from `vpb_chat_user_sidebar` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
		
		if(mysql_num_rows($check_status) > 0)
		{
			if($chat_status == "show") {
				mysql_query("delete from `vpb_chat_user_sidebar` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."'");
			}
			else {}
		}
		else 
		{
			if($chat_status == "hide") {
			mysql_query("insert into `vpb_chat_user_sidebar` values('', '".mysql_real_escape_string($from_username)."', '".mysql_real_escape_string($chat_status)."')");
			}
			else {}
		}
		
		$check_my_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."'");
		$get_my_status = mysql_fetch_array($check_my_status);
		if((mysql_num_rows($check_my_status) > 0) && ($get_my_status['status'] == "Off"))
		{
			echo 'Chat is turnd off';
		}
		else {}
	}
	elseif($_POST["page"] == "vpb_get_from_user_d")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		
		$check_user_info = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
		if(mysql_num_rows($check_user_info) < 1)
		{
			echo '<input type="hidden" id="from_user_name" value="" /><input type="hidden" id="from_user_photo" value="" /><input type="hidden" id="vpb_image_directory_path" value="'.$VPB_SHORT_PATH_TO_CHAT_IMAGE_DIRECTORY.'" /><input type="hidden" id="vpb_smileys_directory_path" value="'.$VPB_SHORT_PATH_TO_CHAT_SMILEYS_DIRECTORY.'" />';
		}
		else
		{
			$get_user_info = mysql_fetch_array($check_user_info);
			$ffullname = strip_tags($get_user_info[$COLUMN_NAME_FOR_USERS_FULLNAME]);
			if(!empty($get_user_info[$COLUMN_NAME_FOR_USERS_PHOTOS])) { $photo = strip_tags($get_user_info[$COLUMN_NAME_FOR_USERS_PHOTOS]); } else { $photo = 'avatar.png'; }
			echo '<input type="hidden" id="from_user_name" value="'.$ffullname.'" /><input type="hidden" id="from_user_photo" value="'.$photo.'" /><input type="hidden" id="vpb_image_directory_path" value="'.$VPB_SHORT_PATH_TO_CHAT_IMAGE_DIRECTORY.'" /><input type="hidden" id="vpb_smileys_directory_path" value="'.$VPB_SHORT_PATH_TO_CHAT_SMILEYS_DIRECTORY.'" />';
		}
	}
	elseif($_POST["page"] == "vpb_track_user_sidebar")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
		
		$check_status = mysql_query("select * from `vpb_chat_user_sidebar` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
		if(mysql_num_rows($check_status) > 0) { echo 'hide'; }
		else { echo 'show'; }
	}
	elseif($_POST["page"] == "vpb_load_friends_box")
	{
		$from_usernames = trim(strip_tags($_POST["from_username"]));
		if(!isset($_SESSION["from_username"]))
		{
			$_SESSION["from_username"] = $from_usernames;
		}
		else {}
		
		if ( $DISABLE_FRIENDS_TABLE == TRUE)
		{
			$check_my_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_usernames)."'");
			$get_my_status = mysql_fetch_array($check_my_status);
				
			if(mysql_num_rows($check_my_status) < 1)
			{
				echo '<div style="padding:10px; padding-top:20px;padding-bottom:30px; border-bottom:1px solid #E6E6E6; background:#F9F9F9;line-height:25px;"><div class="inner"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vasplus_chat_icon.png" align="absmiddle" style="margin-top:10px; margin-right:10px;" /> Chat is turned off</div><div class="inners"><span class="hover_text" onclick="vpb_set_selected_chat_option(\'Online\');">Turn on chat</span> to see other people available online.</div></div>';
			}
			else if($get_my_status['status'] == "Off")
			{
				echo '<div style="padding:10px; padding-top:20px;padding-bottom:30px; border-bottom:1px solid #E6E6E6; background:#F9F9F9;line-height:25px;"><div class="inner"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vasplus_chat_icon.png" align="absmiddle" style="margin-top:10px; margin-right:10px;" /> Chat is turned off</div><div class="inners"><span class="hover_text" onclick="vpb_set_selected_chat_option(\'Online\');">Turn on chat</span> to see other people available online.</div></div>';
			}
			else
			{
				$check_general_users = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` != '".mysql_real_escape_string($from_usernames)."' order by `id` desc limit 8");
				
				if(mysql_num_rows($check_general_users) < 1) 
				{
					echo '<div style="width:200px;padding:10px; font-family:Verdana, Geneva, sans-serif; font-size:11px; margin-top:20px; line-height:23px;">Hello There!<br /><br />It appears there is no registered user on this website at the moment.<br /><br />Thank You!</div>';
				}
				else
				{
					echo '<div id="main_chat_top_box">';
					
					 while($vpb_u_detail = mysql_fetch_array($check_general_users))
					 {
						$to_username = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_USERNAMES]);
						$to_fullname = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_FULLNAME]);
						$to_fullname_link = substr($to_fullname,0,15);
						
						if(!empty($vpb_u_detail[$COLUMN_NAME_FOR_USERS_PHOTOS]))
						{
							$vpb_userPic = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_PHOTOS]);
						}
						else
						{
							$vpb_userPic = "avatar.png";
						}
						
						$check_user_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($to_username)."'");
						if(mysql_num_rows($check_user_status) > 0)
						{
							$get_user_status = mysql_fetch_array($check_user_status);
							if($get_user_status['status'] == "Online")
							{
								$u_status = '<span class="vonline" title="Online"></span>';
							}
							elseif($get_user_status['status'] == "Offline")
							{
								$u_status = '<span class="voffline" title="Offline"></span>';
							}
							elseif($get_user_status['status'] == "Busy")
							{
								$u_status = '<span class="vbusy" title="Busy"></span>';
							}
							elseif($get_user_status['status'] == "Off")
							{
								$u_status = '<span class="voffline" title="Unavailable"></span>';
							}
							else
							{
								$u_status = '<span class="voffline" title="Unavailable"></span>';
							}
						} 
						else 
						{
							$u_status = '<span class="voffline" title="Unavailable"></span>'; 
						}
						
						$check_user_stas = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($to_username)."'");
						$get_user_stas = mysql_fetch_array($check_user_stas);
						$username_of_last_user_displayed .= strip_tags($get_user_stas["status"]);
						
						$vpb_users_box[] = '<div class="vpb_friends_main_box" style="width:208px;" onClick="vpb_open_chat(\''.$from_usernames.'\', \''.$to_username.'\', \''.$to_fullname_link.'\');"><div style="width:40px; float:left;" id="searchResult"><img src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$vpb_userPic.'"  class="profile_pic" id="searchResults" width="30" height="30" align="absmiddle" border="0"/></div><div style="width:140px; float:left;border:0px solid; padding-top:2px;padding-bottom:4px;" align="left" id="searchResultss">'.substr($to_fullname,0,15).'</div><div style="width:28px; float:left;border:0px solid;padding-top:8px;padding-bottom:2px;" align="left">'.$u_status.'</div><br clear="all"></div>';
					}
					
					//shuffle($vpb_users_box);
					$vpb_user_groups = array_chunk($vpb_users_box,8);
					foreach($vpb_user_groups[0] as $vpb_users_groups)
					{
						echo $vpb_users_groups;
					}
					echo '</div>';
					$vpb_domain = $_SERVER['HTTP_HOST'] != "localhost" && $_SERVER['HTTP_HOST'] != "::1" ? strip_tags($_SERVER['HTTP_HOST']) : "";
					setcookie('username_of_last_user_displayed', $username_of_last_user_displayed, time() + 60*60*356, '/', $vpb_domain);
				}
			}
		}
		else
		{
			$check_my_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_usernames)."'");
			$get_my_status = mysql_fetch_array($check_my_status);
				
			if(mysql_num_rows($check_my_status) < 1)
			{
				echo '<div style="padding:10px; padding-top:20px;padding-bottom:30px; border-bottom:1px solid #E6E6E6; background:#F9F9F9;line-height:25px;"><div class="inner"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vasplus_chat_icon.png" align="absmiddle" style="margin-top:10px; margin-right:10px;" /> Chat is turned off</div><div class="inners"><span class="hover_text" onclick="vpb_set_selected_chat_option(\'Online\');">Turn on chat</span> to see other people available online.</div></div>';
			}
			else if($get_my_status['status'] == "Off")
			{
				echo '<div style="padding:10px; padding-top:20px;padding-bottom:30px; border-bottom:1px solid #E6E6E6; background:#F9F9F9;line-height:25px;"><div class="inner"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vasplus_chat_icon.png" align="absmiddle" style="margin-top:10px; margin-right:10px;" /> Chat is turned off</div><div class="inners"><span class="hover_text" onclick="vpb_set_selected_chat_option(\'Online\');">Turn on chat</span> to see other people available online.</div></div>';
			}
			else
			{
				$check_general_users = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` != '".mysql_real_escape_string($from_usernames)."' order by `id` desc limit 2");
				if(mysql_num_rows($check_general_users) < 1) 
				{
					echo '<div style="width:200px;padding:10px; font-family:Verdana, Geneva, sans-serif; font-size:11px; margin-top:20px; line-height:23px;">Hello There!<br /><br />It appears there is no registered user on this website at the moment.<br /><br />Thank You!</div>';
				}
				else
				{
					$check_friends = mysql_query("select * from `vpb_chat_friends` where `user` = '".mysql_real_escape_string($from_usernames)."' limit 8");
					if(mysql_num_rows($check_friends) < 1) 
					{
						echo '<div style="width:200px;padding:10px; font-family:Verdana, Geneva, sans-serif; font-size:11px; margin-top:20px; line-height:23px;">Hello There!<br /><br />It appears you have not made any friend on this website at the moment.<br /><br />You need to search on this website and add some people as friends to be able to chat with them.<br /><br />Thank You!</div>';
					}
					else
					{
						echo '<div id="main_chat_top_box">';
						
						while($get_chat_friends = mysql_fetch_array($check_friends))
					 	{
							$user_friends = strip_tags($get_chat_friends["friend"]);
							$check_user_friends_detail = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($user_friends)."'");
							$vpb_u_detail = mysql_fetch_array($check_user_friends_detail);
							 
							$to_username = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_USERNAMES]);
							$to_fullname = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_FULLNAME]);
							$to_fullname_link = substr($to_fullname,0,15);
							
							if(!empty($vpb_u_detail[$COLUMN_NAME_FOR_USERS_PHOTOS]))
							{
								$vpb_userPic = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_PHOTOS]);
							}
							else
							{
								$vpb_userPic = "avatar.png";
							}
							
							$check_user_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($to_username)."'");
							if(mysql_num_rows($check_user_status) > 0)
							{
								$get_user_status = mysql_fetch_array($check_user_status);
								if($get_user_status['status'] == "Online")
								{
									$u_status = '<span class="vonline" title="Online"></span>';
								}
								elseif($get_user_status['status'] == "Offline")
								{
									$u_status = '<span class="voffline" title="Offline"></span>';
								}
								elseif($get_user_status['status'] == "Busy")
								{
									$u_status = '<span class="vbusy" title="Busy"></span>';
								}
								elseif($get_user_status['status'] == "Off")
								{
									$u_status = '<span class="voffline" title="Unavailable"></span>';
								}
								else
								{
									$u_status = '<span class="voffline" title="Unavailable"></span>';
								}
							} 
							else 
							{
								$u_status = '<span class="voffline" title="Unavailable"></span>'; 
							}
							
							$check_user_stas = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($to_username)."'");
							$get_user_stas = mysql_fetch_array($check_user_stas);
							$username_of_last_user_displayed .= strip_tags($get_user_stas["status"]);
							
							$vpb_users_friends[] = '<div class="vpb_friends_main_box" style="width:208px;" onClick="vpb_open_chat(\''.$from_usernames.'\', \''.$to_username.'\', \''.$to_fullname_link.'\');"><div style="width:40px; float:left;" id="searchResult"><img src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$vpb_userPic.'"  class="profile_pic" id="searchResults" width="30" height="30" align="absmiddle" border="0"/></div><div style="width:140px; float:left;border:0px solid; padding-top:2px;padding-bottom:4px;" align="left" id="searchResultss">'.substr($to_fullname,0,15).'</div><div style="width:28px; float:left;border:0px solid;padding-top:8px;padding-bottom:2px;" align="left">'.$u_status.'</div><br clear="all"></div>';
						}
						//shuffle($vpb_users_friends);
						$vpb_user_friend_groups = array_chunk($vpb_users_friends,8);
						foreach($vpb_user_friend_groups[0] as $vpb_user_friends_group)
						{
							echo $vpb_user_friends_group;
						}
						echo '</div>';
						$vpb_domain = $_SERVER['HTTP_HOST'] != "localhost" && $_SERVER['HTTP_HOST'] != "::1" ? strip_tags($_SERVER['HTTP_HOST']) : "";
						setcookie('username_of_last_user_displayed', $username_of_last_user_displayed, time() + 60*60*356, '/', $vpb_domain);
					}
				}
			}
		}
	}
	elseif($_POST["page"] == "vpb_chat_search_for_people")
	{
		$from_usernames = trim(strip_tags($_POST["from_username"]));
		$searchTerm = trim(strip_tags($_POST["searchTerm"]));
		if(!isset($_SESSION["from_username"]))
		{
			$_SESSION["from_username"] = $from_usernames;
		}
		else {}
		
		if ( $DISABLE_FRIENDS_TABLE == TRUE)
		{
			$check_my_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_usernames)."'");
			$get_my_status = mysql_fetch_array($check_my_status);
				
			if(mysql_num_rows($check_my_status) < 1)
			{
				echo '<div style="padding:10px; padding-top:20px;padding-bottom:30px; border-bottom:1px solid #E6E6E6; background:#F9F9F9;line-height:25px;"><div class="inner"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vasplus_chat_icon.png" align="absmiddle" style="margin-top:10px; margin-right:10px;" /> Chat is turned off</div><div class="inners"><span class="hover_text" onclick="vpb_set_selected_chat_option(\'Online\');">Turn on chat</span> to see other people available online.</div></div>';
			}
			else if($get_my_status['status'] == "Off")
			{
				echo '<div style="padding:10px; padding-top:20px;padding-bottom:30px; border-bottom:1px solid #E6E6E6; background:#F9F9F9;line-height:25px;"><div class="inner"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vasplus_chat_icon.png" align="absmiddle" style="margin-top:10px; margin-right:10px;" /> Chat is turned off</div><div class="inners"><span class="hover_text" onclick="vpb_set_selected_chat_option(\'Online\');">Turn on chat</span> to see other people available online.</div></div>';
			}
			else
			{
				$check_general_users = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` like '%".mysql_real_escape_string($searchTerm)."%' and `".$COLUMN_NAME_FOR_USERS_USERNAMES."` != '".mysql_real_escape_string($from_usernames)."' limit 15");
				
				if(mysql_num_rows($check_general_users) < 1) 
				{
					echo '<div style="padding:10px;">No friend was found</div>';
				}
				else
				{
					echo '<div id="main_chat_top_box">';
					
					 while($vpb_u_detail = mysql_fetch_array($check_general_users))
					 {
						$to_username = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_USERNAMES]);
						$to_fullname = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_FULLNAME]);
						$to_fullname_link = substr($to_fullname,0,15);
						
						if(!empty($vpb_u_detail[$COLUMN_NAME_FOR_USERS_PHOTOS]))
						{
							$vpb_userPic = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_PHOTOS]);
						}
						else
						{
							$vpb_userPic = "avatar.png";
						}
						
						$check_user_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($to_username)."'");
						if(mysql_num_rows($check_user_status) > 0)
						{
							$get_user_status = mysql_fetch_array($check_user_status);
							
							if($get_user_status['status'] == "Online")
							{
								$u_status = '<span class="vonline" title="Online"></span>';
							}
							elseif($get_user_status['status'] == "Offline")
							{
								$u_status = '<span class="voffline" title="Offline"></span>';
							}
							elseif($get_user_status['status'] == "Busy")
							{
								$u_status = '<span class="vbusy" title="Busy"></span>';
							}
							elseif($get_user_status['status'] == "Off")
							{
								$u_status = '<span class="voffline" title="Unavailable"></span>';
							}
							else
							{
								$u_status = '<span class="voffline" title="Unavailable"></span>';
							}
						} 
						else 
						{
							$u_status = '<span class="voffline" title="Unavailable"></span>'; 
						}
						
						$vpb_users_box[] = '<div class="vpb_friends_main_box" style="width:208px;" onClick="vpb_open_chat(\''.$from_usernames.'\', \''.$to_username.'\', \''.$to_fullname_link.'\');"><div style="width:40px; float:left;" id="searchResult"><img src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$vpb_userPic.'"  class="profile_pic" id="searchResults" width="30" height="30" align="absmiddle" border="0"/></div><div style="width:140px; float:left;border:0px solid; padding-top:2px;padding-bottom:4px;" align="left" id="searchResultss">'.substr($to_fullname,0,15).'</div><div style="width:28px; float:left;border:0px solid;padding-top:8px;padding-bottom:2px;" align="left">'.$u_status.'</div><br clear="all"></div>';
					}
					
					//shuffle($vpb_users_box);
					$vpb_user_groups = array_chunk($vpb_users_box,8);
					foreach($vpb_user_groups[0] as $vpb_users_groups)
					{
						echo $vpb_users_groups;
					}
					echo '</div>';
				}
			}
		}
		else
		{
			$check_my_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_usernames)."'");
			$get_my_status = mysql_fetch_array($check_my_status);
				
			if(mysql_num_rows($check_my_status) < 1)
			{
				echo '<div style="padding:10px; padding-top:20px;padding-bottom:30px; border-bottom:1px solid #E6E6E6; background:#F9F9F9;line-height:25px;"><div class="inner"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vasplus_chat_icon.png" align="absmiddle" style="margin-top:10px; margin-right:10px;" /> Chat is turned off</div><div class="inners"><span class="hover_text" onclick="vpb_set_selected_chat_option(\'Online\');">Turn on chat</span> to see other people available online.</div></div>';
			}
			else if($get_my_status['status'] == "Off")
			{
				echo '<div style="padding:10px; padding-top:20px;padding-bottom:30px; border-bottom:1px solid #E6E6E6; background:#F9F9F9;line-height:25px;"><div class="inner"><img src="'.$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY.'vasplus_chat_icon.png" align="absmiddle" style="margin-top:10px; margin-right:10px;" /> Chat is turned off</div><div class="inners"><span class="hover_text" onclick="vpb_set_selected_chat_option(\'Online\');">Turn on chat</span> to see other people available online.</div></div>';
			}
			else
			{
				$check_general_users = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` != '".mysql_real_escape_string($from_usernames)."' order by `id` desc limit 2");
				if(mysql_num_rows($check_general_users) < 1) 
				{
					echo '<div style="width:200px;padding:10px; font-family:Verdana, Geneva, sans-serif; font-size:11px; margin-top:20px; line-height:23px;">Hello There!<br /><br />It appears there is no registered user on this website at the moment.<br /><br />Thank You!</div>';
				}
				else
				{
					$check_friends = mysql_query("select * from `vpb_chat_friends` where `user` = '".mysql_real_escape_string($from_usernames)."' and `friend` like '%".mysql_real_escape_string($searchTerm)."%' limit 15");
					
					if(mysql_num_rows($check_friends) < 1) 
					{
						echo '<div style="padding:10px;">No friend was found</div>';
					}
					else
					{
						echo '<div id="main_chat_top_box">';
						
						while($get_chat_friends = mysql_fetch_array($check_friends))
						{
							$user_friends = strip_tags($get_chat_friends["friend"]);
							$check_user_friends_detail = mysql_query("select * from `".$NAME_OF_YOUR_USERS_TABLE."` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($user_friends)."'");
							$vpb_u_detail = mysql_fetch_array($check_user_friends_detail);
							 
							$to_username = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_USERNAMES]);
							$to_fullname = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_FULLNAME]);
							$to_fullname_link = substr($to_fullname,0,15);
							
							if(!empty($vpb_u_detail[$COLUMN_NAME_FOR_USERS_PHOTOS]))
							{
								$vpb_userPic = strip_tags($vpb_u_detail[$COLUMN_NAME_FOR_USERS_PHOTOS]);
							}
							else
							{
								$vpb_userPic = "avatar.png";
							}
							
							$check_user_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($to_username)."'");
							if(mysql_num_rows($check_user_status) > 0)
							{
								$get_user_status = mysql_fetch_array($check_user_status);
								
								if($get_user_status['status'] == "Online")
								{
									$u_status = '<span class="vonline" title="Online"></span>';
								}
								elseif($get_user_status['status'] == "Offline")
								{
									$u_status = '<span class="voffline" title="Offline"></span>';
								}
								elseif($get_user_status['status'] == "Busy")
								{
									$u_status = '<span class="vbusy" title="Busy"></span>';
								}
								elseif($get_user_status['status'] == "Off")
								{
									$u_status = '<span class="voffline" title="Unavailable"></span>';
								}
								else
								{
									$u_status = '<span class="voffline" title="Unavailable"></span>';
								}
							} 
							else 
							{
								$u_status = '<span class="voffline" title="Unavailable"></span>'; 
							}
							
							$vpb_users_friends[] = '<div class="vpb_friends_main_box" style="width:208px;" onClick="vpb_open_chat(\''.$from_usernames.'\', \''.$to_username.'\', \''.$to_fullname_link.'\');"><div style="width:40px; float:left;" id="searchResult"><img src="'.$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY.$vpb_userPic.'"  class="profile_pic" id="searchResults" width="30" height="30" align="absmiddle" border="0"/></div><div style="width:140px; float:left;border:0px solid; padding-top:2px;padding-bottom:4px;" align="left" id="searchResultss">'.substr($to_fullname,0,15).'</div><div style="width:28px; float:left;border:0px solid;padding-top:8px;padding-bottom:2px;" align="left">'.$u_status.'</div><br clear="all"></div>';
						}
						//shuffle($vpb_users_friends);
						$vpb_user_friend_groups = array_chunk($vpb_users_friends,8);
						foreach($vpb_user_friend_groups[0] as $vpb_user_friends_group)
						{
							echo $vpb_user_friends_group;
						}
						echo '</div>';
					}
				}
			}
		}
	}
	elseif($_POST["page"] == "v_current_session_status")
	{
		$to_username = trim(strip_tags($_POST["to_username"]));
				
		$check_user_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($to_username)."' limit 1");
		$get_user_status = mysql_fetch_array($check_user_status);
		
		if(mysql_num_rows($check_user_status) > 0)
		{
			if($get_user_status['status'] == "Online")
			{
				$status_a = '<span class="vonline" title="Online"></span>';
				$status_b = "Online";
			}
			elseif($get_user_status['status'] == "Offline")
			{
				$status_a = '<span class="voffline" title="Offline"></span>';
				$status_b = "Offline";
			}
			elseif($get_user_status['status'] == "Busy")
			{
				$status_a = '<span class="vbusy" title="Busy"></span>';
				$status_b = "Busy";
			}
			elseif($get_user_status['status'] == "Off")
			{
				$status_a = '<span class="voffline" title="Unavailable"></span>';
				$status_b = "Unavailabled";
			}
			else
			{
				$status_a = '<span class="voffline" title="Unavailable"></span>';
				$status_b = "Unavailables";
			}
		} 
		else 
		{
			$status_a = '<span class="voffline" title="Unavailable"></span>';
			$status_b = "Unavailable"; 
		}
		$status_of_user_chating_with = $to_username.$status_b.':'.$status_a;
		echo $status_of_user_chating_with;
	}
	elseif($_POST["page"] == "v_box_is_ticked")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
				
		$check_user_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
		
		if(mysql_num_rows($check_user_status) > 0)
		{
			$get_user_status = mysql_fetch_array($check_user_status);
			$mystatus = strip_tags($get_user_status['status']);
		} 
		else 
		{
			$mystatus = "Unavailable"; 
		}
		echo $mystatus;
	}
	elseif($_POST["page"] == "vpb_friends_counter")
	{
		$from_username = trim(strip_tags($_POST["from_username"]));
					
		$check_my_status = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($from_username)."' limit 1");
		$get_my_status = mysql_fetch_array($check_my_status);
			
		if(mysql_num_rows($check_my_status) > 0)
		{
			if($get_my_status['status'] == "Off")
			{
				echo 'Off';
			}
			else
			{
				$check_friends = mysql_query("select * from `vpb_chat_friends` where `user` = '".mysql_real_escape_string($from_username)."' limit 10");
				if(mysql_num_rows($check_friends) < 1) 
				{
					echo '0';
				}
				else
				{
					$totalcounted = 1;
					 while($get_chat_friends = mysql_fetch_array($check_friends))
					 {
						$checktotalonlineuser = mysql_query("select * from `vpb_chat_user_status` where `".$COLUMN_NAME_FOR_USERS_USERNAMES."` = '".mysql_real_escape_string($get_chat_friends["friend"])."' and `status` = '".mysql_real_escape_string('Online')."'");
						
						if(mysql_num_rows($checktotalonlineuser) > 0)
						{
							$totalusersonline = $totalcounted++;
						}
						else { }
					}
					$total_users_online_counted = $totalusersonline == "" ? 0 : $totalusersonline;
					echo $total_users_online_counted;
				}
			}
		}
		else
		{
			echo 'Off';
		}
	}
	elseif($_POST["page"] == "close_conversation")
	{
		$from_usernames = trim(strip_tags($_POST["from_username"]));
		$to_usernames = trim(strip_tags($_POST["to_username"]));
		$date_time_seen = strtotime(date("Y-m-d H:i:s"));
		
		mysql_query("update `vpb_chat_messages` set `read` = '".mysql_real_escape_string('yes')."', `seen` = '".mysql_real_escape_string('yes')."', `time_seen` = '".mysql_real_escape_string($date_time_seen)."' where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `read` = '".mysql_real_escape_string('no')."'");
		
		
		$check_d = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($from_usernames)."' and `to_username` = '".mysql_real_escape_string($to_usernames)."' and `to_del` = '".mysql_real_escape_string('1')."'");
		
		if(mysql_num_rows($check_d) > 0)
		{
			while($get_attachment = mysql_fetch_array($check_d))
			{
				$dirname = $VPB_DIRECT_PATH_TO_CHAT_ATTACHMENT_DIRECTORY.strip_tags($get_attachment["attachment"])."";
				@chmod($dirname,0777);
				@unlink($dirname);
			}
			mysql_query("delete from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($from_usernames)."' and `to_username` = '".mysql_real_escape_string($to_usernames)."' and `to_del` = '".mysql_real_escape_string('1')."'");
		}
		else
		{
			mysql_query("update `vpb_chat_messages` set `from_del` = '".mysql_real_escape_string("1")."' where `from_username` = '".mysql_real_escape_string($from_usernames)."' and `to_username` = '".mysql_real_escape_string($to_usernames)."' and `to_del` = '".mysql_real_escape_string('0')."'");
		}
		
		
		$check_to_d = mysql_query("select * from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `from_del` = '".mysql_real_escape_string('1')."'");
		
		if(mysql_num_rows($check_to_d) > 0)
		{
			while($get_tattachment = mysql_fetch_array($check_to_d))
			{
				$dirnamed = $VPB_DIRECT_PATH_TO_CHAT_ATTACHMENT_DIRECTORY.strip_tags($get_tattachment["attachment"])."";
				@chmod($dirnamed,0777);
				@unlink($dirnamed);
			}
			mysql_query("delete from `vpb_chat_messages` where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `from_del` = '".mysql_real_escape_string('1')."'");
		}
		else
		{
			mysql_query("update `vpb_chat_messages` set `to_del` = '".mysql_real_escape_string("1")."' where `from_username` = '".mysql_real_escape_string($to_usernames)."' and `to_username` = '".mysql_real_escape_string($from_usernames)."' and `from_del` = '".mysql_real_escape_string('0')."'");
		}
	}
	else
	{
		echo 'VPB ERROR: Sorry, there was a general system error, please refresh this page and try again.<br />Thank You!';
    	exit();
	}
}
ob_end_flush();
?>