<?php 
 class Tourist_subcategory_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
 
    public function all($cid)
    {
    	$str_sql = "SELECT *
    	              FROM golive_tourist_subcategory
    	             WHERE tourist_category_id = ?";
    	    	
    	$result = $this->db->query( $str_sql, $cid )->result();
    	return $result;
    }
    
    public function detail($sub_cid)
    {
    	$str_sql = "SELECT * 
    	              FROM golive_tourist_subcategory
                     WHERE id = ?";
    	
    	$result = $this->db->query( $str_sql, $sub_cid )->result();
    	return $result[0];
    }

    public function delete($sub_cid) {
        $str_sql = "DELETE FROM golive_tourist_subcategory WHERE id = ?";
        $this->db->query($str_sql, $sub_cid);
    }
    
    public function exportCSV($cid)
    {
        $result = $this->all($cid);
        $ptr_header = array ('ID', 'Sub Category', 'Created At');
        $ptr_data = array ();

        foreach ($result as $k => $v)
        {
            $ptr_data[] = array ( $v->id, $v->name, $v->created_at);
        }
        $str_csvname = $this->common_model->writeCSVFile( $ptr_header, $ptr_data );
    }    
    
    public function save()
    {
        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
        $subcategory_id = isset($_POST['sub_category_id']) ? $_POST['sub_category_id'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        
        if ($subcategory_id == '') {
            $sql = "INSERT INTO golive_tourist_subcategory(tourist_category_id, name, created_at, updated_at)
                     VALUE (?, ?, now(), now())";
            $this->db->query($sql, array($category_id, $name));
        } else {
            $sql = "UPDATE golive_tourist_subcategory
                       SET name = ?
                     WHERE id = ?";
            $this->db->query($sql, array($name, $subcategory_id));
        }
    }
}
