<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('category_model');
        $this->load->model('common_model');
    }

    public function index() {
        $arr['page'] = 10;
        $list_categories = $this->category_model->all();
        $arr['categories'] = $list_categories;
        $arr['arr_target_type'] = $this->common_model->getTargetType();
        $arr['arr_default_card_type'] = $this->common_model->getDefaultCardType();
        $this->load->view('admin/category/vwCategoryList', $arr);
    }

    public function add() {
        $arr['arr_default_card_type'] = $this->common_model->getDefaultCardType();
        $arr['page'] = 10;
        $arr['qrcode'] = $this->common_model->generateQrcode();
        $this->load->view('admin/category/vwCategoryAdd', $arr);
    }

    public function edit($categoryId) {
        $arr['page'] = 10;
        $arr['data'] = $this->category_model->detail($categoryId);
        $this->load->view('admin/category/vwCategoryEdit',$arr);
    }

    public function delete($categoryId) {
        $this->category_model->delete( $categoryId );
        redirect('admin/category');
    }

    public function save() {
        $this->category_model->save();
        redirect('admin/category');
    }

    public function csv() {
        $this->category_model->exportCSV();
    }
    
    public function batch_get_rate() {
        $this->category_model->batch_get_rate();
    }
}
