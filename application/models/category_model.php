<?php 
 class Category_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
 
    public function all()
    {
    	$str_sql = "SELECT t1.*, ifnull(t2.cnt, 0) as cnt 
    	             FROM golive_category t1
    	             LEFT JOIN (SELECT count(*) cnt, category_id FROM golive_card WHERE card_type = 3 GROUP BY category_id) t2
    	               ON t1.id = t2.category_id";

    	$result = $this->db->query( $str_sql )->result();
    	return $result;
    }
    
    public function detail($categoryId)
    {
        $str_sql = "SELECT t1.*, ifnull(t2.cnt, 0) as cnt 
    	              FROM golive_category t1
    	              LEFT JOIN (SELECT count(*) cnt, category_id FROM golive_card WHERE card_type = 3 GROUP BY category_id) t2
    	                ON t1.id = t2.category_id
                     WHERE t1.id = ?";
    
        $result = $this->db->query( $str_sql, $categoryId )->result();
        return $result[0];
    }

    public function delete($categoryId) {
        $str_sql = "DELETE FROM golive_category WHERE id = ?";
        $this->db->query($str_sql, $categoryId);
    }
    
    public function exportCSV()
    {
        $arr_target_type = $this->common_model->getTargetType();
        
        $result = $this->all();
        $ptr_header = array ('ID', 'Name', 'QR Code', 'QR Code Link', 'Target Id', 'Counter', 'Target Type', 'Marker Photo', 'Video', 'Created At');
        $ptr_data = array ();
        $i = 0;
        foreach ($result as $k => $v)
        {
            $ptr_data[$i] = array (
                            $v->id,	$v->name, $v->qrcode, HTTP_QRCODE_PATH.$v->qrcode_link, $v->target_id, $v->cnt,
                            $arr_target_type[$v->target_type], HTTP_MARKER_PATH.$v->cover_photo_url, HTTP_VIDEO_PATH.$v->prefilm_url, $v->created_at);
            $i ++;
        }
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }    
    
    public function save()
    {
        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $qrcode = isset($_POST['qrcode']) ? $_POST['qrcode'] : '';
        $target_id = isset($_POST['target_id']) ? $_POST['target_id'] : '';
        $target_rate = isset($_POST['target_rate']) ? $_POST['target_rate'] : -1;
        $metadata = "";
        $target_type = isset($_POST['target_type']) ? $_POST['target_type'] : '1';
        $prefilm_url = isset($_POST['prefilm_url']) ? $_POST['prefilm_url'] : '';
        $cover_photo_url = isset($_POST['cover_photo_url']) ? $_POST['cover_photo_url'] : '';
        
        $width = 640;
        $height = 360;

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
                if ($ext == "jpg" || $ext == "jpeg") {
                    $src = imagecreatefromjpeg( HTTP_MARKER_PATH.$cover_photo_url );
                    $dest = imagecreatetruecolor( $width, $height );
                    imagecopy($dest, $src, 0, 0, 0, 0, $width, $height);
                    header('Content-Type: image/jpeg');
                    imagejpeg($dest, ABS_MARKER_PATH.$destFile, 100);
                    imagedestroy($dest);
                    imagedestroy($src);
                    $cover_photo_url = $destFile;
                } elseif ($ext == "png"){
                    $src = imagecreatefrompng( HTTP_MARKER_PATH.$cover_photo_url );
                    $dest = imagecreatetruecolor( $width, $height );
                    imagecopy($dest, $src, 0, 0, 0, 0, $width, $height);
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
                'targetName'		=> 'cloud_'.$ptr_date->format('YmdHis'),
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
                
        if ($category_id == '') {
            $str_url = HTTP_QRCODE_BASE."asyncQRCodeGenerate.php";
            $ptr_params = array ('sdata' => $qrcode );
            $json_qrcode = json_decode ( $this->common_model->httpPOST( $str_url, $ptr_params) );
            
            if ($json_qrcode->result == 'failed') {
                $qrcode_link = '';
            } else {
                $qrcode_link = $json_qrcode->filename;
            }
            
            $str_sql = "INSERT INTO golive_category(name, qrcode, qrcode_link, target_id, metadata, target_type, cover_photo_url, prefilm_url, created_at, updated_at)
                         VALUE (?, ?, ?, ?, ?, ?, ?, ?, now(), now())";
            $this->db->query($str_sql, array($name, $qrcode, $qrcode_link, $target_id, $metadata, $target_type, $cover_photo_url, $prefilm_url));
        } else {
            $str_sql = "UPDATE golive_category
                           SET name = ?
                             , qrcode = ?
                             , target_id = ?
                             , target_rate = ?
                             , metadata = ?
                             , target_type = ?
                             , cover_photo_url = ?
                             , prefilm_url = ?
                             , updated_at = now()
                         WHERE id = ?";
            $this->db->query($str_sql, array($name, $qrcode, $target_id, $target_rate, $metadata, $target_type, $cover_photo_url, $prefilm_url, $category_id));
        }
    }
    
    public function getCategoryDetail () {
        $categoryId = isset ( $_POST['categoryId'] ) ? $_POST['categoryId'] : '';
         
        if ($categoryId == '') {
            return ['result'=>'failed', 'error'=>'Invalid Category ID'];
        }
        
        $sql = "SELECT *
                  FROM golive_category
                 WHERE id = ?";
        $arr_result = $this->db->query($sql, $categoryId)->result();
        
        if ($arr_result) {
            return ['result' => 'success',
                    'error' => '',
                    'name' => $arr_result[0]->name,
                    'prefilmed' => HTTP_VIDEO_PATH.$arr_result[0]->prefilm_url,
                    'markerImage' =>  HTTP_MARKER_PATH.$arr_result[0]->cover_photo_url];
        } else {
            return ['result'=>'failed', 'error'=>'Invalid Category ID'];
        }
    }
    
    public function batch_get_rate() {
        $sql = "SELECT *
                  FROM golive_category
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
                $sql = "UPDATE golive_category
                           SET target_rate = ?
                         WHERE id = ?";
                $this->db->query($sql, array($target_rate, $result[$i]->id));                
            }
        }
    }
}
