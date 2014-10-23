<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Support extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }        
        $this->load->library('form_validation');
        $this->load->model('common_model');
        $this->load->model('support_model');
    }
    
    public function index() {
        $arr['page'] = 25;
        $arr['supports'] = $this->support_model->all();
        $arr['status'] = $this->common_model->getSupportStatusType();
        $arr['priority'] = $this->common_model->getSupportPriorityType();        
        $this->load->view('admin/support/vwSupportList', $arr);
    }
    
    public function edit($id) {
        $arr['page'] = 25;
        $arr['data'] = $this->support_model->detail($id);
        $arr['status'] = $this->common_model->getSupportStatusType();
        $arr['priority'] = $this->common_model->getSupportPriorityType();        
        $this->load->view('admin/support/vwSupportEdit', $arr);
    }
    
    public function save() {
        $arr['page'] = 25;
        $this->support_model->save();
        redirect('admin/support');
    }
    
    public function csv() {
        $this->support_model->exportCSV();
    }
    
    public function delete($id) {
        $this->support_model->delete($id);
        redirect('admin/support');
    }
}
