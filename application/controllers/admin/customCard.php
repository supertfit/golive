<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CustomCard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('card_model');
        $this->load->model('common_model');
    }

    public function index() {
        $arr['page'] = 7;
        $cards = $this->card_model->all(2);
        $arr['cards'] = $cards;
        $this->load->view('admin/card/vwCustomList', $arr);
    }
    
    public function edit($cardId) {
        $arr['page'] = 7;
        $data = $this->card_model->detail($cardId);
        $arr_target_type = $this->common_model->getTargetType();
        
        $arr['data'] = $data;
        $arr['arr_target_type'] = $arr_target_type;
        $this->load->view('admin/card/vwCustomEdit', $arr);
    }    

    public function delete($cardId) {
        $this->card_model->delete( $cardId );
        redirect('admin/customCard');
    }
    
    public function save() {
        $this->card_model->save();
        redirect('admin/customCard');
    }    

    public function csv() {
        $this->card_model->exportCSV(2);
    }
    

}
