<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TouristCard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }        
        $this->load->library('form_validation');
        $this->load->model('card_model');
        $this->load->model('common_model');
        $this->load->model('category_model');
        $this->load->model('tourist_category_model');
        $this->load->model('tourist_subcategory_model');
    }

    public function index() {
        $arr['page'] = 9;
        $cards = $this->card_model->all(1);
        $arr['cards'] = $cards;
        $this->load->view('admin/card/vwTouristList', $arr);
    }
    
    public function add() {
        $arr['page'] = 9;
        $arr['qrcode'] = $this->common_model->generateQrCode();
        $arr['category'] = $this->tourist_category_model->all();
        $this->load->view('admin/card/vwTouristAdd', $arr);
    }    
    
    public function edit($cardId) {
        $arr['page'] = 9;
        $data = $this->card_model->detail($cardId);
        $arr['category'] = $this->tourist_category_model->all();
        $cid = $data->tourist_category_id;
        $arr['subcategory'] = $this->tourist_subcategory_model->all($cid);
        $arr['data'] = $data;
        $this->load->view('admin/card/vwTouristEdit', $arr);
    }

    public function delete($cardId) {
        $this->card_model->delete( $cardId );
        redirect('admin/touristCard');
    }
    
    public function save() {
        $this->card_model->saveTourist( );
        redirect('admin/touristCard');        
    }

    public function csv() {
        $this->card_model->exportCSV();
    }
}
