<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wsapis extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        
        $this->load->model('wsapis_model');
        $this->load->model('users_model');
        $this->load->model('card_model');
        $this->load->model('category_model');
        $this->load->model('address_book_model');
    }
    
    public function wsSignIn() {
    	$result = $this->users_model->checkUserInfo();
    	die ( json_encode ($result) );
    }
    
    public function wsSignUp() {
    	$result = $this->users_model->addNewUser();
    	die ( json_encode ($result) );
    }
    
    public function wsCheckEmail() {
    	$result = $this->users_model->checkEmailConflict();
    	die ( json_encode ($result) );
    }
    
    public function wsSocialSignUp() {
    	$result = $this->users_model->socialSignUp();
    	die ( json_encode ($result) );
    }
    
    public function wsForgotPwd() {
    	$result = $this->users_model->forgotPwd();
    	die(json_encode($result));
    }
    
    // Go Activation Code Page
    public function go_activatecode() {
    	$this->load->view('vwActivateUser');
    }
    
    public function activate_user() {
    	$result = $this->users_model->activateUser();
    	die(json_encode($result));
    }
    
    public function go_signup() {
    	$this->load->view('vwSignup');
    }
    
    public function go_signin() {
    	$this->load->view('vwSignin');
    }
    
    public function go_resetpwd() {
    	$result = "";
    }
    
    public function wsRetrieveVideo() {
    	$result = $this->card_model->getCardByQR();
    	die(json_encode($result));
    }
    
    public function wsCheckQRCodeExist() {
    	$result = $this->card_model->checkQRCodeExist();
    	die(json_encode($result));
    }
        
    // Upload tourist card user video 
    public function wsUploadTouristVideo() {
    	$result = $this->wsapis_model->UploadTouristVideo();
    	die( $result );
    }
    
    // Upload category card user video
    public function wsUploadCategoryVideo() {
    	$result = $this->wsapis_model->UploadCategoryVideo();
    	die( $result );
    }
    
    // Get QR Code by card identifier
    public function wsGetQRCodeByCardID ( )  
    {
    	$result = $this->card_model->getQRCodeByCardID( );
    	die ( json_encode( $result ) );
    }
    
    
    public function wsExportCSV() 
    {
    	$result = $this->wsapis_model->ExportCSV();
    	die($result);
    }
    
    public function wsExportCSVFile() {
    	$this->wsapis_model->ExportCSVFile();
    }
    
    public function wsAddNewCategoryCard() {
    	$result = $this->card_model->addCategoryCard( );
    	$arr['page'] = 9;
    	if ( $result['result'] == 'failed') {
    		$arr['errors'] = $result['error'];
    	}
    	
    	$this->load->view('admin/vwAddCategoryCard', $arr);
    }
    
    public function wsGetCategoryDetail() {
    	$result = $this->category_model->getCategoryDetail();
    	die( json_encode( $result ) );
    }
    
    public function wsGetCategoryList() {
        $result = $this->category_model->all();
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]->cover_photo_url = HTTP_MARKER_PATH.$result[$i]->cover_photo_url;
            $result[$i]->prefilm_url = HTTP_VIDEO_PATH.$result[$i]->prefilm_url;
            $result[$i]->qrcode_link = HTTP_MARKER_PATH.$result[$i]->qrcode_link;
            $result[$i]->icon_url = HTTP_ICON_PATH.$result[$i]->icon_url;
            $result[$i]->icon_hover_url = HTTP_ICON_PATH.$result[$i]->icon_hover_url;
        }
        $result = json_decode(json_encode( $result ));
        die( json_encode( ['categoryList' => $result, 'result' => 'success', 'error' => ''] ) );
    }

    public function wsGetBuyCreditList() {
        $result = $this->buycredit_model->all('active');
        $result = json_decode(json_encode( $result ));
        die( json_encode( ['categoryList' => $result, 'result' => 'success', 'error' => ''] ) );
    }

    public function wsGetBuyCreditDetail() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        if ($id == '') {
            return ['result' => 'failed', 'error' => 'ID is undefined.'];
        }
        $result = $this->buycredit_model->detail($id);
        if ($result) {
            die( json_encode( ['result' => 'success',
                               'error' => '',
                               'id' => $result->id,
                               'quantity' => $result->quantity,
                               'discount' => $result->discount ] ) );
        } else {
            die( json_encode( ['result' => 'failed', 'error' => 'ID is undefined.'] ) );
        }
        
    }    
    
    public function wsGetUserInfo()
    {
        $uid = isset($_POST['userId']) ? $_POST['userId'] : '0';
        $result1 = $this->users_model->getUserById($uid);
        foreach ($result1 as $key => $value) {
            if ($key == 'photo') {
                $result[$key] = HTTP_PROFILE_PATH.$value;
            } else {
                $result[$key] = $value;
            }
        }
        $result2 = $this->card_model->getSentCard($uid);
        
        $cardList = array();
        foreach ($result2 as $item) {
            $card = array();
            foreach ($item as $key => $value) {
                if ($key == 'cover_photo_url') {
                    $card[$key] = HTTP_MARKER_PATH.$value;
                } else {
                    $card[$key] = $value;
                }
            }
            $cardList[] = $card;
        }
        $result['cardList'] = $cardList;
        
        // $result = json_decode(json_encode($this->users_model->getUserById($uid)));
        // $result['cardList'] = json_decode(json_encode($this->card_model->getSentCard($uid)));
        $result['result'] = 'success';
        die( json_encode( $result ) );
    }
    
    public function wsAddCard()
    {
        $result = $this->card_model->wsAddCard();
        die( json_encode( $result ) );
    }
    
    public function wsVisit()
    {
        $result = $this->users_model->wsVisit();
        die( json_encode( $result ) );
    }

    public function wsUserUpdate()
    {
        $result = $this->users_model->wsUserUpdate();
        die( json_encode( $result ) );
    }
    
    public function wsUsePromoCode()
    {
        $result = $this->promo_model->usePromoCode();
        die( json_encode( $result ) );
    }

    public function wsPurchaseDeal()
    {
        $result = $this->deal_model->purchaseDeal();
        die( json_encode( $result ) );
    }
    
    public function wsPurchaseBuyCredit()
    {
        $result = $this->buycredit_model->purchaseBuycredit();
        die( json_encode( $result ) );
    }    
    
    public function wsDealList()
    {
        $result = $this->deal_model->dealList();
        $result = json_decode(json_encode( $result ));
        $result['result'] = 'success';
        $result['error'] = '';
        die( json_encode( $result ) );
    }
    
    public function wsVideoPlay() {
        $result = $this->card_model->videoPlay();
        die( json_encode( $result ) );        
    }
    
    public function wsAddAddressBook() {
        $result = $this->address_book_model->add();
        die( json_encode( $result ) );
    }
    
    public function wsUpdateAddressBook() {
        $result = $this->address_book_model->update();
        die( json_encode( $result ) );
    }

    public function wsRetrieveAddressBook() {
        $userId = $_POST['userId'];
        $data['addressBookList'] = $this->address_book_model->retrieve($userId);
        $data['result'] = 'success';
        $data['error'] = '';
        die( json_encode( $data ) );
    }
    
    public function wsDeleteAddressBook() {    
        $id = $_POST['id'];
        $result = $this->address_book_model->delete($id);
        die( json_encode( $result ) );
    }
}
