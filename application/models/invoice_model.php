<?php 
 class Invoice_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function detail($id) {
		$str_sql = "
            SELECT t1.*, t2.email
	          FROM golive_invoice t1, golive_user t2
             WHERE t1.id = ?
		       AND t1.user_id = t2.id";
		$result = $this->db->query($str_sql, $id)->result();
		if ($result) {
		    return $result[0];
		} else {
		    return false;
		}
		
	}
	
	public function all() {
		$str_sql = "
            SELECT t1.*, t2.email
	          FROM golive_invoice t1, golive_user t2
             WHERE t1.user_id = t2.id";
	    $result = $this->db->query($str_sql)->result();
		return $result;
	}
	
    public function exportCSV() {    
        $result = $this->all();
        $ptr_header = array ('Invoice ID', 'Payment Date', 'Sender Email', 'Payment Method', 'Credits/Cards', 'Achieved Discount', 'Achieved Bonus', 'Account Balance Increase', 'Confirmation Email', 'Created On');
        $ptr_data = array ();
        foreach ($result as $k => $v)
        {
            $ptr_data[] = array ( $v->invoice_id,	$v->payment_at, $v->email, $v->method, $v->type, 
                            $v->discount, $v->bonus, $v->balance_increase, ($v->is_confirmed) ? 'Yes' : 'No', $v->created_at);
        }
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }
}
