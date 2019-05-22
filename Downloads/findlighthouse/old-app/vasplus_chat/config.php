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

/* 
------------ DATABASE CONNECTION DETAILS ----------------

Please specify your database connection details as given below.
*/
define ('hostnameorservername','localhost'); //Your server or host name goes in here
define ('serverusername','sunny1910'); //Your database Username goes in here
define ('serverpassword','Status_987'); //Your database Password goes in here
define ('databasenamed','sunny191_usaschool'); //Your database name goes in here

global $v_connect;
$v_connect = @mysql_connect(hostnameorservername,serverusername,serverpassword) or die('Connection could not be made to the SQL Server.');
@mysql_select_db(databasenamed,$v_connect) or die('Connection could not be made to the database.');




/* 
------------ DATABASE TABLE INFORMATION ----------------

You can only change the below settings only if you wish
*/


// Your Website URL without ending slash
$vpb_your_website_url = "http://v-yukti.com/usa-school/"; // Change this to your domain URL where the chat system is placed


/*
* If you intend to disable the chat temporarilly may 
* be for maintenance purpose then set this to TRUE */
$DISABLE_CHAT_TEMPORARILY = FALSE; 
/* 
*Set "TRUE" to disable chat and set "FALSE" to allow chat. */



/* 
* If you don't want your users to only chat with their friends 
* but to chat generally with all the people or users in the system then
* disable the friends table below by setting it to TRUE
* otherwise set it to FALSE to allow users chat only with friends
* If your website is not the one where users can make friend
* or people that they have added as friends on your website
* which are saved in this table.
* Set this to TRUE to disable friends Table if you wish. */
$DISABLE_FRIENDS_TABLE = FALSE;
/*
* But for you to use this friends table then you 
* should have a means of allowing your users
* to make friends on your website and then
* save their data in this table when they
* become friends so that the chat system can use it. */


/* Full path to the image directory for the chat system */
$VPB_FULL_PATH_TO_CHAT_IMAGE_DIRECTORY = $vpb_your_website_url."/vasplus_chat/images/";

/* Short path to the image directory for the chat system */
$VPB_SHORT_PATH_TO_CHAT_IMAGE_DIRECTORY = $vpb_your_website_url."vasplus_chat/images/";


/* Full path to the attachment directory for the chat system */
$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DIRECTORY = $vpb_your_website_url."/vasplus_chat/vpb_chat_attachments/";

/* Direct path to the attachment directory for the chat system */
$VPB_DIRECT_PATH_TO_CHAT_ATTACHMENT_DIRECTORY = "vpb_chat_attachments/";

/* Full path to the attachment download file */
$VPB_FULL_PATH_TO_CHAT_ATTACHMENT_DOWNLOAD_FILE = $vpb_your_website_url."/vasplus_chat/vpb_chat_d_load.php";


/* Full path to the smileys directory for the chat system */
$VPB_FULL_PATH_TO_CHAT_SMILEYS_DIRECTORY = $vpb_your_website_url."/vasplus_chat/smileys/";

/* Short path to the smileys directory for the chat system */
$VPB_SHORT_PATH_TO_CHAT_SMILEYS_DIRECTORY = "vasplus_chat/smileys/";


/* 
* Here you can specify the name of your 
* database users table if you do not want to use
* the users table that came with the chat syste. */
$NAME_OF_YOUR_USERS_TABLE = 'vpb_users';
/*
* If you specify a new table above then read
* the information given below and also
* specify them as well otherwise, no need to proceed. */



/*
* If you have specified a new name for your users
* table above then specify the column name for your
* users fullnames as it is on the table you have specified
* above otherwise, leave it as it is if you did not
* specify any new name for your users table. */
$COLUMN_NAME_FOR_USERS_FULLNAME = "fullname";
/*
* If you have specified new users table above and that 
* table does not have a column for users fullnames
* then un-comment the query below which will add a column for 
* fullname to your table and when users sign up on your website,
* always see that you insert their fullnames into
* this column because that's where the fullnames
* of your users will be gotten for the chat. 
* If you un-comment the query below, please comment it back 
* once you discover that the column for fullname has
* been added to your table. */
// mysql_query("ALTER TABLE `".$NAME_OF_YOUR_USERS_TABLE."` ADD `".$COLUMN_NAME_FOR_USERS_FULLNAME."` varchar(200) NOT NULL");



/*
* If you have specified a new name for your users
* table above then specify the column name for your
* users usernames as it is on the table you have specified
* above otherwise, leave it as it is if you did not
* specify any new name for your users table. */
$COLUMN_NAME_FOR_USERS_USERNAMES = "username";
/*
* If you have specified new users table above and that 
* table does not have a column for users usernames
* then un-comment the query below which will add a column for 
* username to your table and when users sign up on your website,
* always see that you insert their usernames into
* this column because that's where the usernames
* of your users will be gotten for the chat. 
* If you un-comment the query below, please comment it back 
* once you discover that the column for username has
* been added to your table. */
// mysql_query("ALTER TABLE `".$NAME_OF_YOUR_USERS_TABLE."` ADD `".$COLUMN_NAME_FOR_USERS_USERNAMES."` varchar(200) NOT NULL");




/*
* If you have specified a new name for your users
* table above then specify the column name for your
* users photos as it is on the table you have specified
* above otherwise, leave it as it is if you did not
* specify any new name for your users table. */
$COLUMN_NAME_FOR_USERS_PHOTOS = "photo";
/*
* If you have specified new users table above and that 
* table does not have a column for users photos
* then un-comment the query below which will add a column for 
* photo to your table and when users sign up or add photo to
* their account on your website,
* always see that you insert their photos into
* this column because that's where the photos
* of your users will be gotten for the chat. 
* If you un-comment the query below, please comment it back 
* once you discover that the column for photo has
* been added to your table. */
// mysql_query("ALTER TABLE `".$NAME_OF_YOUR_USERS_TABLE."` ADD `".$COLUMN_NAME_FOR_USERS_PHOTOS."` varchar(200) NOT NULL");



/*
* Please specify the path to the directory where
* your users photos is placed so that the chat
* system can use it but if you are using the default
* photo directory that came with the chat system
* then leave this photo field as it it. */
$VPB_FULL_PATH_TO_USERS_PHOTOS_DIRECTORY = $vpb_your_website_url."/vasplus_chat/photos/";



?>
