<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DeliveryNote extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('common_model');
        $this->load->model('delivery_note_model');
    }
    
    public function index() {
        $arr['page'] = 23;
        $arr['deliveryNotes'] = $this->delivery_note_model->all();
        $this->load->view('admin/deliveryNote/vwDeliveryNoteList', $arr);
    }
    
    public function add() {
        $arr['page'] = 23;
        $this->load->view('admin/deliveryNote/vwDeliveryNoteAdd', $arr);
    }    

    public function edit($id) {
        $arr['page'] = 23;
        $arr['data'] = $this->delivery_note_model->detail($id);
        $this->load->view('admin/deliveryNote/vwDeliveryNoteEdit', $arr);
    }
    
    public function save() {
        $arr['page'] = 23;
        $this->delivery_note_model->save();
        redirect('admin/deliveryNote');
    }
    
    public function csv() {
        $this->delivery_note_model->exportCSV();
    }
    
    public function delete($id) {
        $this->delivery_note_model->delete($id);
        redirect('admin/deliveryNote');
    }    
}
