<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }        
        $this->load->library('form_validation');
        $this->load->model('common_model');
        $this->load->model('promo_model');
    }
    
    public function index() {
        $arr['page'] = 12;
        $result = $this->promo_model->all();
        $arr['promos'] = $result;
        $this->load->view('admin/promo/vwPromoList', $arr);
    }

    public function add() {
        $arr['page'] = 12;
        $promo_code = $this->promo_model->generateCode();
        $arr['promo_code'] = $promo_code;
        $this->load->view('admin/promo/vwPromoAdd', $arr);
    }

    public function edit($id) {
        $arr['page'] = 12;
        $result = $this->promo_model->detail($id);
        $arr['data'] = $result;
        $this->load->view('admin/promo/vwPromoEdit', $arr);
    }
    
    public function delete($id) {
        $this->promo_model->delete($id);
        redirect('admin/promo');
    }
    
    public function save() {
        $this->promo_model->save();
        redirect('admin/promo');
    }
    
    public function csv() {
        $this->promo_model->exportCSV();
    }
    
}
