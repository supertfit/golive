<?php 
 class Tourist_category_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
 
    public function all()
    {
    	$str_sql = "SELECT t1.*, ifnull(t2.cnt, 0) as cnt 
    	             FROM golive_tourist_category t1
    	             LEFT JOIN (SELECT count(*) as cnt, tourist_category_id FROM golive_tourist_subcategory GROUP BY tourist_category_id) t2
    	               ON t1.id = t2.tourist_category_id";

    	$result = $this->db->query( $str_sql )->result();
    	return $result;
    }
    
    public function detail($categoryId)
    {
    	$str_sql = "SELECT t1.*, ifnull(t2.cnt, 0) as cnt 
    	             FROM golive_tourist_category t1
    	             LEFT JOIN (SELECT count(*) as cnt, tourist_category_id FROM golive_tourist_subcategory GROUP BY tourist_category_id) t2
    	               ON t1.id = t2.tourist_category_id
                    WHERE t1.id = ?";
    	
        $result = $this->db->query( $str_sql, $categoryId )->result();
        return $result[0];
    }

    public function delete($categoryId) {
        $str_sql = "DELETE FROM golive_tourist_subcategory WHERE tourist_category_id = ?";
        $this->db->query($str_sql, $categoryId);
                
        $str_sql = "DELETE FROM golive_tourist_category WHERE id = ?";
        $this->db->query($str_sql, $categoryId);
    }
    
    public function exportCSV()
    {
        $result = $this->all();
        $ptr_header = array ('ID', 'Category', 'Created At');
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
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        
        if ($category_id == '') {
            $sql = "insert into golive_tourist_category(name, created_at, updated_at)
                     value (?, now(), now())";
            $this->db->query($sql, $name);
        } else {
            $sql = "update golive_tourist_category
                       set name = ?
                     where id = ?";
            $this->db->query($sql, array($name, $category_id));
        }
    }
}
