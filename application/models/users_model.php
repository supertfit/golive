<?php
class Users_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function getUserList() {
		$str_sql = "SELECT t1.*, ifnull(t2.count_card_sent, 0) as count_card_sent
		              FROM golive_user t1
		              LEFT JOIN (SELECT count(*) count_card_sent, user_id FROM golive_card GROUP BY user_id) t2
		                ON t1.id = t2.user_id";
		$ret_array = $this->db->query($str_sql)->result();
		return $ret_array;
	}
	
	public function delete($uid) {
		$str_sql = "DELETE FROM golive_user WHERE id = ?";
		$this->db->query($str_sql, $uid);
	}
	
	public function block( $str_uid ) {
		$str_sql = "UPDATE golive_user SET is_active = false WHERE id = ?";
		$this->db->query($str_sql, $str_uid);
	}
	
	public function active( $str_uid ) {
		$str_sql = "UPDATE golive_user SET is_active = true WHERE id = ?";
		$this->db->query($str_sql, $str_uid);
	}
	
	public function getUserById($uid) {
	    $str_sql = "SELECT t1.*, ifnull(t2.count_card_sent, 0) as count_card_sent
		              FROM golive_user t1
		              LEFT JOIN (SELECT count(*) count_card_sent, user_id FROM golive_card GROUP BY user_id) t2
		                ON t1.id = t2.user_id
	                 WHERE id = ?";	    
	    $ret_array = $this->db->query($str_sql, $uid)->result();
	    return $ret_array[0];
	}
	
    public function save() {        
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $state = isset($_POST['state']) ? $_POST['state'] : '';
        $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : '';
        $credits = isset($_POST['credits']) ? $_POST['credits'] : 0;
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $is_admin = isset($_POST['is_admin']) ? $_POST['is_admin'] : 0;
        $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : 0;
        
        if ($user_id == '') {
            $salt = $this->common_model->GenerateSalt(8);
            $secure_key = md5($salt.$password);
            $str_sql = "
                INSERT INTO golive_user(first_name, last_name, email, birthday, address, city, state, postal_code, country, secure_key, is_admin, is_active, salt, created_at, updated_at)
                 VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())";
            $this->db->query($str_sql, array($first_name, $last_name, $email, $birthday, $address, $city, $state, $postal_code, $country, $secure_key, $is_admin, $is_active, $salt));
        } else {
            $str_sql = "SELECT * FROM golive_user WHERE id = ?";
            $arr_result = $this->db->query($str_sql, $user_id)->result();
            $secure_key = $arr_result[0]->secure_key;
            $salt = $arr_result[0]->salt;
            if ($password) {
                $secure_key = md5($salt.$password);
            }
            $str_sql = "
                UPDATE golive_user
                   SET first_name = ?
                     , last_name = ?
                     , email = ?
                     , birthday = ?
                     , address = ?
                     , city = ?
                     , state = ?
                     , postal_code = ?
                     , credits = ?
                     , country = ?
                     , secure_key = ?
                     , is_admin = ?
                     , is_active = ?
                     , salt = ?
                     , updated_at = now()
                 WHERE id = ?
            ";
            $this->db->query($str_sql, array($first_name, $last_name, $email, $birthday, $address, $city, $state, $postal_code, $credits, $country, $secure_key, $is_admin, $is_active, $salt, $user_id));                        
        }
    }
    
    public function addNewUser() {
        $result = array('result'=>'failed', 'error'=>'');
        $str_firstname 	= isset($_POST['firstname'])?$_POST['firstname']:'';
        $str_lastname 	= isset($_POST['lastname'])?$_POST['lastname']:'';
        $str_email 		= isset($_POST['email'])?$_POST['email']:'';
        $str_pwd 		= isset($_POST['password'])?$_POST['password']:'';
        $str_birthday 	= isset($_POST['birthday'])?$_POST['birthday']:'';
        $str_gender     = isset($_POST['gender'])?$_POST['gender']:'M';
        $str_photo      = isset($_POST['photo'])?$_POST['photo']:'';
        
    
        $ptr_date = new DateTime();
        if ($str_photo != '') {
            $str_photo_url = 'profile_'.$this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".jpg";
            file_put_contents( ABS_PROFILE_PATH.$str_photo_url, base64_decode( str_replace(" ", "+", $str_photo) ) );
        } else {
            $str_photo_url = 'default.png';
        }
        
        if ($str_firstname == '' && $str_lastname == '') {
            $result = array('result'=>'failed', 'error'=>'Invalid Username.');
            return $result;
        }
    
        if ($str_email == '') {
            $result = array('result'=>'failed', 'error'=>'Invalid Email address.');
            return $result;
        }
    
        if ($str_pwd == '') {
            $result = array('result'=>'failed', 'error'=>'Password field could not be blank.');
            return $result;
        }
    
        $str_salt = $this->common_model->GenerateSalt(8);
    
        $str_enc_pwd = md5($str_salt.$str_pwd);
    
        $str_activationCode = $this->common_model->GenerateSalt(8);
    
        while ( $this->checkDuplicateActiveCode($str_activationCode) == true) {
            $str_activationCode = $this->common_model->GenerateSalt(8);
            sleep(1);
        }
    
        $str_sql = "INSERT INTO golive_user(first_name, last_name, email, birthday, gender, photo, activation_code, secure_key, salt, is_active, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
    
        $this->db->query($str_sql, array($str_firstname, $str_lastname, $str_email, $str_birthday, $str_gender, $str_photo_url, $str_activationCode, $str_enc_pwd, $str_salt));
        $str_userId = $this->db->insert_id();
        
    
        $str_verifyurl = base_url()."wsapis/go_activatecode";
        $msgContent = "Your activation code is ".$str_activationCode."\r\nPlease verify it on this url ".$str_verifyurl;
         
        $body = file_get_contents('application/libraries/phpmailer/template/user_template.html');
        $body = str_replace("{active_code}", $str_activationCode, $body);
        $body = str_replace("{url}", $str_verifyurl, $body);
    
        $subject = "Welcome to login !";
    
        $this->common_model->sendMail($str_email, $body, $subject, $str_firstname." ".$str_lastname);
        return ['result'=>'success', 'error'=>'', 'userId'=>$str_userId];
    }

    public function socialSignUp() {
        $result = array('result'=>'failed', 'error'=>'');
        $str_username 	= isset($_POST['username'])?$_POST['username']:'';
        $str_email 		= isset($_POST['email'])?$_POST['email']:'';
        $str_snsId 		= isset($_POST['snsId'])?$_POST['snsId']:'';
        $str_nickname 	= isset($_POST['name'])?$_POST['name']:'';
        $str_photo      = isset($_POST['photo'])?$_POST['photo']:'';
        
        $ptr_date = new DateTime();
        if ($str_photo != '') {
            $str_photo_url = 'profile_'.$this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".jpg";
            file_put_contents( ABS_PROFILE_PATH.$str_photo_url, base64_decode( str_replace(" ", "+", $str_photo) ) );
        } else {
            $str_photo_url = 'default.png';
        }        
    
        if ($str_snsId == '') {
            $result = array('result' => 'failed', 'error' => 'Social Id empty.');
            return $result;
        }
    
        if ($str_username == '') {
            $result = array('result' => 'failed', 'error' => 'Invalid Username.');
            return $result;
        }
    
        if ($str_email == '') {
            $result = array('result'=>'failed', 'error'=>'Invalid Email address.');
            return $result;
        }
    
        $str_sql = "SELECT id, user_id FROM golive_user_sns WHERE sns_id = ?";
        $ret = $this->db->query($str_sql, array($str_snsId))->result();
        if ($ret) {
            $result = array('result'=>'success', 'error'=>'', 'userId'=>$ret[0]->user_id);
            return $result;
        } else {
            $str_sql = "INSERT INTO golive_user(first_name, last_name, email, photo, is_admin, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $this->db->query($str_sql, array($str_username, '', $str_email, $str_photo_url, false, true));
            $str_userId = $this->db->insert_id();
    
            $str_sql = "INSERT INTO golive_user_sns(user_id, sns_id, username, email, nickname, sns_type, created_at, updated_at) VALUES (?, ?, ?, ?, ?, 'F', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
            $this->db->query($str_sql, array($str_userId, $str_snsId, $str_username, $str_email, $str_nickname));
            $str_scId = $this->db->insert_id();
            	
            $result = array('result' => 'success', 'error' => '', 'userId' => $str_userId);
            return $result;
        }
    }

    public function activateUser() {
        $str_actcode = isset($_POST['activecode'])?$_POST['activecode']:"";
        $result = array("result" => "failed", "error" => "Invalid activation code.");
        if ($str_actcode == "")
            return $result;
    
        $str_sql = "SELECT id, is_active FROM golive_user WHERE activation_code=?";
        $ret_array = $this->db->query($str_sql, array($str_actcode))->result();
    
        if (!$ret_array) {
            return $result;
        } else {
            $str_uid = $ret_array[0]->id;
            if ($ret_array[0]->is_active)
            {
                return array("result" => "failed", "error" => "Already activated.");
            }
            	
            $str_sql = "UPDATE golive_user SET is_active = true, updated_at = CURRENT_TIMESTAMP() WHERE id=?";
            $this->db->query($str_sql, array($str_uid));
            $result = array("result"=>"success", "error"=>"Activated successfully.");
            	
            return $result;
        }
    }

    // check activation code is duplicated or not
    public function checkDuplicateActiveCode($activationCode) {
        $str_sql = "SELECT COUNT(*) cnt FROM golive_user WHERE activation_code = ?";
        $ret_array = $this->db->query($str_sql, $activationCode)->result();
        if (!$ret_array) {
            return false;
        } else {
            $int_cnt = $ret_array[0]->cnt;
            if ($int_cnt * 1 >= 1) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function exportCSV()
    {
        $result = $this->getUserList();
        $ptr_header = array ('ID', 'First Name', 'Last Name', 'Email', 'Birthday', 'Gender', 'Address', 'City', 'State', 'Country', 'Postal Code'
                        , 'Number Of Card Sent', 'Visit Count', 'Last Visited', 'Created At', 'Admin');
        $ptr_data = array ();
        $i = 0;
        foreach ($result as $k => $v)
        {
            $ptr_data[$i] = array (
                            $v->id,	$v->first_name, $v->last_name, $v->email, $v->birthday, ($v->gender == 'M') ? 'Male' : 'Female', 
                            $v->address, $v->city, $v->state, $v->country, $v->postal_code,
                            $v->count_card_sent, $v->count_visit, $v->visited_at, $v->created_at, $v->is_admin ? "Yes" : "No" );
            $i ++;
        }
    
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }    

    public function checkEmailConflict() {
        $str_email = isset($_POST['email'])?$_POST['email']:'';
        $str_sql = "SELECT COUNT(*) cnt FROM golive_user WHERE email = ?";
        $ret = $this->db->query($str_sql, $str_email)->result();
    
        if ($ret) {
            if ($ret[0]->cnt * 1 >= 1) {
                return ['result' => 'success', 'error' => 'Email address is already used.', 'photo' => ABS_PROFILE_PATH.$ret[0]->photo, ];
            }
        }
        return ['result'=>'failed', 'error'=>'No exist.'];
    }


    public function forgotPwd()
    {
        $str_email = isset($_POST['email']) ? $_POST['email'] : '';

        $result = array('result'=>'failed', 'error'=>'Invalid email address');
        if ($str_email == '')
            return $result;

        // send reset email
        $str_sql = "SELECT id, salt FROM golive_user WHERE email=? AND is_active";
        $ret_array = $this->db->query($str_sql, array($str_email))->result();
        if (!$ret_array)
            return $result;
    
        $str_uid = $ret_array[0]->id;
        $str_salt = $ret_array[0]->salt;
        $str_newpwd = $this->common_model->GenerateSalt(8);
        $str_seckey = md5($str_salt.$str_newpwd);
        $str_sql = "UPDATE golive_user SET secure_key=? WHERE id=?";
        $this->db->query($str_sql, array($str_seckey, $str_uid));

        $body = file_get_contents('application/libraries/phpmailer/template/user_forgotpassword.html');
        $body = str_replace("{newpassword}", $str_newpwd, $body);
        	
        $subject = "Forgotten password!";
    
        $this->common_model->sendMail($str_email, $body, $subject);
    
        $result = array('result'=>'success', 'error'=>'Please check your email inbox.');
        return $result;
    }

    public function checkUserInfo()
    {
        $result = array();
        $str_email 	= isset($_POST['email'])?$_POST['email']:'';
        $str_pwd = isset($_POST['password'])?$_POST['password']:'';
    
        if ($str_email == '') {
          	$result = array('result'=>'failed', 'error'=>'Invalid Email address or password');
          	return $result;
        }
         
        $str_sql = "SELECT id, salt, secure_key, is_active FROM golive_user WHERE email = ? LIMIT 1";
        $ptr_result = $this->db->query($str_sql, array($str_email))->result();
        if (!$ptr_result) {
          	$result = array('result' => 'failed', 'error'=>'Invalid Email address or password');
          	return $result;
        } else {
      		if (!$ptr_result[0]->is_active) {
      		    $result = array('result' => 'failed', 'error' => 'This user is not activated, please activate first.', 'userId' => '');
      		    return $result;
      		}

      		if (strcmp($ptr_result[0]->secure_key, md5($ptr_result[0]->salt.$str_pwd)) == 0) {
      		    $userId = $ptr_result[0]->id;
      		    
      		    $str_sql = "UPDATE golive_user
      		                   SET count_visit = count_visit + 1
      		                     , visited_at  = NOW()
      		                 WHERE id = ?";
      		    $this->db->query($str_sql, $userId);
      		    
      		    $result = array('result' => 'success', 'error' => '', 'userId' => $ptr_result[0]->id);
      		    return $result;
      		}
        }
         
        $result = array('result'=>'failed', 'error'=>'Invalid Email address or password');
        return $result;
    }
    
    public function wsVisit() {
        $result = array('result'=>'success', 'error'=>'');
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '-1';
        $str_sql = 'UPDATE golive_user
                       SET count_visit = count_visit + 1
                         , visited_at = now()
                     WHERE id = ?';
        $this->db->query($str_sql, $userId);
        return $result;
    }
    
    public function wsUserUpdate()
    {
        $result = array('result'=>'success', 'error'=>'');
        
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '0';
        $first_name = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $last_name = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
        $photo = isset($_POST['photo']) ? $_POST['photo'] : '';

        $this->common_model->print_log("User ID : $userId");
        $this->common_model->print_log("First Name : $first_name");
        $this->common_model->print_log("Last Name : $last_name");
        $this->common_model->print_log("Birthday : $birthday");
        
        $ptr_date = new DateTime();
        $photoLink = 'profile_'.$this->common_model->GenerateSalt(8)."_".$ptr_date->format('YmdHis').".jpg";
        file_put_contents( ABS_PROFILE_PATH.$photoLink, base64_decode( str_replace(" ", "+", $photo) ) );
        
        $this->common_model->print_log("Photo : $photoLink");
        $str_sql = 'UPDATE golive_user
                       SET first_name = ?
                         , last_name = ?
                         , birthday = ?
                         , photo = ?
                         , updated_at = now()
                     WHERE id = ?';
        $this->common_model->print_log("SQL : $str_sql");
        $this->db->query($str_sql, array($first_name, $last_name, $birthday, $photoLink, $userId));
        return $result;
    }
    
    function getAddressBook($uid) {
        $sql = "SELECT *
                  FROM golive_address_book
                 WHERE user_id = ?";
        return $this->db->query($sql, $uid)->result();
    }    
    
    public function export_address_book_CSV($uid)
    {
        $result = $this->getAddressBook($uid);
        $ptr_header = array ('Name', 'Address', 'City', 'State', 'Country', 'Postal Code', 'Joined On');
        $ptr_data = array ();
        $i = 0;
        foreach ($result as $k => $v)
        {
            $ptr_data[$i] = array ( $v->fullname, $v->address, $v->city, $v->state, $v->country, $v->postal_code, $v->created_at );
            $i ++;
        }
    
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }    
}
