<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Batch extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('card_model');
        $this->load->model('common_model');
    }

    public function get_category_rate() {
        $this->category_model->batch_get_rate();
    }
    
    public function get_card_rate() {
        $this->card_model->batch_get_rate();
    }    
}
