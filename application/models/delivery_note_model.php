<?php
 class Delivery_note_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
    public function all() {
        $sql = "SELECT *
                  FROM golive_delivery_note";
        return $this->db->query($sql)->result();
    }
    
    public function detail($id) {
        $sql = "SELECT *
                  FROM golive_delivery_note
                 WHERE id = ?";
        $result = $this->db->query($sql, $id)->result();
        if ($result) {
            return $result[0];
        } else {
            return ['result' => 'failed', 'error' => 'Delivery Note is not exist'];
        }
    }
    
    public function save() {
        $delivery_note_id = isset($_POST['delivery_note_id']) ? $_POST['delivery_note_id'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        
        if ($delivery_note_id == '') {
            $sql = "INSERT INTO golive_delivery_note(country, note, created_at, updated_at)
                     VALUE (?, ?, now(), now())";
            $this->db->query($sql, array($country, $note));
        } else {
            $sql = "UPDATE golive_delivery_note
                       SET country = ?
                         , note = ?
                         , updated_at = now()
                     WHERE id = ?";
            $this->db->query($sql, array($country, $note, $delivery_note_id));
        }
    }
    
    public function delete($id) {
        $sql = "DELETE
                  FROM golive_delivery_note
                 WHERE id = ?";
        $result = $this->db->query($sql, $id);
    }
    
    public function exportCSV() {
        $result = $this->all();
        $ptr_header = array ('ID', 'Country', 'Note', 'Created At');
        $ptr_data = array ();
        foreach ($result as $k => $v) {
            $ptr_data[] = array ($v->id,	$v->country, $v->note, $v->created_at);
        }
        
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );        
    }
}