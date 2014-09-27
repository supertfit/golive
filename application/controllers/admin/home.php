<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
		if ($this->session->userdata('is_admin')) {
            redirect('admin/dashboard');
        } else {
        	$this->load->view('admin/vwLogin');
        }
    }
    
    public function go_qrgenerator() {
    	$arr['page'] = 6;
    	$this->load->view('admin/vwQRCodeGenerator', $arr);
    }

    public function go_addtouristcard() {
    	$arr['page'] = 8;
    	$this->load->view('admin/vwAddTouristCard', $arr);
    }
    
    public function go_addcategorycard() {
    	$arr['page'] = 9;
    	$this->load->model( 'wsapis_model' );
    	$list_category = $this->wsapis_model->GetCategoryList();
    	$arr['category_list'] = $list_category;
    	$this->load->view('admin/vwAddCategoryCard', $arr);
    }
}