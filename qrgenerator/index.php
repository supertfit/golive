<?php    
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
    /* if (isset($_POST['level']) && in_array($_POST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_POST['level'];    */ 

    $matrixPointSize = 10;
    /* if (isset($_POST['size']))
        $matrixPointSize = min(max((int)$_POST['size'], 1), 10); */


    if (isset($_POST['sdata'])) { 
    
        //it's very important!
        if (trim($_POST['sdata']) == '') {
        	$result = array('result'=>'failed', 'error'=>'Invalid Data.');
            die(json_encode($result));
        }
            
        // user data
        $filename = $PNG_TEMP_DIR.md5($_POST['sdata'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
		/* if (file_exists($filename)) {
			$result = array('result'=>'failed', 'error'=>'QR Code already exist.');
			die(json_encode($result));
		} */
        QRcode::png($_POST['sdata'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        $result = array('result'=>'success', 'filename'=>basename($filename));
        die(json_encode($result));
    }
    
    die( json_encode ($result) );
?>