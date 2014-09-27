<?php
/*
 * Wsapis_model
 * 
 * @author BG
 */
class Wsapis_model extends CI_Model {

   	public function __construct()
   	{
		parent::__construct();
		
		$this->load->model('common_model');
	}

	public function UploadTouristVideo() {
		$result = array('result'=>'failed', 'error'=>'Failed to upload video.');
		
		$str_cardId = isset($_GET['cardId'])?$_GET['cardId']:'';
		if ($str_cardId == '')
		{
			return $result;
		}
		
		$ext = 'mov';
		$str_newfilename = $this->common_model->GenerateSalt( 8 ).".mov";
		while (file_exists(ABS_VIDEO_PATH.$str_newfilename)) {
			$str_newfilename = $this->common_model->GenerateSalt( 8 ).".mov";
			Sleep(1);
		}
		
		if (!move_uploaded_file($_FILES['videoFile']['tmp_name'], ABS_VIDEO_PATH.$str_newfilename))
			return $result;
		
		$str_sql = "SELECT ardata_id FROM golive_card WHERE id=?";
		$result = $this->db->query( $str_sql, array ($str_cardId) )->result();
		$str_arId = $result[0]->ardata_id;
		
		$str_sql = "UPDATE golive_ardata SET video_url=? WHERE id=?";
		$this->db->query($str_sql, array($str_newfilename, $str_arId));
		
		$result = array('result'=>'success', 'error'=>'Success upload video file.');
		return $result;
	}
	
	public function ExportCSV() 
	{
		$str_sql = "
				SELECT 
					ct.id id,
					ct.qrcode as qrcode,
					ct.qrcode_link as qrcodeLink,
					ct.note as note,
					ct.card_type as cardType,
					ct.postal_address as postalAddress,
					ct.postal_code as postalCode,
					ct.receipt_city as receiptCity,
					ct.receipt_country as receiptCountry,
					IFNULL(art.target_id, '') as targetId,
					IFNULL(art.metadata, '') as metadata,
					IFNULL(art.target_type, '') as targetType,
					IFNULL(art.cover_photo_link, '') as coverPhotoLink,
					IFNULL(art.video_url, '') as videoUrl,
					ut.email email
				FROM 
					golive_card ct
				LEFT JOIN
					golive_ardata art
					ON ct.ardata_id = art.id
				LEFT JOIN
					golive_user ut
					ON ut.id=ct.user_id
				";
		$ptr_array = $this->db->query( $str_sql )->result();
		$ptr_header = array ('Unique ID', 'QR Code', 'QR Code Link', 'Note',	'Card Category','Target ID', 'Metadata', 'Target Type',	'Cover Photo Link',	'Video URL','Transaction ID','Transaction Date','Payment Method','Amount','Promo Status','Postal Address','Postal Code','Receiptant City','Receiptant Country');
		$ptr_data = array ();
		$i = 0;
		foreach ($ptr_array as $k => $v) 
		{
			$ptr_data[$i] = array (
					$v->id,	$v->qrcode, $v->qrcodeLink, $v->note, $v->cardType=='1'?'Tourist':($v->cardType=='2'?'Custom':'Category'),
					$v->targetId, $v->metadata, $v->targetType, HTTP_MARKER_PATH.$v->coverPhotoLink, HTTP_VIDEO_PATH.$v->videoUrl, $v->transactionId, $v->transactionDate, $v->paymentMethod, $v->amount, $v->promoStatus, $v->postalAddress, $v->postalCode, $v->receiptCity, $v->receiptCountry 
			);
			$i ++;
		}
		
		$str_csvname = $this->common_model->writeCSV( $ptr_header, $ptr_data );
		return HTTP_EXPORT_BASE.$str_csvname;
	}
	
	public function ExportCSVFile()
	{
		$str_sql = "
				SELECT
					ct.id id,
					ct.qrcode as qrcode,
					ct.qrcode_link as qrcodeLink,
					ct.note as note,
					ct.card_type as cardType,
					ct.postal_address as postalAddress,
					ct.postal_code as postalCode,
					ct.receipt_city as receiptCity,
					ct.receipt_country as receiptCountry,
					IFNULL(art.target_id, '') as targetId,
					IFNULL(art.metadata, '') as metadata,
					IFNULL(art.target_type, '') as targetType,
					IFNULL(art.cover_photo_link, '') as coverPhotoLink,
					IFNULL(art.video_url, '') as videoUrl,
		            IFNULL(cart.prefilmed, '') prefilmed, 
					ut.email email
				FROM
					golive_card ct
				LEFT JOIN
					golive_ardata art
					ON ct.ardata_id=art.id
				LEFT JOIN
					golive_user ut
					ON ut.id=ct.user_id
				LEFT JOIN
					(SELECT 
						cat.id as id, 
						art.video_url as prefilmed 
					FROM 
						golive_category cat 
					LEFT JOIN 
						golive_ardata art 
						ON cat.ardata_id=art.id) cart
					ON cart.id=ct.category_id
				";
		$ptr_array = $this->db->query( $str_sql )->result();
		$ptr_header = array ('Unique ID', 'QR Code', 'QR Code Link', 'Note',	'Card Category','Target ID', 'Metadata', 'Target Type',	'Cover Photo Link',	'Video URL','Transaction ID','Transaction Date','Payment Method','Amount','Promo Status','Postal Address','Postal Code','Receiptant City','Receiptant Country');
		$ptr_data = array ();
		$i = 0;
		foreach ($ptr_array as $k => $v)
		{
			$ptr_data[$i] = array (
					$v->id,	$v->qrcode, $v->qrcodeLink, $v->note, $v->cardType=='1'?'Tourist':($v->cardType=='2'?'Custom':'Category'),
					$v->targetId, $v->metadata, $v->targetType, HTTP_MARKER_PATH.$v->coverPhotoLink, HTTP_VIDEO_PATH.$v->videoUrl, $v->transactionId, $v->transactionDate, $v->paymentMethod, $v->amount, $v->promoStatus, $v->postalAddress, $v->postalCode, $v->receiptCity, $v->receiptCountry
			);
			$i ++;
		}
	
		$str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
		//return HTTP_EXPORT_BASE.$str_csvname;
	}
    
    public function AddNewCategoryCard()
    {
    	$result = array( 'result'=>'failed', 'error'=>'Invalid arguments' );
    	
    	$str_note               = isset( $_POST['note'] ) ? $_POST['note']:'';
    	$str_postalAddress      = isset( $_POST['postalAddress'] ) ? $_POST['postalAddress']:'';
    	$str_postalCode         = isset( $_POST['postalCode'] ) ? $_POST['postalCode']:'';
    	$str_receiptCity        = isset( $_POST['receiptCity'] ) ? $_POST['receiptCity']:'';
    	$str_receiptCountry     = isset( $_POST['receiptCountry'] ) ? $_POST['receiptCountry']:'';
    	$str_categoryId			= isset( $_POST['categoryId'] ) ? $_POST['categoryId']:'';
    	
    	$str_targetId 			= isset( $_POST['targetId']) ? $_POST['targetId'] : '';
    	 
    	// Get ARData Id
     	/* $str_sql = "SELECT ardataId FROM category_tbl WHERE id=?";
     	$result = $this->db->query( $str_sql, array( $str_categoryId ) )->result();
     	$str_ardataId = $result[0]->ardataId; */
     	
    	// Add new cloud target
    	$str_ardataId = '';
    	
    	$str_sql = "INSERT INTO golive_ardata ( target_id, target_type, created_at, updated_at ) VALUES ( ?, '1', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
    	$this->db->query( $str_sql, array( $str_targetId ) );
    	$str_ardataId = $this->db->insert_id();
    	
    	// upload video file
    	$str_newvideoname = $this->common_model->GenerateSalt( 8 ).".mov";
    	while (file_exists(ABS_VIDEO_PATH . $str_newvideoname)) {
    		$str_newvideoname = $this->common_model->GenerateSalt( 8 ).".mov";
    		Sleep(1);
    	}
    	
    	if (!move_uploaded_file($_FILES['videoFile']['tmp_name'], ABS_VIDEO_PATH.$str_newvideoname)) {
    		$result = array( 'result'=>'failed', 'error'=>'Failed to upload video file.' );
    		return $result;
    	}
    	
    	// Insert new line to the ardata_tbl
    	$str_sql = "UPDATE golive_ardata SET cover_photo_link=? WHERE id=?"; //, videoUrl
    	$this->db->query( $str_sql, array( $str_newPhotoName, $str_ardataId ) ); // , $str_newvideoname
    	
    	// Generate QR code
    	$str_url = HTTP_QRCODE_BASE . "asyncQRCodeGenerate.php";
    	
    	// Check dupilcated qrcode
    	$str_sql = "SELECT count(*) cnt FROM golive_card WHERE qrcode=?";
    	$str_alphaQR = $this->common_model->GenerateSalt( 5, 1 );
    	$ret_array = $this->db->query( $str_sql, array( $str_alphaQR ))->result();
    	while ( $ret_array[0]->cnt * 1 > 0 ) {
    		$str_alphaQR = $this->common_model->GenerateSalt( 5, 1 );
    		$ret_array = $this->db->query( $str_sql, array( $str_alphaQR ))->result();
    		usleep( 10 );
    	}
    	
    	$ptr_params = array (
    			'sdata' => $str_alphaQR
    	);
    	
    	$json_qrcode = json_decode ( $this->common_model->httpPOST( $str_url, $ptr_params) );
    	
    	if ( $json_qrcode->result == 'failed') {
    		$result = array( 'result'=>'failed', 'error'=>'Failed to generate goLiveCard code' );
    		return $result;
    	}
    	
    	$str_qrcodeLink = $json_qrcode->filename;
    	
    	$str_sql = "INSERT INTO golive_card (ardata_id, qrcode, qrcode_link, note, created_at, updated_at, card_type, postal_address, postal_code, receipt_city, receipt_country)
                    VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '3', ?, ?, ?, ?)";
    	
    	$this->db->query( $str_sql, array(
    			$str_ardataId,
    			$str_transId,
    			$str_alphaQR,
    			$str_qrcodeLink,
    			$str_note,
    			$str_postalAddress,
    			$str_postalCode,
    			$str_receiptCity,
    			$str_receiptCountry,
    	));
    	
    	$result = array( 'result'=>'success', 'error'=>'Added successfully!' );
    	
    	return $result;
    }
    
    public function GetCategoryList() 
    {
    	$str_sql = "
    			SELECT 
					ct.*, 
					atb.target_id as targetId,
					atb.metadata metadata,
					atb.target_type as targetType,
					atb.cover_photo_link as coverPhotoLink,
					atb.video_url as videoUrl,
					atb.updated_at as lastModified
				FROM 
					golive_category ct
				LEFT JOIN 
					golive_ardata atb 
				ON 
					ct.ardata_id=atb.id
    			";
    	$ret_array = $this->db->query( $str_sql )->result();
    	return $ret_array;
    }
}
