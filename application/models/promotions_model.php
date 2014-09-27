<?php
/********************************************************************************************
 * Page				:
 * Author			: KCH
 * ------------------------------------------------------------------------------------------
 * File Name		: promotions_model.php
 * Description		: 
 * Date				: Aug 12, 2014 5:19:38 PM
 * Version			: 1.0
 ********************************************************************************************/
class Promotions_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	public function RetrieveAllPromotions() {
		$str_sql = "SELECT * FROM promo_tbl WHERE deletedYN='N'";
		$result = $this->db->query($str_sql)->result();
		return $result;
	}
	
	public function AddNewPromotion() {
		$str_title = isset($_POST['proTitle'])?$_POST['proTitle']:'';
		$str_content = isset($_POST['proContent'])?$_POST['proContent']:'';
		$str_sql = "INSERT INTO promo_tbl(title, content) VALUES(?,?)";
		$this->db->query($str_sql, array($str_title, $str_content));
	}
	
	public function RetrievePromotion( $str_pid ) {
		$str_sql = "SELECT * FROM promo_tbl WHERE id=?";
		$result = $this->db->query($str_sql, array($str_pid))->result();
		return $result;
	}
	
	public function UpdatePromotion( $str_pid ) {
		$str_sql = "UPDATE promo_tbl SET title=?,content=? WHERE id=?";
		$str_title = isset($_POST['proTitle'])?$_POST['proTitle']:'';
		$str_content = isset($_POST['proContent'])?$_POST['proContent']:'';
		$this->db->query($str_sql, array($str_title, $str_content, $str_pid));
	}
	
	public function DeletePromotion ( $str_pid ) {
		$str_sql = "UPDATE promo_tbl SET deletedYN='Y' WHERE id=?";
		$this->db->query($str_sql, array($str_pid));
	}
}