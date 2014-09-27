<?php
/********************************************************************************************
 * Page				: Promotions Controller
 * Author			: KCH
 * ------------------------------------------------------------------------------------------
 * File Name		: promotions.php
 * Description		: The controller of promotions
 * Date				: Aug 12, 2014 5:18:44 PM
 * Version			: 1.0
 ********************************************************************************************/
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Promotions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('promotions_model');
	}

	public function index() {
		if ($this->session->userdata('is_admin')) {
			$arr['page'] = 5;
        	$arr['promotions'] = $this->promotions_model->RetrieveAllPromotions();
			$this->load->view('admin/vwPromotions', $arr);
		} else {
			redirect('admin/vwLogin');
		}
	}
	
	public function go_addpromotion() {
		if ($this->session->userdata('is_admin')) {
			$arr['page'] = 5;
			$this->load->view('admin/vwAddPromotion', $arr);
		} else {
			redirect('admin/vwLogin');
		}
	}
	
	public function add_new() {
		$this->promotions_model->AddNewPromotion();
		$arr['page'] = 'promotions';
		redirect('admin/promotions', $arr);
	}
	
	public function go_editpromotion( $pid ) {
		if ($this->session->userdata('is_admin')) {
			$arr['page'] = 6;
			$arr['pgtype'] = 'edit';
			$result = $this->promotions_model->RetrievePromotion($pid);
			$arr['proTitle'] = $result[0]->title;
			$arr['proContent'] = $result[0]->content;
			$arr['pid'] = $pid;
			$this->load->view('admin/vwAddPromotion', $arr);
		} else {
		}
	}
	
	public function update( $pid ) {
		$this->promotions_model->UpdatePromotion( $pid );
		$arr['page'] = 5;
		redirect('admin/promotions', $arr);
	}
	
	public function delete_promotion( $pid ) {
		$this->promotions_model->DeletePromotion($pid);
		$arr['page'] = 'promotions';
		redirect('admin/promotions', $arr);
	}
}