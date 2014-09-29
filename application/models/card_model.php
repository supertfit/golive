<?php 
 class Card_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function detail($cardId) {
		$str_sql = "
            SELECT card.*
                 , user.first_name
		         , user.last_name
                 , user.email
                 , ifnull(category.category_prefilm_url, '') as category_prefilm_url
		         , ifnull(category.category_cover_photo_url, '') as category_cover_photo_url       
		         , ifnull(category.category_name, '') as category_name
              FROM golive_card card
              LEFT JOIN golive_user user ON card.user_id = user.id
              LEFT JOIN (
            	SELECT id
            	     , prefilm_url as category_prefilm_url
		             , name as category_name
		             , cover_photo_url as category_cover_photo_url
            	  FROM golive_category
            	) category ON card.category_id = category.id	                
		     WHERE card.id = ?";
		$result = $this->db->query($str_sql, $cardId)->result();
		return $result[0];
	}
	
	public function all($card_type = 1) {
		$str_sql = "
            SELECT card.*
                 , user.first_name
		         , user.last_name
                 , user.email
                 , ifnull(category.category_prefilm_url, '') as category_prefilm_url
		         , ifnull(category.category_cover_photo_url, '') as category_cover_photo_url       
		         , ifnull(category.category_name, '') as category_name
                 , t3.name as tourist_category_name
		         , t4.name as tourist_subcategory_name		                     
              FROM golive_card card
              LEFT JOIN golive_user user ON card.user_id = user.id
              LEFT JOIN (
            	SELECT id
            	     , prefilm_url as category_prefilm_url
		             , name as category_name
		             , cover_photo_url as category_cover_photo_url
            	  FROM golive_category
            	) category ON card.category_id = category.id
              LEFT JOIN golive_tourist_category t3 ON card.tourist_category_id = t3.id
              LEFT JOIN golive_tourist_subcategory t4 ON card.tourist_subcategory_id = t4.id			                
		     WHERE card.card_type = ?";
		$result = $this->db->query( $str_sql, $card_type )->result();
	    return $result;
	}
	
    public function exportCSV($cardType = 1) {
        $arr_target_type = $this->common_model->getTargetType();
        $arr_card_type = $this->common_model->getCardType();
        
        $result = $this->all($cardType);
        
        if ($cardType == 1) {
            $ptr_header = array ('ID', 'Name', 'QR Code', 'QR Code Link', 'Target ID', 'Cover Image', 'Prefilm', 'Video', 'Added On', 'Played On', 'Created On');
            $ptr_data = array ();
            foreach ($result as $k => $v)
            {
                $ptr_data[] = array (
                                $v->id,	$v->name, $v->qrcode, HTTP_QRCODE_PATH.$v->qrcode_link, $v->target_id,
                                HTTP_MARKER_PATH.$v->category_cover_photo_url, HTTP_VIDEO_PATH.$v->prefilm_url, HTTP_VIDEO_PATH.$v->video_url,
                                $v->assigned_at, $v->played_at, $v->created_at);
            }
            $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
        } elseif ($cardType == 2) {
            $ptr_header = array ('ID', 'QR Code', 'QR Code Link', 'Postal Address', 'Postal Code', 'Receipt City', 'Receipt State','Receipt Country',
                                 'Note', 'Target Id', 'Target Type', 'Cover Image', 'Video', 'Played On', 'Sender Name', 'Sender Email', 'Created On');
            $ptr_data = array ();
            foreach ($result as $k => $v)
            {
                $ptr_data[] = array (
                                $v->id,	$v->qrcode, HTTP_QRCODE_PATH.$v->qrcode_link, $v->postal_address, $v->postal_code,
                                $v->receipt_city, $v->receipt_state, $v->receipt_country, $v->note, $v->target_id, $arr_target_type[$v->target_type],
                                HTTP_MARKER_PATH.$v->cover_photo_url, HTTP_VIDEO_PATH.$v->video_url,
                                $v->played_at, $v->first_name." ".$v->last_name, $v->email, $v->created_at);
            }
            $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );            
        } elseif ($cardType == 3) {
            $ptr_header = array ('ID', 'Category Name','QR Code', 'QR Code Link', 'Postal Address', 'Postal Code', 'Receipt City', 'Receipt State','Receipt Country',
                                'Note', 'Target Id', 'Target Type', 'Cover Image', 'Prefilm', 'Video', 'Played On', 'Sender Name', 'Sender Email', 'Created On');
            $ptr_data = array ();
            foreach ($result as $k => $v)
            {
                $ptr_data[] = array (
                                $v->id,	$v->category_name, $v->qrcode, HTTP_QRCODE_PATH.$v->qrcode_link, $v->postal_address, $v->postal_code,
                                $v->receipt_city, $v->receipt_state, $v->receipt_country, $v->note, $v->target_id, $arr_target_type[$v->target_type],
                                HTTP_MARKER_PATH.$v->category_cover_photo_url, HTTP_VIDEO_PATH.$v->category_prefilm_url, HTTP_VIDEO_PATH.$v->video_url,
                                $v->played_at, $v->first_name." ".$v->last_name, $v->email, $v->created_at);
            }
            $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );            
        }
        
        
    }   
	
	public function delete($cardId) {
	    $str_sql = "DELETE FROM golive_card WHERE id = ?";
	    $this->db->query( $str_sql, $cardId );
	}
	
	public function saveTourist() {
        $card_id = isset($_POST['card_id']) ? $_POST['card_id'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
        $sub_category_id = isset($_POST['sub_category_id']) ? $_POST['sub_category_id'] : 0;
        $qrcode = isset($_POST['qrcode']) ? $_POST['qrcode'] : '';
        $target_id = isset($_POST['target_id']) ? $_POST['target_id'] : '';
        $target_rate = isset($_POST['target_rate']) ? $_POST['target_rate'] : -1;
        $target_type = isset($_POST['target_type']) ? $_POST['target_type'] : '1';
        $prefilm_url = isset($_POST['prefilm_url']) ? $_POST['prefilm_url'] : '';
        $cover_photo_url = isset($_POST['cover_photo_url']) ? $_POST['cover_photo_url'] : '';
        $metadata = "";
    
        $ptr_date = new DateTime();
        if ($_FILES["prefilmVideo"]['name'] != '') {
            $ext = 'mov';
            $prefilm_url = $this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".$ext";
            if (!move_uploaded_file($_FILES['prefilmVideo']['tmp_name'], ABS_VIDEO_PATH.$prefilm_url))
                $prefilm_url = '';
        }
    
        if ($_FILES["coverImage"]['name'] != '') {
            $ext = pathinfo( $_FILES['coverImage']['name'] )['extension'];
            $cover_photo_url = $this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".$ext";
            if (!move_uploaded_file($_FILES['coverImage']['tmp_name'], ABS_MARKER_PATH.$cover_photo_url))
                $cover_photo_url = '';
    
            if ($cover_photo_url != '') {
                $destFile = $this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".$ext";
                list($width, $height) = getimagesize(ABS_MARKER_PATH.$cover_photo_url);
                if ($ext == "jpg" || $ext == "jpeg") {
                    $src = imagecreatefromjpeg( HTTP_MARKER_PATH.$cover_photo_url );
                    $dest = imagecreatetruecolor( COVER_IMAGE_WIDTH, COVER_IMAGE_HEIGHT );
                    imagecopyresized($dest, $src, 0, 0, 0, 0, COVER_IMAGE_WIDTH, COVER_IMAGE_HEIGHT, $width, $height);
                    header('Content-Type: image/jpeg');
                    imagejpeg($dest, ABS_MARKER_PATH.$destFile, 100);
                    imagedestroy($dest);
                    imagedestroy($src);
                    $cover_photo_url = $destFile;
                } elseif ($ext == "png"){
                    $src = imagecreatefrompng( HTTP_MARKER_PATH.$cover_photo_url );
                    $dest = imagecreatetruecolor( COVER_IMAGE_WIDTH, COVER_IMAGE_HEIGHT );
                    imagecopyresized($dest, $src, 0, 0, 0, 0, COVER_IMAGE_WIDTH, COVER_IMAGE_HEIGHT, $width, $height);
                    header('Content-Type: image/png');
                    imagepng($dest, ABS_MARKER_PATH.$destFile, 9);
                    imagedestroy($dest);
                    imagedestroy($src);
                    $cover_photo_url = $destFile;
                } else {
                    $cover_photo_url = '';
                }
            }
    
            $params = array(
                            'action_type'		=> 'addtarget',
                            'targetName'		=> $this->common_model->GenerateSalt(5).'_'.$ptr_date->format('YmdHis'),
                            'targetLocation'	=> ABS_MARKER_PATH.$cover_photo_url,
                            'metadata'			=> $metadata
            );
            $str_url = HTTP_VUFORIA_BASE."VWSExternalAction.php";
    
            $json_result = $this->common_model->httpPOST( $str_url, $params );
            if ( !$json_result || $json_result == 'failed' || $json_result == '' ) {
                $result = array( 'result'=>'failed', 'error'=>'Failed to add cloud target.' );
                return $result;
            }
    
            $ptr_result = json_decode($json_result);
            if ($ptr_result && $ptr_result->result_code == "TargetCreated") {
                $target_id = $ptr_result->target_id;
            } else {
                $target_id = '';
            }
            $target_rate = -1;
        }
    
        if ($card_id == '') {
            $str_url = HTTP_QRCODE_BASE."asyncQRCodeGenerate.php";
            $ptr_params = array ('sdata' => $qrcode );
            $json_qrcode = json_decode ( $this->common_model->httpPOST( $str_url, $ptr_params) );
    
            if ($json_qrcode->result == 'failed') {
                $qrcode_link = '';
            } else {
                $qrcode_link = $json_qrcode->filename;
            }
    
            $str_sql = "INSERT INTO golive_card(tourist_category_id, tourist_subcategory_id, qrcode, qrcode_link, card_type, target_id, metadata, target_type, cover_photo_url, prefilm_url, created_at, updated_at)
                         VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())";
            $this->db->query($str_sql, array($category_id, $sub_category_id, $qrcode, $qrcode_link, '1', $target_id, $metadata, $target_type, $cover_photo_url, $prefilm_url));
        } else {
            $str_sql = "UPDATE golive_card
                           SET tourist_category_id = ?
                             , tourist_subcategory_id = ?
                             , target_id = ?
                             , target_rate = ?
                             , metadata = ?
                             , target_type = ?
                             , cover_photo_url = ?
                             , prefilm_url = ?
                             , updated_at = now()
                         WHERE id = ?";
            $this->db->query($str_sql, array($category_id, $sub_category_id, $target_id, $target_rate, $metadata, $target_type, $cover_photo_url, $prefilm_url, $card_id));
        }
	}
	
	public function getCardByQR() {
	    $str_qr = isset($_POST['qr_code'])?$_POST['qr_code']:'';
	    $result = ['result' => 'failed', 'error' => 'Invalid QR code'];
	    if ($str_qr == '') {
	        return $result;
	    }
	
		$str_sql = "
            SELECT card.*
                 , user.first_name
		         , user.last_name
                 , user.email
                 , ifnull(category.category_prefilm_url, '') as category_prefilm_url
		         , ifnull(category.category_cover_photo_url, '') as category_cover_photo_url       
		         , ifnull(category.category_name, '') as category_name
              FROM golive_card card
              LEFT JOIN golive_user user ON card.user_id = user.id
              LEFT JOIN (
            	SELECT id
            	     , prefilm_url as category_prefilm_url
		             , name as category_name
		             , cover_photo_url as category_cover_photo_url
            	  FROM golive_category
            	) category ON card.category_id = category.id
		     WHERE card.qrcode = ?";
		
	    $ret_array = $this->db->query($str_sql, array($str_qr))->result();
	    if (!$ret_array) {
	        $str_sql = "
					SELECT *
					  FROM golive_category
					 WHERE qrcode = ?
					";
	        $ret_array = $this->db->query( $str_sql, array( $str_qr ));
	        if (!$ret_array) {
	            return $result;
	        }
	        $result=array(
                'result' => 'success',
                'error' => '',
                'markerImage' => HTTP_MARKER_PATH.$ret_array[0]->cover_photo_url,
                'videoUrl' => HTTP_VIDEO_PATH.$ret_array[0]->prefilm_url,
                'prefilmUrl' => HTTP_VIDEO_PATH.$ret_array[0]->wsRetrieveVideo_url,
                'targetId' => $ret_array[0]->target_id,
                'targetType' => $ret_array[0]->target_type
	        );
	        return $result;
	    } else {
	        $cardType = $ret_array[0]->card_type;
	        $videoUrl = $ret_array[0]->video_url;
	        if ($cardType == '1') {
	            $markerImage = HTTP_MARKER_PATH.$ret_array[0]->category_cover_photo_url;
	            $prefilmUrl = HTTP_VIDEO_PATH.$ret_array[0]->prefilm_url;
	        } elseif ($cardType == '2') {
	            $markerImage = HTTP_MARKER_PATH.$ret_array[0]->cover_photo_url;
	            $prefilmUrl = HTTP_VIDEO_PATH.$ret_array[0]->video_url;
            } elseif ($cardType == '3') {
                $markerImage = HTTP_MARKER_PATH.$ret_array[0]->category_cover_photo_url;
                $prefilmUrl = HTTP_VIDEO_PATH.$ret_array[0]->category_prefilm_url;                
            } else {
                return $result;
            }

	        $result=array(
                'result' => 'success',
                'error' => '',
                'videoUrl' => $videoUrl,
                'markerImage' => $markerImage,
                'prefilmUrl' => $prefilmUrl,
                'targetId' => $ret_array[0]->target_id,
                'targetType' => $ret_array[0]->target_type
	        );
	        return $result;
	    }
	
	    return $result;
	}

	public function checkQRCodeExist() {
	    $str_qr = isset($_POST['qr_code'])?$_POST['qr_code']:'';
	    $result = ['result'=>'failed', 'error'=>'Invalid QR code'];
	    if ($str_qr == '') {
	        return $result;
	    }
	    $str_sql = "SELECT id FROM golive_card WHERE qrcode = ?";
	    $ret_array = $this->db->query($str_sql, $str_qr)->result();
	    if (!$ret_array) {
	        $str_sql = "SELECT id FROM golive_category WHERE qrcode = ?";
	        $ret_array = $this->db->query($str_sql, $str_qr)->result();
	        if (!$ret_array) {
	            return $result;
	        } else {
	            return ['result' => 'success', 'error' => '', 'cardId' => $ret_array[0]->id];	            
	        }
	    } else {
	        return ['result' => 'success', 'error' => '', 'cardId' => $ret_array[0]->id];
	    }
	}

	public function getSentCard($uid)
	{
	    $str_sql = "SELECT t1.id, t1.card_type, t1.qrcode, t2.cover_photo_url, t1.created_at
	                  FROM golive_card t1, golive_ardata t2
	                 WHERE t1.ardata_id = t2.id
	                   AND t1.user_id = ?";
	    
	    $ret_array = $this->db->query( $str_sql, $uid )->result();
	    return $ret_array;
	    
	}
	
	public function wsAddCard() {
	    $result = ['result'=>'failed', 'error'=>''];
	    	    
	    $userId = isset($_POST['userId']) ? $_POST['userId'] : 0;
	    $cardType = isset($_POST['cardType']) ? $_POST['cardType'] : '';
	    $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : '';
	    $coverPhoto = isset( $_POST['coverPhoto'] ) ? $_POST['coverPhoto'] : '';
	    $note = isset($_POST['note']) ? $_POST['note'] : '';
	    $postalList = $_POST['postalList'];
	    $postalList = json_decode($postalList, true);
	    
	    $ptr_date = new DateTime();
	    if ($cardType == 2) {
	        $str_coverLink = 'cover_'.$this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".jpg";
	        file_put_contents( ABS_MARKER_PATH.$str_coverLink, base64_decode( str_replace(" ", "+", $coverPhoto) ) );	        
	    }
	    
	    $str_videoLink = $this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".mov";
	    if (!move_uploaded_file($_FILES['videoFile']['tmp_name'], ABS_VIDEO_PATH.$str_videoLink)) {
	        return array( 'result'=>'failed', 'error'=>'Failed to upload video file.' );
	    }
	    
	    if ($cardType == 2 || $cardType == 3) {
	        for ($i = 0; $i < count($postalList); $i++) {
	            if ($i == 0 && $cardType == 2) {
	                $params = array(
                        'action_type'		=> 'addtarget',
                        'targetName'		=> $this->common_model->GenerateSalt(5).'_'.$ptr_date->format('YmdHis'),
                        'targetLocation'	=> ABS_MARKER_PATH.$str_coverLink,
                        'metadata'			=> ''
	                );
	                
	                $str_url = HTTP_VUFORIA_BASE."VWSExternalAction.php";
	                $json_result = $this->common_model->httpPOST( $str_url, $params );
	                if (!$json_result || $json_result == 'failed' || $json_result == '') {
	                    return ['result'=>'failed', 'error'=>'Failed to add cloud target.'];
	                }
	                
	                $ptr_result = json_decode($json_result);
	                if ($ptr_result && $ptr_result->result_code == "TargetCreated") {
	                    $target_id = $ptr_result->target_id;
	                } else {
	                    $target_id = '';
	                }
	                $categoryId = null;
	            } elseif ($i == 0) {
	                $sql = "SELECT target_id, cover_photo_url 
	                          FROM golive_category
	                         WHERE id = ?";
	                $result = $this->db->query($sql, $categoryId)->result();
	                $target_id = $result[0]->target_id;
	                $str_coverLink = $result[0]->cover_photo_url;
	            }
	            
	            // Generate QR code
	            $str_url = HTTP_QRCODE_BASE."asyncQRCodeGenerate.php";
	            
	            $qrCode = $this->common_model->generateQrCode();
	            
	            $ptr_params = array (
                    'sdata' => $qrCode
	            );
	            $json_qrcode = json_decode ( $this->common_model->httpPOST( $str_url, $ptr_params) );
	            
	            if ( $json_qrcode->result == 'failed') {
	                return $result;
	            }
	            
	            $qrcodeLink = $json_qrcode->filename;
	            
	            $str_sql = "INSERT INTO golive_card(user_id, category_id, qrcode, qrcode_link, card_type, postal_name, postal_address,
	                                    postal_code, receipt_city, receipt_state, receipt_country, note, target_id, metadata, target_type, 
	                                    cover_photo_url, video_url, created_at, updated_at)
					         VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
	            
	            $this->db->query( $str_sql, array( $userId, $categoryId, $qrCode, $qrcodeLink, $cardType, $postalList[$i]['name'], $postalList[$i]['address'],
	                            $postalList[$i]['code'], $postalList[$i]['city'], $postalList[$i]['state'], $postalList[$i]['country'], $note, 
	                            $target_id, '', '1', $str_coverLink, $str_videoLink) );
	            usleep(10);
	        }
	        return array('result' => 'success', 'error' => '');
	    } elseif ($cardType == 1) {	        
	        $str_sql = "UPDATE golive_card
	                       SET video_url = ?
	                         , assigned_at = now()
	                     WHERE id = ?";
	        $this->db->query( $str_sql, array($str_videoLink, $categoryId));
	        return array('result' => 'success', 'error' => '');
	    } else {
	        return $result;
	    }
	}
	
	public function videoPlay() {
	    $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
	    $cardId = isset($_POST['cardId']) ? $_POST['cardId'] : '';
	    if ($userId == '' || $cardId == '') {
	        return ['result' => 'failed', 'error' => 'User ID or Card ID is incorrect.'];
	    }
	    $sql = "UPDATE golive_card
	               SET played_at = now()
	             WHERE card_id = ?";
	    $this->db->query($sql, $cardId);
	    return ['result' => 'success', 'error' => ''];
	}
	
	public function getQRCodeByCardID( ) {
	    $str_cardId = isset( $_POST['cardId'] ) ? $_POST['cardId'] : '';
	    if ( $str_cardId == '' ) {
	        return [ 'result' => 'failed', 'error' => 'Invalid Card ID'];
	    }
	    $str_sql = "SELECT qrcode FROM golive_card WHERE id=?";
	    $ret_array = $this->db->query( $str_sql, array( $str_cardId ) )->result();
	    return ['result' => 'success', 'error' => '', 'qrcode'	=> $ret_array[0]->qrcode];
	}
	
	public function save() {
	    $card_id = isset( $_POST['card_id'] ) ? $_POST['card_id'] : '';
	    $postal_address = isset( $_POST['postal_address'] ) ? $_POST['postal_address'] : '';
	    $postal_code = isset( $_POST['postal_code'] ) ? $_POST['postal_code'] : '';
	    $receipt_city = isset( $_POST['receipt_city'] ) ? $_POST['receipt_city'] : '';
	    $receipt_state = isset( $_POST['receipt_state'] ) ? $_POST['receipt_state'] : '';
	    $receipt_country = isset( $_POST['receipt_country'] ) ? $_POST['receipt_country'] : '';
	    $note = isset( $_POST['note'] ) ? $_POST['note'] : '';
	    $cover_photo_url = isset( $_POST['cover_photo_url'] ) ? $_POST['cover_photo_url'] : '';
	    $video_url = isset( $_POST['video_url'] ) ? $_POST['video_url'] : '';

	    $ptr_date = new DateTime();
	    if ($_FILES["uploadVideo"]['name'] != '') {
	        $ext = 'mov';
	        $video_url = $this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".$ext";
	        if (!move_uploaded_file($_FILES['uploadVideo']['tmp_name'], ABS_VIDEO_PATH.$video_url))
	            $video_url = '';
	    }
	    
	    
	    if (isset($_FILES["coverImage"]) && $_FILES["coverImage"]['name'] != '') {
	        $ext = pathinfo( $_FILES['coverImage']['name'] )['extension'];
	        $cover_photo_url = $this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".$ext";
	        if (!move_uploaded_file($_FILES['coverImage']['tmp_name'], ABS_MARKER_PATH.$cover_photo_url))
	            $cover_photo_url = '';
	        
	        if ($cover_photo_url != '') {
	            $destFile = $this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".$ext";
	            list($width, $height) = getimagesize(ABS_MARKER_PATH.$cover_photo_url);
	            if ($ext == "jpg" || $ext == "jpeg") {
	                $src = imagecreatefromjpeg( HTTP_MARKER_PATH.$cover_photo_url );
	                $dest = imagecreatetruecolor( COVER_IMAGE_WIDTH, COVER_IMAGE_HEIGHT );
	                imagecopyresized($dest, $src, 0, 0, 0, 0, COVER_IMAGE_WIDTH, COVER_IMAGE_HEIGHT, $width, $height);
	                header('Content-Type: image/jpeg');
	                imagejpeg($dest, ABS_MARKER_PATH.$destFile, 100);
	                imagedestroy($dest);
	                imagedestroy($src);
	                $cover_photo_url = $destFile;
	            } elseif ($ext == "png"){
	                $src = imagecreatefrompng( HTTP_MARKER_PATH.$cover_photo_url );
	                $dest = imagecreatetruecolor( COVER_IMAGE_WIDTH, COVER_IMAGE_HEIGHT );
	                imagecopyresized($dest, $src, 0, 0, 0, 0, COVER_IMAGE_WIDTH, COVER_IMAGE_HEIGHT, $width, $height);
	                header('Content-Type: image/png');
	                imagepng($dest, ABS_MARKER_PATH.$destFile, 9);
	                imagedestroy($dest);
	                imagedestroy($src);
	                $cover_photo_url = $destFile;
	            } else {
	                $cover_photo_url = '';
	            }
	        }
	        
	        $params = array(
	                        'action_type'		=> 'addtarget',
	                        'targetName'		=> $this->common_model->GenerateSalt(5).'_'.$ptr_date->format('YmdHis'),
	                        'targetLocation'	=> ABS_MARKER_PATH.$cover_photo_url,
	                        'metadata'			=> $metadata
	        );
	        $str_url = HTTP_VUFORIA_BASE."VWSExternalAction.php";
	        
	        $json_result = $this->common_model->httpPOST( $str_url, $params );
	        if ( !$json_result || $json_result == 'failed' || $json_result == '' ) {
	            $result = array( 'result'=>'failed', 'error'=>'Failed to add cloud target.' );
	            return $result;
	        }
	        
	        $ptr_result = json_decode($json_result);
	        if ($ptr_result && $ptr_result->result_code == "TargetCreated") {
	            $target_id = $ptr_result->target_id;	            
	        } else {
	            $target_id = '';
	        }
	    }
	    
	    $sql = "update golive_card
	               set postal_address = ?
	                 , postal_code = ?
	                 , receipt_city = ?
	                 , receipt_state = ?
	                 , receipt_country = ?
	                 , note = ?
	                 , cover_photo_url = ?
	                 , video_url = ?
	                 , target_id = ?
	             where id = ?";
	    $this->db->query($sql, array($postal_address, $postal_code, $receipt_city, $receipt_state, $receipt_country, $note, $cover_photo_url, $video_url, $target_id, $card_id));
	}
	
	public function batch_get_rate() {
	    $sql = "SELECT *
                  FROM golive_card
                 WHERE target_rate = -1
                   AND target_id != ''";
	    $result = $this->db->query($sql)->result();
	    for ($i = 0; $i < count($result); $i++) {
	        $target_id = $result[$i]->target_id;
	        $str_url = HTTP_VUFORIA_BASE."VWSExternalAction.php";
	        $params = array(
	                        'action_type'		=> 'gettarget',
	                        'targetId'		    => $target_id
	        );
	        $json_result = $this->common_model->httpPOST( $str_url, $params );
	        if (!$json_result || $json_result == 'failed' || $json_result == '') {
	            $target_rate = -1;
	        } else {
	            $ptr_result = json_decode($json_result);
	            if ($ptr_result && $ptr_result->result_code == 'Success') {
	                $target_rate = $ptr_result->target_record->tracking_rating;
	            } else {
	                $target_rate = -1;
	            }
	            $sql = "UPDATE golive_card
                           SET target_rate = ?
                         WHERE id = ?";
	            $this->db->query($sql, array($target_rate, $result[$i]->id));
	        }
	    }
	}	
}
