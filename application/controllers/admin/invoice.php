<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('common_model');
        $this->load->model('invoice_model');
    }
    
    public function index() {
        $arr['page'] = 21;
        $result = $this->invoice_model->all();
        $arr['invoices'] = $result;
        $this->load->view('admin/invoice/vwInvoiceList', $arr);
    }

    public function detail($id) {
        $arr['page'] = 21;
        $result = $this->invoice_model->detail($id);
        $arr['data'] = $result;
        $this->load->view('admin/invoice/vwInvoiceDetail', $arr);
    }
    
    public function csv() {
        $this->invoice_model->exportCSV();
    }
}
