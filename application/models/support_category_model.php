<?php
 class Support_category_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
    public function all() {
        $sql = "SELECT *
                  FROM golive_support_category";
        return $this->db->query($sql)->result();
    }
    
    public function detail($id) {
        $sql = "SELECT *
                  FROM golive_support_category
                 WHERE id = ?";
        $result = $this->db->query($sql, $id)->result();
        if ($result) {
            return $result[0];
        } else {
            return ['result' => 'failed', 'error' => 'Support Category is not exist'];
        }
    }
    
    public function save() {
        $support_category_id = isset($_POST['support_category_id']) ? $_POST['support_category_id'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : 1;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        
        if ($support_category_id == '') {
            $sql = "INSERT INTO golive_support_category(type, name, created_at, updated_at)
                     VALUE (?, ?, now(), now())";
            $this->db->query($sql, array($type, $name));
        } else {
            $sql = "UPDATE golive_support_category
                       SET type = ?
                         , name = ?
                         , updated_at = now()
                     WHERE id = ?";
            $this->db->query($sql, array($type, $name, $support_category_id));
        }
    }
    
    public function delete($id) {
        $sql = "DELETE
                  FROM golive_support_category
                 WHERE id = ?";
        $result = $this->db->query($sql, $id);
    }
    
    public function exportCSV() {
        $type = $this->common_model->getSupportCategoryType();
        $result = $this->all();
        $ptr_header = array ('ID', 'Type', 'Name', 'Created At');
        $ptr_data = array ();
        foreach ($result as $k => $v) {
            $ptr_data[] = array ($v->id, $type[$v->type], $v->name, $v->created_at);
        }
        
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );        
    }
}