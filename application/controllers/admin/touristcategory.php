<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Touristcategory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('tourist_category_model');
        $this->load->model('tourist_subcategory_model');
        $this->load->model('common_model');
    }

    public function index() {
        $arr['page'] = 14;
        $touristCategories = $this->tourist_category_model->all();
        $arr['touristCategories'] = $touristCategories;
        $this->load->view('admin/touristcategory/vwTouristCategoryList', $arr);
    }

    public function add() {
        $arr['page'] = 14;
        $this->load->view('admin/touristcategory/vwTouristCategoryAdd', $arr);
    }
    
    public function sub_add($cid) {
        $arr['page'] = 14;
        $arr['cid'] = $cid;
        $this->load->view('admin/touristcategory/vwTouristSubcategoryAdd', $arr);
    }    

    public function edit($cid) {
        $arr['page'] = 14;
        $arr['data'] = $this->tourist_category_model->detail($cid);
        $arr['subcategories'] = $this->tourist_subcategory_model->all($cid);
        $arr['cid'] = $cid;
        $this->load->view('admin/touristcategory/vwTouristCategoryEdit',$arr);
    }
    
    public function sub_edit($cid) {
        $arr['page'] = 14;
        $arr['data'] = $this->tourist_subcategory_model->detail($cid);
        $arr['cid'] = $arr['data']->tourist_category_id;
        $this->load->view('admin/touristcategory/vwTouristSubcategoryEdit',$arr);
    }    

    public function delete($cid) {
        $this->tourist_category_model->delete($cid);
        redirect('admin/touristcategory');
    }
    
    public function sub_delete($sid) {
        $arr['data'] = $this->tourist_subcategory_model->detail($sid);
        $cid = $arr['data']->tourist_category_id;
        $this->tourist_subcategory_model->delete($sid);
        redirect("admin/touristcategory/edit/$cid");
    }    

    public function save() {
        $this->tourist_category_model->save();
        redirect('admin/touristcategory');
    }
    
    public function sub_save() {
        $cid = $_POST['category_id'];
        $this->tourist_subcategory_model->save();
        redirect("admin/touristcategory/edit/$cid");
    }    

    public function csv() {
        $this->tourist_category_model->exportCSV();
    }
    
    public function sub_all() {
        $cid = isset($_POST['cid']) ? $_POST['cid'] : '';
        $this->common_model->print_log("CID : $cid");
        $result = $this->tourist_subcategory_model->all($cid);
        die(json_encode($result));
    }
}
