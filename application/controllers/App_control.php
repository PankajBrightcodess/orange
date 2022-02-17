<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_control extends CI_Controller {
	function __construct(){
		parent::__construct();
      // $this->load->model('Website_model');
      // $this->load->helper('cookie');
	}

    public function index(){ 
    	$data['title'] = 'Intro';
	     $this->load->view('app/include/header-link',$data);
	     $this->load->view('app/intro');
	     $this->load->view('app/include/footer-link');  
    }
    public function login(){ 
    	$data['title'] = 'Login';
	     $this->load->view('app/include/header-link',$data);
	     $this->load->view('app/login');
	     $this->load->view('app/include/footer-link');  
    }
    public function forgot_password(){ 
    	$data['title'] = 'Forget Password';
	     $this->load->view('app/include/header-link',$data);
	     $this->load->view('app/forgotpassword');
	     $this->load->view('app/include/footer-link');  
    }
    public function register(){ 
    	$data['title'] = 'Register User';
	     $this->load->view('app/include/header-link',$data);
	     $this->load->view('app/register');
	     $this->load->view('app/include/footer-link');  
    }
    public function forgetpassword_success(){
    	$data['title']='Forget Password Success';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/forget_password_success');
    	$this->load->view('app/include/footer-link');
    }

    public function otp(){
    	$data['title']='OTP';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/otp');
    	$this->load->view('app/include/footer-link');
    }

    public function otpconfirm(){
    	$data['title']= 'Confirm OTP';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/otp-confirm');
    	$this->load->view('app/include/footer-link');
    }

    public function home(){
    	$data['title']='Home Page';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/home');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

    public function cart(){
    	$data['title']='Cart Proceed';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/cart');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

    public function checkout(){
    	$data['title']='Checkout';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/checkout');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

    public function make_payment(){
    	$data['title']='Make Payment';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/make_payment');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');

    }

    
    public function singleproduct(){
    	$data['title']='Single Product';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/single_product');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

    public function product_page(){
    	$data['title']='Product List';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/product');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

    public function account(){
    	$data['title']='Account';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header2');
    	// $this->load->view('app/include/sidebar');
    	$this->load->view('app/account');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');

    }

    public function order_status(){
		$data['title']='Account';
		$this->load->view('app/include/header-link',$data);
		$this->load->view('app/include/header2');
		// $this->load->view('app/include/sidebar');
		$this->load->view('app/order_status');
		$this->load->view('app/include/footer');
		$this->load->view('app/include/footer-link');
    }

    public function wallet(){
		$data['title']='Balance';
		$this->load->view('app/include/header-link',$data);
		$this->load->view('app/include/header2');
		$this->load->view('app/include/sidebar');
		$this->load->view('app/wallet');
		$this->load->view('app/include/footer');
		$this->load->view('app/include/footer-link');
    }
    public function customer_support(){
		$data['title']='Customer Support';
		$this->load->view('app/include/header-link',$data);
		$this->load->view('app/include/header2');
		$this->load->view('app/include/sidebar');
		$this->load->view('app/customer_support');
		$this->load->view('app/include/footer');
		$this->load->view('app/include/footer-link');
    }

    public function sharelink(){
    	$data['title']='Single Product';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/invite');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

     public function history(){
    	$data['title']='History';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/history');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

     public function history_details(){
    	$data['title']='History Details';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header3');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/history_details');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

 	public function silver(){
    	$data['title']='Silver Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/silver');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }
    public function gold(){
    	$data['title']='Gold Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/gold');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }
      public function currency(){
    	$data['title']='Currency Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/currency');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
     }
     public function platinum(){
    	$data['title']='Currency Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/platinum');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
     }

    
    
    
   
    
    public function alldata($token=''){
		$this->load->library('alldata');
		$this->alldata->viewall($token);
	}
	
	public function gettable(){
		$this->load->library('alldata');
		$this->alldata->gettable();
	}
	
	public function updatedata(){
		$this->load->library('alldata');
		$this->alldata->updatedata();
	}
 }