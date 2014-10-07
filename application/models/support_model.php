<?php
 class Support_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
    public function all() {
        $sql = "SELECT t1.*
                     , t2.type as support_category_type
                     , t2.name as support_category_name
                     , t3.email
                     , t4.qrcode
                  FROM golive_support t1, golive_support_category t2, golive_user t3, golive_card t4
                 WHERE t1.support_category_id = t2.id
                   AND t1.user_id = t3.id
                   AND t1.card_id = t4.id";
        return $this->db->query($sql)->result();
    }
    
    public function detail($id) {
        $sql = "SELECT t1.*
                     , t2.type as support_category_type
                     , t2.name as support_category_name
                     , t3.email
                     , t4.qrcode
                  FROM golive_support t1, golive_support_category t2, golive_user t3, golive_card t4
                 WHERE t1.support_category_id = t2.id
                   AND t1.user_id = t3.id
                   AND t1.card_id = t4.id
                   AND t1.id = ?";
        $result = $this->db->query($sql, $id)->result();
        if ($result) {
            return $result[0];
        } else {
            return ['result' => 'failed', 'error' => 'Support is not exist'];
        }
    }
    
    public function save() {
        $support_id = isset($_POST['support_id']) ? $_POST['support_id'] : '';
        $issue_id = isset($_POST['issue_id']) ? $_POST['issue_id'] : '';
        $support_category_id = isset($_POST['support_category_id']) ? $_POST['support_category_id'] : 0;
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        $card_id = isset($_POST['card_id']) ? $_POST['card_id'] : 0;
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $priority = isset($_POST['priority']) ? $_POST['priority'] : 0;
        $device = isset($_POST['device']) ? $_POST['device'] : '';
        $os_version = isset($_POST['os_version']) ? $_POST['os_version'] : '';
        $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
        
        if ($support_id == '') {
            $sql = "INSERT INTO golive_support(issue_id, support_category_id, user_id, issue_at, note, card_id, status, priority, device, os_version, payment_method, created_at, updated_at)
                     VALUE (?, ?, ?, now(), ?, ?, ?, ?, ?, ?, ?, now(), now())";
            $this->db->query($sql, array($issue_id, $support_category_id, $user_id, $note, $card_id, $status, $priority, $device, $os_version, $payment_method));
            
        } else {
            $sql = "UPDATE golive_support
                       SET status = ?
                         , priority = ?
                         , updated_at = now()
                     WHERE id = ?";
            $this->db->query($sql, array($status, $priority, $support_id));
        }
    }
    
    public function delete($id) {
        $sql = "DELETE
                  FROM golive_support
                 WHERE id = ?";
        $result = $this->db->query($sql, $id);
    }
    
    public function exportCSV() {
        $result = $this->all();
        $status = $this->common_model->getSupportStatusType();
        $priority = $this->common_model->getSupportPriorityType();
        
        $ptr_header = array ('Issue ID', 'Type', 'Category', 'Issued On', 'User E-email', 'Note', 'goLiveCard ID', 'Status', 'Priority', 'Device', 'OS Version', 'Payment method', 'Updated On');
        $ptr_data = array ();
        foreach ($result as $k => $v) {
            $ptr_data[] = array ($v->issue_id,	$v->support_category_type, $v->support_category_name, $v->issue_at,
                            $v->email, $v->note, $v->qrcode, $status[$v->status], $priority[$v->priority], $v->device, $v->os_version, $v->payment_method, $v->updated_at);
        }
        
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );        
    }
}