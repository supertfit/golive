<?php 
 class Deal_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function detail($id) {
		$str_sql = "
            SELECT *
	          FROM golive_deal
             WHERE id = ?";
		$result = $this->db->query($str_sql, $id)->result();
		return $result[0];
	}
	
	public function all() {
		$str_sql = "
            SELECT *
	          FROM golive_deal";
		$result = $this->db->query($str_sql)->result();
		return $result;
	}
	
	public function delete($id) {
	    $str_sql = "DELETE FROM golive_deal WHERE id = ?";
	    $this->db->query( $str_sql, $id );
	}
	
	public function save() {
	    $deal_id = isset($_POST['deal_id']) ? $_POST['deal_id'] : '';
	    $type = isset($_POST['type']) ? $_POST['type'] : '';
	    $name = isset($_POST['name']) ? $_POST['name'] : '';
	    $is_reach = isset($_POST['is_reach']) ? $_POST['is_reach'] : 0;
	    $amount = isset($_POST['amount']) ? $_POST['amount'] : 0;
	    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
	    $price = isset($_POST['price']) ? $_POST['price'] : 0;
	    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
	    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

        if ($deal_id == '') {
            $str_sql = "INSERT INTO golive_deal(type, name, is_reach, amount, quantity, price, start_date, end_date, created_at, updated_at)
                         VALUE (?, ?, ?, ?, ?, ?, ?, ?, now(), now())";
            $this->db->query($str_sql, array($type, $name, $is_reach, $amount, $quantity, $price, $start_date, $end_date));
        } else {
            $str_sql = "UPDATE golive_deal
                           SET type = ?
                             , name = ?
                             , is_reach = ?
                             , amount = ?
                             , quantity = ?
                             , price = ?
                             , start_date = ?
                             , end_date = ?
                             , updated_at = now()
                         WHERE id = ?";
            $this->db->query($str_sql, array($type, $name, $is_reach, $amount, $quantity, $price, $start_date, $end_date, $deal_id));
        }
    }
    
    public function exportCSV() {
        $arr_deal_type = $this->common_model->getDealType();
    
        $result = $this->all();
        $ptr_header = array ('ID', 'Deal Type', 'Name', 'Discount Amount', 'List Quantity', 'List Price', 'Start Date', 'End Date', 'Created On');
        $ptr_data = array ();
        foreach ($result as $k => $v)
        {
            $ptr_data[] = array (
                            $v->id,	$arr_deal_type[$v->type], $v->name, $v->amount, $v->quantity, $v->price,
                            $v->start_date, $v->end_date, $v->created_at);
        }
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }

    public function purchaseDeal()
    {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        $dealId = isset($_POST['dealId']) ? $_POST['dealId'] : '';
        // Coming Soon
        return ['result' => 'success', 'error' => ''];
    }
    
    public function dealList()
    {
        $sql = "SELECT id, type, name, amount, quantity, price
                  FROM golive_deal
                 WHERE DATE(NOW()) BETWEEN start_date AND end_date";
        return $this->db->query($sql)->result();
    }
    
    public function usage($id)
    {
        $sql = "SELECT t2.*
                  FROM golive_deal_usage t1, golive_user t2
                 WHERE t1.deal_id = ?
                   AND t1.user_id = t2.id";
        $users = $this->db->query($sql, $id)->result();
    }
}
