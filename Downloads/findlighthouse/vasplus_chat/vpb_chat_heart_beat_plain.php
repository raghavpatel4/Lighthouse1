<?php
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
@header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
@header("Cache-Control: no-cache, must-revalidate" ); 
@header("Pragma: no-cache" );
@header("Content-type: text/html;charset=utf-8");
set_time_limit(0);


 // Turn off output buffering
@ini_set('output_buffering', 'off');
// Turn off PHP output compression
@ini_set('zlib.output_compression', false);
// Implicitly flush the buffer(s)
@ini_set('implicit_flush', true); 
ob_implicit_flush(true);


// Clear, and turn off output buffering
while (ob_get_level() > 0) {
    // Get the curent level
    $level = ob_get_level();
    // End the buffering
    ob_end_clean();
    // If the current level has not changed, abort
    if (ob_get_level() == $level) break;
}
// Disable apache output buffering/compression
if (function_exists('apache_setenv')) {
    @apache_setenv('no-gzip', '1');
    @apache_setenv('dont-vary', '1');
}

if (ob_get_level() == 0) ob_start();


$vpb_new_data = rand(1234567890, 0987654321);

// return a json array
$response = array();
$response['msg'] = $vpb_new_data;
$response['timestamp'] = time();
echo json_encode($response);
clearstatcache();
ob_flush();
flush();
sleep(1);

ob_end_flush();
?>