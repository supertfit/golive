<?php 
 class Transaction_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function detail($id) {
		$str_sql = "
            SELECT t1.*, t2.email, t3.qrcode, t3.qrcode_link
	          FROM golive_transaction t1, golive_user t2, golive_card t3
             WHERE t1.id = ?
		       AND t1.user_id = t2.id
		       AND t1.card_id = t3.id";
		$result = $this->db->query($str_sql, $id)->result();
		if ($result) {
		    return $result[0];
		} else {
		    return false;
		}
		
	}
	
	public function all() {
		$str_sql = "
            SELECT t1.*, t2.email, t3.qrcode, t3.qrcode_link
	          FROM golive_transaction t1, golive_user t2, golive_card t3
             WHERE t1.user_id = t2.id
		       AND t1.card_id = t3.id";
	    $result = $this->db->query($str_sql)->result();
		return $result;
	}
	
    public function exportCSV() {    
        $result = $this->all();
        $ptr_header = array ('Transaction ID', 'Transaction Date', 'Sender Email', 'goLiveCard ID', '@ of cards sent', 'Charge method', 'Charged amount', 'Shipment Confirmation', 'Email Confirmation', 'Created On');
        $ptr_data = array ();
        foreach ($result as $k => $v)
        {
            $ptr_data[] = array ( $v->transaction_id,	$v->transaction_at, $v->email, $v->qrcode, $v->count_sent, 
                            $v->method, $v->amount, ($v->is_ship_confirmed) ? 'Yes' : 'No', ($v->is_email_confirmed) ? 'Yes' : 'No', $v->created_at);
        }
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }
}
