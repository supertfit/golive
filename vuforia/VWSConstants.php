<?php
/*
 ************************************************************************
* @filename		: VWSConstants.php
* @description	: 
* Created on 	: Aug 21, 2014 4:01:34 PM
* Created by	: KCH
*************************************************************************
*/
define('VWSAPI_SERVER_ACCESSKEY', '87bf061a69410d793a10c87231166e9282f1e25e');
define('VWSAPI_SERVER_SECRETKEY', '219424f87a6094918314d9ff5855d05d2f5898f1');
define('VWSAPI_SERVER_PATH', 'https://vws.vuforia.com');

function print_log( $str_log )
{
	// open file
	$fd = fopen('backend1.log', "a");
	// append date/time to message
	$str = "[" . date('Y-m-d H:i:s', time()) . "] : " . $str_log;
	// write string
	fwrite($fd, $str . "\n");
	// close file
	fclose($fd);
}
/* End of file VWSConstants.php */
?>