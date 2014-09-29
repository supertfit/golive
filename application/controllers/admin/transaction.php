<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('common_model');
        $this->load->model('transaction_model');
    }
    
    public function index() {
        $arr['page'] = 22;
        $result = $this->transaction_model->all();
        $arr['transactions'] = $result;
        $this->load->view('admin/transaction/vwTransactionList', $arr);
    }

    public function detail($id) {
        $arr['page'] = 22;
        $result = $this->transaction_model->detail($id);
        $arr['data'] = $result;
        $this->load->view('admin/transaction/vwTransactionDetail', $arr);
    }
    
    public function csv() {
        $this->transaction_model->exportCSV();
    }
}
