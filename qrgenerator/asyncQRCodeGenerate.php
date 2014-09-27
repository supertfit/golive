<?php
/********************************************************************************************
 * Page				: Ajax - QR Code Generator
 * Author			: KCH
 * ------------------------------------------------------------------------------------------
 * File Name		: file_name
 * Description		: Generate QR Code and return result with json
 * Date				: Aug 23, 2014 5:04:02 PM
 * Version			: 1.0
 ********************************************************************************************/
//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = $_SERVER['DOCUMENT_ROOT']."/assets/qrcodes/";
//header('ContentType: application/json');
include "qrlib.php";

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
	mkdir($PNG_TEMP_DIR);

$filename = "";

$filename = $PNG_TEMP_DIR.'test.png';

$result = array('result'=>'failed', 'error'=>'Failed to generate QR Code.');

$errorCorrectionLevel = 'M';

$matrixPointSize = 10;

if (isset($_POST['sdata'])) {

	//it's very important!
	if (trim($_POST['sdata']) == '') {
		$result = array('result'=>'failed', 'error'=>'Invalid Data.');
		die(json_encode($result));
	}

	// user data
	$filename = $PNG_TEMP_DIR.md5($_POST['sdata'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	
	QRcode::png($_POST['sdata'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
	$result = array('result'=>'success', 'filename'=>basename($filename));
	die(json_encode($result));
}

die( json_encode ($result) );
 ?>