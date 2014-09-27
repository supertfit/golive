<?php
class Common_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function GenerateSalt($length = 32, $capital = 0) {
	    if ($capital == 0) {
		    $str_characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    } else {
	        $str_characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    }
		$str_rndstring = '';
		for ($i = 0; $i < $length; $i ++) {
			$str_rndstring .= $str_characters[rand(0, strlen($str_characters) - 1)];
		}
		
		return $str_rndstring;
	}
	
	function print_log( $str_log )
	{
		// open file
		$fd = fopen('backend.log', "a");
		// append date/time to message
		$str = "[" . date('Y-m-d H:i:s', time()) . "] : " . $str_log;
		// write string
		fwrite($fd, $str . "\n");
		// close file
		fclose($fd);
	}
	
	function httpPOST( $str_url, $ptr_params ) {
		$ch = curl_init();
		
		$str_params = '';
		if ( $ptr_params != null ) {
			$i = 0;
			foreach ( $ptr_params as $k => $v ) 
			{
				if ( $i == 0 ) 
				{
					$str_params .= $k."=".$v;
				}
				else 
				{
					$str_params .= "&$k=$v";			
				}
				$i ++;
			}
		}
		
		curl_setopt( $ch, CURLOPT_URL, $str_url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $str_params );
		
		$str_output = curl_exec($ch);
		
		curl_close($ch);
		
		return $str_output;
	}
	
	function httpGET( $str_url ) {
		$ch = curl_init();
		
		curl_setopt( $ch, CURLOPT_URL, $str_url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_POST, false );
		
		$str_output =curl_exec($ch);
		
		curl_close($ch);
		
		return $str_output;
	}
	
	function writeCSV( $ptr_header, $ptr_data ) 
	{
		$ptr_date = new DateTime();
		$str_scvname = $this->GenerateSalt(3).'_'.$ptr_date->format('YmdHis').'.csv';
		$fp = fopen( ABS_EXPORT_PATH.$str_scvname, 'w');
		
		fputcsv($fp, $ptr_header);
		
		foreach ( $ptr_data as $line ) 
		{
			fputcsv( $fp, $line);
		}
		
		fclose ($fp);
		
		return $str_scvname;
	}
	
	function writeCSVFile( $ptr_header, $ptr_data )
	{
		$ptr_date = new DateTime();
		$str_scvname = $this->GenerateSalt(3).'_'.$ptr_date->format('YmdHis').'.csv';
		$fp = fopen( ABS_EXPORT_PATH.$str_scvname, 'w');

		fputcsv($fp, $ptr_header);
		
		foreach ( $ptr_data as $line ) 
		{
			fputcsv( $fp, $line);
		}
		
		fclose ($fp);
		
		header('Content-Type: application/download');
		header('Content-Disposition: attachment; filename="'. $str_scvname .'"');
		header("Content-Length: " . filesize( ABS_EXPORT_PATH.$str_scvname ));
		
		$fp = fopen( ABS_EXPORT_PATH.$str_scvname, "r");
		fpassthru($fp);
		fclose($fp);
	}
	
	function sendMail($email, $body, $subject, $name = 'goLive')
	{
	    // send verification email
	    $config = array(
	                    'protocol' 		=> EMAIL_PROTOCOL,
	                    'smtp_host' 	=> EMAIL_SMTP_HOST,
	                    'smtp_port' 	=> EMAIL_SMTP_PORT,
	                    'smtp_crypto' 	=> EMAIL_SMTP_CRYPTO,
	                    'smtp_user' 	=> EMAIL_SMTP_USER,
	                    'smtp_pass' 	=> EMAIL_SMTP_PASS,
	                    'mailtype'  	=> EMAIL_MULTITYPE,
	                    'charset'   	=> EMAIL_CHARSET
	    );
	    $this->load->library('phpmailer/phpmailer');
	    $mail = new PHPMailer();
	    
	    $mail->IsSMTP(); 				// telling the class to use SMTP
	    $mail->SMTPDebug = 1;           // enables SMTP debug information (for testing)
	    // 1 = errors and messages
	    // 2 = messages only
	    $mail->SMTPAuth   = true;                    // enable SMTP authentication
	    $mail->SMTPSecure = "ssl";                   // sets the prefix to the servier
	    $mail->Host       = "smtp.gmail.com";        // sets GMAIL as the SMTP server
	    $mail->Port       = 465;                     // set the SMTP port for the GMAIL server
	    $mail->Username   = EMAIL_SMTP_USER;  		 // GMAIL username
	    $mail->Password   = EMAIL_SMTP_PASS;         // GMAIL password
	    
	    $mail->SetFrom(EMAIL_SMTP_USER, 'goLive Support Team');
	    $mail->Subject = $subject;
	    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
	    $mail->MsgHTML($body);

	    $mail->AddAddress($email, $name);
	    	
	    if(!$mail->Send()) {
	        $this->common_model->print_log ("Mailer Error: " . $mail->ErrorInfo);
	    }
	}
	
	function generateQrCode()
	{
	    $qrcode = $this->GenerateSalt(5, 1);
	    $sql = "SELECT count(*) cnt 
	              FROM ( SELECT qrcode FROM golive_card UNION ALL SELECT qrcode FROM golive_category) t1 
	             WHERE qrcode = ?";
	    
	    $return = $this->db->query( $sql, array( $qrcode ))->result();
	    
	    while ( $return[0]->cnt * 1 > 0 ) {
	        $qrcode = $this->GenerateSalt(5, 1);
	        $return = $this->db->query( $sql, array( $qrcode ))->result();
	        usleep( 10 );
	    }
	    return $qrcode;
	}
	
	function getCardType() {
	    return array('1' => 'Tourist', '2' => 'Custom', '3' => 'Category', '' => '');
	}
	function getTargetType() {
	    return array('1' => 'Cloud', '2' => 'Device', '' => '');
	}
	function getDefaultCardType() {
	    return array(1 => 'Category', 2 => 'Tourist');
	}
	function getDealType() {
	    return array(1 => 'Credits Discount', 2 => 'Credits Bonus', 3 => 'Free Credits', 4 => 'Purchase Discount', 5 => 'Purchase Bonus', 6 => 'Free Purchase');
	}
}