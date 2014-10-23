<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();      
        $this->load->library('form_validation');
        $this->load->model('users_model');
    }

    public function index() {
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }        
        $arr['page'] = 1;
        $arr['users'] = $this->users_model->getUserList();
        $this->load->view('admin/user/vwUserList',$arr);
    }
    
    public function add() {
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }
        $arr['page'] = 1;
        $this->load->view('admin/user/vwUserAdd',$arr);
    }

    public function edit($uid) {
        if (!($this->session->userdata('id') && $this->session->userdata('is_admin'))) {
            redirect('/');
        }
        $arr['page'] = 1;
        $arr['data'] = $this->users_model->getUserById($uid);
        $this->load->view('admin/user/vwUserEdit',$arr);
    }
    
    public function save() {
        $this->users_model->save();
        redirect('admin/users');
    }
    
    public function delete($uid) {
        $this->users_model->delete( $uid );
        redirect('admin/users');
    }    
    
    public function csv() {
        $this->users_model->exportCSV();
    }
    
    public function login() {

        if ($this->session->userdata('is_admin')) {
            redirect('admin/home/dashboard');
        } else {
            $user = $_POST['username'];
            $password = $_POST['password'];

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/vwLogin');
            } else {
                // $salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
                // $enc_pass  = md5($salt.$password);
                $sql = "SELECT * FROM golive_user WHERE email = ? AND secure_key = md5(concat(salt,?)) AND is_admin = 1";
                $val = $this->db->query($sql,array($user ,$password ));

                if ($val->num_rows) {
                    foreach ($val->result_array() as $recs => $res) {
                        $this->session->set_userdata(array(
                            'id' => $res['id'],
                            'username' => $res['first_name']." ".$res['last_name'],
                            'email' => $res['email'],
                            'is_admin' => true,
                            'photo' => $res['photo']
                            )
                        );
                    }
                    redirect('admin/dashboard');
                } else {
                    $err['error'] = 'Username or Password incorrect';
                    $this->load->view('admin/vwLogin', $err);
                }
            }
        }
    }

        
    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('is_admin');
        $this->session->unset_userdata('photo');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('admin/home', 'refresh');
    }
    
	public function block_user( $uid ) {
		$this->users_model->block( $uid );
		redirect('admin/users');
	}
	
	public function activate_user ( $uid ) {
		$this->users_model->active( $uid );
		redirect('admin/users');
	}
	
	public function address_book($uid) {
	    $arr['page'] = 1;
	    $arr['user_id'] = $uid;
	    $arr['addressBooks'] = $this->users_model->getAddressBook($uid);
	    $this->load->view('admin/user/vwAddressBookList',$arr);	    
	}
	
	public function csv_address_book($uid) {
	    $this->users_model->export_address_book_CSV($uid);	    
	}
}