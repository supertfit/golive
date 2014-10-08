<?php
 class Address_book_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
    public function add()
    {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $state = isset($_POST['state']) ? $_POST['state'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : '';
        if ($userId == '') {
            return ['result' => 'failed', 'error' => 'Failed on adding address books.'];
        }
        
        $sql = "INSERT INTO golive_address_book(user_id, fullname, address, city, state, country, postal_code, created_at, updated_at)
                 VALUE (?, ?, ?, ?, ?, ?, ?, now(), now())";
        $this->db->query($sql, array($userId, $fullname, $address, $city, $state, $country, $postal_code));
        $id = $this->db->insert_id();
        return ['result' => 'success', 'error' => '', 'address_book_id' => $id];
    }
    
    public function update()
    {
        $address_book_id = isset($_POST['address_book_id']) ? $_POST['address_book_id'] : '';
        $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $state = isset($_POST['state']) ? $_POST['state'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : '';
        
        if ($address_book_id == '') {
            return ['result' => 'failed', 'error' => 'Failed on adding address books.'];
        }
        
        $sql = "UPDATE golive_address_book
                   SET fullname = ?
                     , address = ?
                     , city = ?
                     , state = ?
                     , country = ?
                     , postal_code = ?
                     , updated_at = now()
                 WHERE id = ?";
        $this->db->query($sql, array($fullname, $address, $city, $state, $country, $postal_code, $address_book_id));
        return ['result' => 'success', 'error' => ''];
    }
    
    public function retrieve($userId)
    {
        $sql = "SELECT *
                  FROM golive_address_book
                 WHERE user_id = ?";
        return $this->db->query($sql, $userId)->result();
    }
    
    public function delete($id)
    {
        if ($id == '') {
            return ['result' => 'failed', 'error' => 'Failed on delete address book.'];
        }
        $sql = "DELETE
                  FROM golive_address_book
                 WHERE id = ?";
        $this->db->query($sql, $id);
        return ['result' => 'success', 'error' => '']; 
    }
}
