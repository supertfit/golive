<?php
/********************************************************************************************
 * Page				: Admin Dashboard model 
 * Author			: KCH
 * ------------------------------------------------------------------------------------------
 * File Name		: dashboard_model.php
 * Description		: 
 * Date				: Aug 12, 2014 5:07:34 PM
 * Version			: 1.0
 ********************************************************************************************/ 
 class Dashboard_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function GetUserCount() {
		$str_sql = "SELECT COUNT(*) cnt FROM golive_user WHERE is_active AND !is_admin";
		$result = $this->db->query($str_sql)->result();
		return $result[0]->cnt;
	}
	
	public function GetCardCount() {
		$str_sql = "SELECT COUNT(*) cnt FROM golive_card";
		$result = $this->db->query( $str_sql )->result();
		return $result[0]->cnt;
	}
	
	public function GetTouristCount() {
	    $str_sql = "SELECT COUNT(*) cnt FROM golive_card WHERE card_type = '1'";
	    $result = $this->db->query( $str_sql )->result();
	    return $result[0]->cnt;
	}
	
	public function GetCustomCount() {
	    $str_sql = "SELECT COUNT(*) cnt FROM golive_card WHERE card_type = '2'";
	    $result = $this->db->query( $str_sql )->result();
	    return $result[0]->cnt;	     
	}

	public function GetCategoryCount() {
	    $str_sql = "SELECT COUNT(*) cnt FROM golive_card WHERE card_type = '3'";
	    $result = $this->db->query( $str_sql )->result();
	    return $result[0]->cnt;	     
	}

	public function GetDefaultCategoryCount() {
	    $str_sql = "SELECT COUNT(*) cnt FROM golive_category";
	    $result = $this->db->query( $str_sql )->result();
	    return $result[0]->cnt;
	}	
}
