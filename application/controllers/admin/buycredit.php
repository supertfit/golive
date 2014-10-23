<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buycredit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }
        $this->load->library('form_validation');
        $this->load->model('common_model');
        $this->load->model('buycredit_model');
    }
    
    public function index() {
        $arr['page'] = 13;
        $result = $this->buycredit_model->all();
        $arr['buycredits'] = $result;
        $this->load->view('admin/buycredit/vwBuycreditList', $arr);
    }

    public function add() {
        $arr['page'] = 13;
        $this->load->view('admin/buycredit/vwBuycreditAdd', $arr);
    }

    public function edit($id) {
        $arr['page'] = 13;
        $result = $this->buycredit_model->detail($id);
        $arr['data'] = $result;
        $this->load->view('admin/buycredit/vwBuycreditEdit', $arr);
    }
    
    public function delete($id) {
        $this->buycredit_model->delete($id);
        redirect('admin/buycredit');
    }
    
    public function save() {
        $this->buycredit_model->save();
        redirect('admin/buycredit');
    }
    
    public function csv() {
        $this->buycredit_model->exportCSV();
    }
    
    public function usage($id)
    {
        $arr['page'] = 13;
        $result = $this->buycredit_model->usage($id);
        $arr['users'] = $result;
        $this->load->view('admin/buycredit/vwBuycreditUsageList', $arr);
    }
}
