<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CategoryCard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }        
        $this->load->library('form_validation');
        $this->load->model('card_model');
        $this->load->model('common_model');
    }

    public function index() {
        $arr['page'] = 8;
        $cards = $this->card_model->all(3);
        $arr['cards'] = $cards;
        $this->load->view('admin/card/vwCategoryList', $arr);
    }
    
    public function edit($cardId) {
        $arr['page'] = 8;
        $data = $this->card_model->detail($cardId);
        $arr_target_type = $this->common_model->getTargetType();
        
        $arr['data'] = $data;
        $arr['arr_target_type'] = $arr_target_type;
        $this->load->view('admin/card/vwCategoryEdit', $arr);
    }    

    public function delete($cardId) {
        $this->card_model->delete( $cardId );
        redirect('admin/categoryCard');
    }
    
    public function save() {
        $this->card_model->save();
        redirect('admin/categoryCard');
    }    

    public function csv() {
        $this->card_model->exportCSV(3);
    }
}
