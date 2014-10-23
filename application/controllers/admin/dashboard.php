<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }
        $this->load->model('dashboard_model');
    }

    public function index() {
        $arr['page']=0;
        $arr['count_user'] = $this->dashboard_model->GetUserCount();
        $arr['count_tourist'] = $this->dashboard_model->GetTouristCount();
        $arr['count_custom'] = $this->dashboard_model->GetCustomCount();
        $arr['count_category'] = $this->dashboard_model->GetCategoryCount();
        $arr['count_card'] = $this->dashboard_model->GetCardCount();
        $arr['count_default_category'] = $this->dashboard_model->GetDefaultCategoryCount();
        $this->load->view('admin/vwDashboard',$arr);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */