<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('common_model');
        $this->load->model('deal_model');
    }
    
    public function index() {
        $arr['page'] = 11;
        $result = $this->deal_model->all();
        $arr['deals'] = $result;
        $arr['arr_deal_type'] = $this->common_model->getDealType();
        $this->load->view('admin/deal/vwDealList', $arr);
    }

    public function add() {
        $arr['page'] = 11;
        $arr['arr_deal_type'] = $this->common_model->getDealType();
        $this->load->view('admin/deal/vwDealAdd', $arr);
    }

    public function edit($id) {
        $arr['page'] = 11;
        $result = $this->deal_model->detail($id);
        $arr['data'] = $result;
        $arr['arr_deal_type'] = $this->common_model->getDealType();
        $this->load->view('admin/deal/vwDealEdit', $arr);
    }
    
    public function delete($id) {
        $this->deal_model->delete($id);
        redirect('admin/deal');
    }
    
    public function save() {
        $this->deal_model->save();
        redirect('admin/deal');
    }
    
    public function csv() {
        $this->deal_model->exportCSV();
    }
    
    public function usage($id)
    {
        $arr['page'] = 11;
        $result = $this->deal_model->usage($id);
        $arr['users'] = $result;
        $this->load->view('admin/deal/vwDealUsageList', $arr);
    }
}
