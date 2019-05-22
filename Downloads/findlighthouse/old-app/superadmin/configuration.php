<?php
	/*$db_selected = mysqli_select_db($link, 'admin-demo');
	if (!$db_selected) {
	    die ('Can\'t use admin-demo : ' . mysql_error());
	}*/
		$webUrl = "http://findlighthouse.com/";
		date_default_timezone_set('US/Eastern');

		define('DB_NAME', 'sunny191_usaschool');
		define('DB_USER', 'sunny1910');
		define('DB_PASS', 'DoStatgol@765');
		define('DB_HOST', 'localhost');

		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		function seoUrl($string) {
		    //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
		    $string = strtolower($string);
		    //Strip any unwanted characters
		    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		    //Clean multiple dashes or whitespaces
		    $string = preg_replace("/[\s-]+/", " ", $string);
		    //Convert whitespaces and underscore to dash
		    $string = preg_replace("/[\s_]/", "-", $string);
		    return $string;
		}
		
		function getLogin($username, $password) {
			global $link;
		    $whereSQL = '';
		    $rows = array();
		    $sql = "select * FROM `tbl_admin` WHERE `username` = '".$username."' AND `password` = '".md5($password)."'";
			$rs = mysqli_query($link, $sql);
			$form_data = mysqli_fetch_assoc($rs);
		    //echo '<pre>'; print_r($form_data);echo '</pre>';die;
		    if(count($form_data) > 0) {
		    	@session_start();
		    	$_SESSION['admin_id'] = $form_data['id'];
		    	$_SESSION['user_id'] = $form_data['id'];
		    	$_SESSION['from_username'] = $form_data['id'];
		    	$_SESSION['id'] = $form_data['id'];
		    	/*foreach($form_data as $keys => $vals) {
					$_SESSION[$keys] = $vals;
				}*/
				//echo '<pre>'; print_r($form_data);echo '</pre>';
				//echo '<pre>'; print_r($_SESSION);echo '</pre>';die;
		    	//$_SESSION[''] = $form_data[][]
		    	
		        return 1;
		    } else {
				return 0;
			}
		}
		
	    function dbRowInsert($table_name, $form_data) {
	    	global $link;
		    $fields = array_keys($form_data);
		    $sql = "INSERT INTO ".$table_name." (`".implode('`,`', $fields)."`) VALUES ('".implode("','", $form_data)."')";
		    //echo $sql;die;
		    $rs = mysqli_query($link, $sql);
		    return mysqli_insert_id($link);
		}
		function dbRowDelete($table_name, $where_clause='') {
			global $link;
		    $whereSQL = '';
		    if(!empty($where_clause)) {
		        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
		            $whereSQL = " WHERE ".$where_clause;
		        } else {
		            $whereSQL = " ".trim($where_clause);
		        }
		    }
		    $sql = "DELETE FROM ".$table_name.$whereSQL;
		    return mysqli_query($link, $sql);
		}
		
		function dbRowUpdate($table_name, $form_data, $where_clause='') {
			global $link;
		    $whereSQL = '';
		    if(!empty($where_clause)) {
		        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
		            $whereSQL = " WHERE ".$where_clause;
		        } else {
		            $whereSQL = " ".trim($where_clause);
		        }
		    }
		    $sql = "UPDATE ".$table_name." SET ";

		    $sets = array();
		    foreach($form_data as $column => $value) {
		         $sets[] = "`".$column."` = '".$value."'";
		    }
		    $sql .= implode(', ', $sets);
		    $sql .= $whereSQL;

		    return mysqli_query($link, $sql);
		}
		function getRowResult($table_name, $where_clause = '', $orderDesc = 1) {
			global $link;
		    $whereSQL = '';
		    $i = 0;
		    $rows = array();
		    if(!empty($where_clause)) {
		        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
		            $whereSQL = " WHERE ".$where_clause;
		        } else {
		            $whereSQL = " ".trim($where_clause);
		        }
		    }
		    if($orderDesc == 1) {
				$oderList = ' desc';
			} else {
				$oderList = ' asc';
			}
		    $sql = "select * FROM ".$table_name.$whereSQL." order by `id` ".$oderList;
		    //echo $sql;
			$rs = mysqli_query($link, $sql);
			
		    for($j = 0; $form_data = mysqli_fetch_assoc($rs); $j++) {
			    foreach($form_data as $keys => $value) {
			         $rows[$j][$keys] = $value;
			    }
			}
		    return $rows;
		}
		function getCustomResult($sql) {
			global $link;
		    $i = 0;
		    $rows = array();
			//echo $sql;
			$rs = mysqli_query($link, $sql);
			
		    for($j = 0; $form_data = mysqli_fetch_assoc($rs); $j++) {
			    foreach($form_data as $keys => $value) {
			         $rows[$j][$keys] = $value;
			    }
			}
		    return $rows;
		}
		
		function getCountryName($country_id) {
			$sql = "select * from `vpb_country` WHERE `country_id` = '".$country_id."'";
			//echo $sql;
			$rsArr = getCustomResult($sql);
			//echo '<pre>';print_r($rsArr);
			return $rsArr[0]['country_name'];
		}
		
		function getSchoolName($school_id) {
			$sql = "select * from `vpb_school` WHERE `id` = '".$school_id."'";
			//echo $sql;
			$rsArr = getCustomResult($sql);
			//echo '<pre>';print_r($rsArr);
			return $rsArr[0]['title'];
		}
	
	//$data_arr = new connFunctions;
?>