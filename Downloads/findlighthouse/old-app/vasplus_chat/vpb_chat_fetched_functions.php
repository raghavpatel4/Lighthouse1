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
//URL Data
function vpb_chat_fetch_url_contents($url)
{
	if(!function_exists('curl_init'))
	{
		return file_get_contents($url);
	}
	else
	{
		$vpb_init = curl_init();
		curl_setopt($vpb_init, CURLOPT_HEADER, 0);
		curl_setopt($vpb_init, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($vpb_init, CURLOPT_URL, $url);
		curl_setopt($vpb_init, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($vpb_init, CURLOPT_SSL_VERIFYPEER, false);
		$vpb_exec = curl_exec($vpb_init);
		$vpb_fetched = curl_getinfo($vpb_init, CURLINFO_CONTENT_TYPE);
		if(strstr($vpb_fetched,'text/html')) 
		{
			curl_close($vpb_init); 
			return $vpb_exec; 
		} 
		else {}
	}
}
// Title
function vpb_chat_get_page_title_from_url($pageURL)
{
	  $readPG = fopen($pageURL, 'r');
	  $x = 0;
	  $specifiedPG = '';
	  if ($readPG) 
	  {
			while (!feof($readPG) && ($x < 10)) 
			{
				  $specifiedPG .= fread($readPG, 8192);
				  $x++;
			}
			fclose($readPG);
	  }
	  preg_match("/<title.*?>[\n\r\s]*(.*)[\n\r\s]*<\/title>/", $specifiedPG, $pageTitleFromURL);
	  if (isset($pageTitleFromURL[1])) 
	  {
			if ($pageTitleFromURL[1] == '') 
			{
				  return $pageURL;
			}
			$pageTitleFromURL = $pageTitleFromURL[1];
			return trim($pageTitleFromURL);
	  } 
	  else 
	  {
			return $pageURL;
	  }
}
// Image
function vpb_chat_get_image_from_url($vpb_img_revex)
{
	if ( isset( $vpb_img_revex ) ) 
	{
		$vpb_chat_allowed_extensions = array("jpg","jpeg","gif","png");
		
		if(isset($vpb_img_revex[1][0]) && trim(strip_tags($vpb_img_revex[1][0])) != "")
		{
			$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][0]));
			$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
			if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
			{
				$vpb_fetched_image_file = $vpb_fetched_image_link;
			}
			else
			{
				$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][1]));
				$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
				if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
				{
					$vpb_fetched_image_file = $vpb_fetched_image_link;
				}
				else
				{
					$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][2]));
					$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
					if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
					{
						$vpb_fetched_image_file = $vpb_fetched_image_link;
					}
					else
					{
						$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
						$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
						if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
						{
							$vpb_fetched_image_file = $vpb_fetched_image_link;
						}
						else
						{
							$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][4]));
							$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
							if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
							{
								$vpb_fetched_image_file = $vpb_fetched_image_link;
							}
							else
							{
								$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
								$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
								if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
								{
									$vpb_fetched_image_file = $vpb_fetched_image_link;
								}
								else
								{
									$vpb_fetched_image_file = '';
								}
							}
						}
					}
				}
			}
		}
		elseif(isset($vpb_img_revex[1][1]) && trim(strip_tags($vpb_img_revex[1][1])) != "")
		{
			$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][1]));
			$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
			if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
			{
				$vpb_fetched_image_file = $vpb_fetched_image_link;
			}
			else
			{
				$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][2]));
				$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
				if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
				{
					$vpb_fetched_image_file = $vpb_fetched_image_link;
				}
				else
				{
					$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
					$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
					if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
					{
						$vpb_fetched_image_file = $vpb_fetched_image_link;
					}
					else
					{
						$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][4]));
						$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
						if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
						{
							$vpb_fetched_image_file = $vpb_fetched_image_link;
						}
						else
						{
							$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
							$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
							if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
							{
								$vpb_fetched_image_file = $vpb_fetched_image_link;
							}
							else
							{
								$vpb_fetched_image_file = '';
							}
						}
					}
				}
			}
		}
		elseif(isset($vpb_img_revex[1][2]) && trim(strip_tags($vpb_img_revex[1][2])) != "")
		{
			$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][2]));
			$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
			if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
			{
				$vpb_fetched_image_file = $vpb_fetched_image_link;
			}
			else
			{
				$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
				$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
				if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
				{
					$vpb_fetched_image_file = $vpb_fetched_image_link;
				}
				else
				{
					$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][4]));
					$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
					if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
					{
						$vpb_fetched_image_file = $vpb_fetched_image_link;
					}
					else
					{
						$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
						$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
						if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
						{
							$vpb_fetched_image_file = $vpb_fetched_image_link;
						}
						else
						{
							$vpb_fetched_image_file = '';
						}
					}
				}
			}
		}
		elseif(isset($vpb_img_revex[1][3]) && trim(strip_tags($vpb_img_revex[1][3])) != "")
		{
			$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
			$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
			if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
			{
				$vpb_fetched_image_file = $vpb_fetched_image_link;
			}
			else
			{
				$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][4]));
				$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
				if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
				{
					$vpb_fetched_image_file = $vpb_fetched_image_link;
				}
				else
				{
					$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
					$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
					if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
					{
						$vpb_fetched_image_file = $vpb_fetched_image_link;
					}
					else
					{
						$vpb_fetched_image_file = '';
					}
				}
			}
		}
		elseif(isset($vpb_img_revex[1][4]) && trim(strip_tags($vpb_img_revex[1][4])) != "")
		{
			$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][4]));
			$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
			if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
			{
				$vpb_fetched_image_file = $vpb_fetched_image_link;
			}
			else
			{
				$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
				$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
				if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
				{
					$vpb_fetched_image_file = $vpb_fetched_image_link;
				}
				else
				{
					$vpb_fetched_image_file = '';
				}
			}
		}
		elseif(isset($vpb_img_revex[1][5]) && trim(strip_tags($vpb_img_revex[1][5])) != "")
		{
			$vpb_fetched_image_link = trim(strip_tags($vpb_img_revex[1][3]));
			$vpb_fetched_file_extension = pathinfo(basename($vpb_fetched_image_link), PATHINFO_EXTENSION); //Get file extensions
			if (in_array(strtolower($vpb_fetched_file_extension), $vpb_chat_allowed_extensions))
			{
				$vpb_fetched_image_file = $vpb_fetched_image_link;
			}
			else
			{
				$vpb_fetched_image_file = '';
			}
		}
	}
	else
	{
		$vpb_fetched_image_file = '';
	}
	return $vpb_fetched_image_file;
}
function vpb_get_real_domain($url)
{
	$vpb_domain = parse_url($url);
	$vpb_the_domain = isset($vpb_domain['host']) ? $vpb_domain['host'] : '';
	if($vpb_the_domain != "")
	{
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $vpb_the_domain, $vpb_dname)) {
			return 'http://'.$vpb_dname['domain'].'/';
		}
		else {}
	}
}
?>