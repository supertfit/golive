<?php 
 class Buycredit_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function detail($id) {
		$str_sql = "
            SELECT *
	          FROM golive_buycredit
             WHERE id = ?";
		$result = $this->db->query($str_sql, $id)->result();
		if ($result) {
		    return $result[0];
		} else {
		    return false;
		}
		
	}
	
	public function all($active = 0) {
	    if ($active == 'active') {
	        $str_sql = "SELECT * FROM golive_buycredit WHERE is_active";
	    } else {
	        $str_sql = "SELECT * FROM golive_buycredit";	        
	    }
	    $result = $this->db->query($str_sql)->result();
		return $result;
	}
	
	public function delete($id) {
	    $str_sql = "DELETE FROM golive_buycredit WHERE id = ?";
	    $this->db->query( $str_sql, $id );
	}
	
	public function save() {
	    $buycredit_id = isset($_POST['buycredit_id']) ? $_POST['buycredit_id'] : '';
	    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
	    $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
	    $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : true;
	    
        if ($buycredit_id == '') {
            $str_sql = "INSERT INTO golive_buycredit(quantity, discount, is_active, created_at, updated_at)
                         VALUE (?, ?, ?, now(), now())";
            $this->db->query($str_sql, array($quantity, $discount, $is_active));
        } else {
            $str_sql = "UPDATE golive_buycredit
                           SET quantity = ?
                             , discount = ?
                             , is_active = ?
                             , updated_at = now()
                         WHERE id = ?";
            $this->db->query($str_sql, array($quantity, $discount, $is_active, $buycredit_id));
        }
    }
    
    public function exportCSV() {    
        $result = $this->all();
        $ptr_header = array ('ID', 'Quantity', 'Discount', 'Active', 'Discount Value', 'Final Price', 'Created On');
        $ptr_data = array ();
        foreach ($result as $k => $v)
        {
            $ptr_data[] = array ( $v->id,	$v->quantity, $v->discount, ($v->is_active) ? 'Yes' : 'No', 
                            $v->quantity * CREDITS_PRICE * $v->discount / 100, 
                            $v->quantity * CREDITS_PRICE * (100 - $v->discount ) / 100,
                            $v->created_at);
        }
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }

    public function purchaseBuycredit()
    {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        $buycreditId = isset($_POST['buycreditId']) ? $_POST['buycreditId'] : '';
        // Coming Soon
        return ['result' => 'success', 'error' => ''];
    }
    
    public function buycreditList()
    {
        return $this->all();
    }
    
    public function usage($id)
    {
        $sql = "SELECT t2.*
                  FROM golive_buycredit_usage t1, golive_user t2
                 WHERE t1.buycredit_id = ?
                   AND t1.user_id = t2.id";
        $users = $this->db->query($sql, $id)->result();
    }
}
