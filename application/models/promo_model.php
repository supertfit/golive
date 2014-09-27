<?php 
 class Promo_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function detail($id) {
		$str_sql = "
            SELECT t1.*
		         , ifnull(t2.email, '') as email
		         , ifnull(t2.first_name, '') as first_name
		         , ifnull(t2.last_name, '') as last_name		                
	          FROM golive_promo t1
		      LEFT JOIN golive_user t2 
		        ON t1.user_id = t2.id
             WHERE t1.id = ?";
		$result = $this->db->query($str_sql, $id)->result();
		return $result[0];
	}
	
	public function all() {
		$str_sql = "
            SELECT t1.*
		         , ifnull(t2.email, '') as email
		         , ifnull(t2.first_name, '') as first_name
		         , ifnull(t2.last_name, '') as last_name		                
	          FROM golive_promo t1
		      LEFT JOIN golive_user t2 
		        ON t1.user_id = t2.id";
		$result = $this->db->query($str_sql)->result();
		return $result;
	}
	
	public function delete($id) {
	    $str_sql = "DELETE FROM golive_promo WHERE id = ?";
	    $this->db->query( $str_sql, $id );
	}
	
	public function save() {
	    $promo_id = isset($_POST['promo_id']) ? $_POST['promo_id'] : '';
	    $code = isset($_POST['code']) ? $_POST['code'] : '';
	    $bonus = isset($_POST['bonus']) ? $_POST['bonus'] : 0;
	    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
	    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

        if ($promo_id == '') {
            $str_sql = "INSERT INTO golive_promo(code, bonus, start_date, end_date, created_at, updated_at)
                         VALUE (?, ?, ?, ?, now(), now())";
            $this->db->query($str_sql, array($code, $bonus, $start_date, $end_date));
        } else {
            $str_sql = "UPDATE golive_promo
                           SET code = ?
                             , bonus = ?
                             , start_date = ?
                             , end_date = ?
                             , updated_at = now()
                         WHERE id = ?";
            $this->db->query($str_sql, array($code, $bonus, $start_date, $end_date, $promo_id));
        }
    }
    
    public function generateCode() {
        // Check dupilcated Promo Code
        $str_sql = "SELECT count(*) cnt FROM golive_promo WHERE code = ?";
        $code = $this->common_model->GenerateSalt(8, 1);
        $ret_array = $this->db->query( $str_sql, array( $code ))->result();
        while ( $ret_array[0]->cnt * 1 > 0 ) {
            $code = $this->common_model->GenerateSalt(8);
            $ret_array = $this->db->query( $str_sql, array( $code ))->result();
            usleep( 10 );
        }
        return $code;
    }
    
    public function exportCSV() {
        $arr_deal_type = $this->common_model->getDealType();
    
        $result = $this->all();
        $ptr_header = array ('ID', 'Code', 'Bonus', 'Start Date', 'End Date', 'Used By', 'Used On', 'Created On');
        $ptr_data = array ();
        foreach ($result as $k => $v)
        {
            $ptr_data[] = array ( $v->id, $v->code, $v->bonus, $v->start_date, $v->end_date, $v->email, $v->used_at, $v->created_at);
        }
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }

    public function usePromoCode ()
    {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        $promoCode = isset($_POST['promoCode']) ? $_POST['promoCode'] : '';
        
        $sql = "SELECT *
                  FROM golive_promo
                 WHERE !is_used
                   AND (DATE(NOW()) BETWEEN start_date AND end_date) 
                   AND code = ?";
        $result = $this->db->query($sql, $promoCode)->result();
        if ($result) {
            $bonus = $result[0]->bonus;
            $sql = "UPDATE golive_user
                       SET credits = credits + $bonus";
            $this->db->query($sql);
            
            $sql = "UPDATE golive_promo
                       SET user_id = ?
                         , is_used = 1
                         , used_at = now()
                     WHERE id = ?";
            $this->db->query($sql, array($userId, $result[0]['id']));
            return ['result' => 'success', 'error'=>'Promo Code has been successfully used.'];
        } else {
            return ['result' => 'failed', 'error'=>'Invalid Promo Code.'];
        }
    }
}
