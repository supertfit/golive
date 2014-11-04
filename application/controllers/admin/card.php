<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Card extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }        
        $this->load->library('form_validation');
        $this->load->model('card_model');
        $this->load->model('common_model');
        $this->load->model('category_model');
    }
    
    public function index() {
        $arr['page'] = 7;
        $result = $this->card_model->all();
        $arr['liveCards'] = $result;
        $arr['arr_card_type'] = $this->common_model->getCardType();
        $arr['arr_target_type'] = $this->common_model->getTargetType();   
        $this->load->view('admin/card/vwCardList', $arr);
    }
    
    public function add() {
        
        $str_sql = "SELECT count(*) cnt FROM golive_card WHERE qrcode = ?";
        $qrcode = $this->common_model->GenerateSalt( 5, 1 );
        $ret_array = $this->db->query( $str_sql, array( $qrcode ))->result();
        while ( $ret_array[0]->cnt * 1 > 0 ) {
            $qrcode = $this->common_model->GenerateSalt( 5, 1 );
            $ret_array = $this->db->query( $str_sql, array( $qrcode ))->result();
            usleep( 10 );
        }
        
        $arr['page'] = 7;
        $arr['category'] = $this->category_model->all();
        $arr['qrcode'] = $qrcode;
        $arr['arr_card_type'] = $this->common_model->getCardType();
        $arr['arr_target_type'] = $this->common_model->getTargetType();
        $this->load->view('admin/card/vwCardAdd', $arr);
    }    

    public function edit($cardId) {
        $arr['page'] = 7;
        $result = $this->card_model->getCard($cardId);
        $arr['data'] = $result;
        $arr['category'] = $this->category_model->all();
        $arr['arr_card_type'] = $this->common_model->getCardType();
        $arr['arr_target_type'] = $this->common_model->getTargetType();
        $this->load->view('admin/card/vwCardEdit', $arr);
    }
    
    public function delete($cardId) {
        $this->card_model->delete($cardId);
        redirect('admin/card');
    }
    
    public function save() {
        $this->card_model->save();
        redirect('admin/card');        
    }
    
    public function csv() {
        $this->card_model->exportCSV();
    }
}
