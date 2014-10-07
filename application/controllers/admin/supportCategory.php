<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SupportCategory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('common_model');
        $this->load->model('support_category_model');
    }
    
    public function index() {
        $arr['page'] = 24;
        $arr['supportCategories'] = $this->support_category_model->all();
        $arr['type'] = $this->common_model->getSupportCategoryType();
        $this->load->view('admin/supportCategory/vwSupportCategoryList', $arr);
    }
    
    public function add() {
        $arr['page'] = 24;
        $arr['type'] = $this->common_model->getSupportCategoryType();
        $this->load->view('admin/supportCategory/vwSupportCategoryAdd', $arr);
    }    

    public function edit($id) {
        $arr['page'] = 24;
        $arr['data'] = $this->support_category_model->detail($id);
        $arr['type'] = $this->common_model->getSupportCategoryType();
        $this->load->view('admin/supportCategory/vwSupportCategoryEdit', $arr);
    }
    
    public function save() {
        $arr['page'] = 24;
        $this->support_category_model->save();
        redirect('admin/supportCategory');
    }
    
    public function csv() {
        $this->support_category_model->exportCSV();
    }
    
    public function delete($id) {
        $this->support_category_model->delete($id);
        redirect('admin/supportCategory');
    }    
}
