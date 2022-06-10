<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_control extends CI_Controller {
	function __construct(){
		parent::__construct();
		check_and_setcookie();
		// cart_count();
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
    	$data['products'] = $this->App_model->productslist();
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
    	if(!empty($_SESSION['pay_id'])){
    		$pay_id = $this->session->userdata('pay_id');
    		$data['payment'] = $this->App_model->member_details($pay_id);
	    	$data['title']='Make Payment';
	    	$this->load->view('app/include/header-link',$data);
	    	$this->load->view('app/include/header');
	    	$this->load->view('app/include/sidebar');
	    	$this->load->view('app/make_payment',$data);
	    	$this->load->view('app/include/footer');
	    	$this->load->view('app/include/footer-link');

    	}
    	

    }
    
    public function singleproduct(){
    	// $id = $this->input->get('id');
    	$id=$this->uri->segment(3);
    	$data['product_details'] = $this->App_model->product_details_by_id($id);
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
    	if(!empty($_SESSION['last_id'])){
    	  $last_id = $_SESSION['last_id'];
				$data['amount']=$this->App_model->get_amount($last_id);
    	}
    	$member_id = $_SESSION['member_id'];
    	$data['member_wallet']=$this->App_model->get_wallet($member_id);
    	$data['wallet_list']=$this->App_model->get_wallet_list($member_id);
			$data['title']='Balance';
			$this->load->view('app/include/header-link',$data);
			$this->load->view('app/include/header5');
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

    public function add_wallet_payment(){
		$data['title']='Add Payment';
		$this->load->view('app/include/header-link',$data);
		$this->load->view('app/include/header2');
		$this->load->view('app/include/sidebar');
		$this->load->view('app/add_payment');
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
    	$this->load->view('app/include/header4');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/history');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

    public function payment_method(){
    	$data['title']='Payment Method';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header4');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/payment_method');
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
 			$data['list']=$this->Account_model->stacklist();
    	$data['title']='Silver Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/silver');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }
    public function gold(){
    	$data['list']=$this->Account_model->stacklist();
    	$data['title']='Gold Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/gold');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }
      public function currency(){
      	$data['list']=$this->Account_model->stacklist();
    	$data['title']='Currency Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/currency');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
     }
     public function platinum(){
     	$data['list']=$this->Account_model->stacklist();
    	$data['title']='Currency Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/platinum');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
     }

     public function profile(){
    	$data['title']='Currency Stake';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/profile');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
     }

     public function our_team(){
     	$data['title']='Our Team Earn';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/our_team');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
     }

      public function payment_success(){
    	$data['title']='Payment Method';
    	$this->load->view('app/include/header-link',$data);
    	$this->load->view('app/include/header4');
    	$this->load->view('app/include/sidebar');
    	$this->load->view('app/payment_method');
    	$this->load->view('app/include/footer');
    	$this->load->view('app/include/footer-link');
    }

     // ''''''''''''''''''''''''''''''''''''''''''''''''backed work'''''''''''''''''''''''''''''''''''''''''''''''''''

     public function signup(){
     	$data =  $this->input->post();
     	// echo PRE;
     	// print_r($data);die;
     	if($data['registration']=='on'){
     		$result = $this->App_model->create_signup($data);
     		if($result){
     			$this->session->set_flashdata('web_msg','Your Account Successfully Created');
     		  redirect('app_control/otp');
     		}else{
     			$this->session->set_flashdata('web_err_msg','Please Try Again!');
     		  redirect('app_control/register');
     		}	
     	}else{
     		$this->session->set_flashdata('web_err_msg','Error');
     		redirect('app_control/register');
     	}
     }

     public function otp_check(){
     	$data = $this->input->post();
     	$user_otp  = $data['first'].$data['second'].$data['third'].$data['forth'];
     	if(!empty($user_otp)){
     		$this->session->set_flashdata('web_msg','Your Mobile Verified');
     		  redirect('app_control/login');
     	}else{
     			$this->session->set_flashdata('web_err_msg','Please Try Again!');
     		  redirect('app_control/otpconfirm');
     	}
     }

     public function check_login(){
     		$data=$this->input->post();
     		$result = $this->App_model->login_model($data);
     		if(!empty($result)){
     			 $this->createsession($result);
     			$this->session->set_flashdata('web_msg','Successfully Login');
     		  redirect('app_control/home');
     		}else{
     			$this->session->set_flashdata('web_err_msg','Please Try Again!');
     		  redirect('app_control/login');
     		}	
     }

	   public function createsession($result){
	   	// echo PRE;
	   	  // print_r($result);die;
				$data['member_id']=$result['id'];
				$data['name']=$result['name'];
				$data['email']=$result['email'];
				$data['contact']=$result['contact'];
				$this->session->set_userdata($data);
				$this->update_cookie();
			}

	public function update_cookie(){
		 $this->load->helper('cookie');
		 		$member_id = $this->session->userdata('member_id');
        $name = $this->session->userdata('name');
        $email = $this->session->userdata('email');
        $contact = $this->session->userdata('contact');
        $cookiearray = array('member_id'=>$member_id,'name'=>$name,'email'=>$email,'contact'=>$contact);
        $json = base64_encode(json_encode($cookiearray));
        $cookie = array(
	        'name'   => 'login_cookie',
	        'value'  => $json,
	        'expire' => '2592000'        
         ); 
		     $this->load->helper('cookie');
         $this->input->set_cookie($cookie);
	}

	public function logout(){
		$data=array("member_id","name","email","contact");
		$this->session->unset_userdata('member_id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('contact');
		// unset($data);	
		$this->load->helper('cookie');
      	delete_cookie('login_cookie');
		redirect('app_control/login');
	}

	public function create_share(){
		$data = $this->input->post();
		$result = $this->App_model->add_share($data);
   		if(!empty($result)){	
   		  redirect('app_control/payment_method');
   		}else{
   			$this->session->set_flashdata('web_err_msg','Please Try Again!');
   		  redirect('app_control/home');
   		}	
	}

	public function redirectpages(){
		 redirect($_SERVER['HTTP_REFERER']);  
	}

	public function transcation(){
		$data = $this->input->post();
		$result = $this->App_model->tanscation_model($data);
		if($result){
			echo $result;
		}
	}

	public function add_amount(){
		$data=$this->input->post();
		$result = $this->App_model->add_amount_model($data);
   		if(!empty($result)){	
   			$this->session->set_userdata($result);
   		  redirect('app_control/make_payment');
   		}else{
   			$this->session->set_flashdata('web_err_msg','Please Try Again!');
   		  redirect('app_control/home');
   		}	

	}

	public function success(){
      $postdata = $this->input->post();
      $payment_id = $postdata ['razorpay_payment_id'];
      $paymentdetail = json_encode($postdata);
      $pay_id = $this->session->userdata('pay_id');
      //$order_array = json_decode($order_id,true);
      if(!empty($pay_id)){
            $updatestatus= $this->db->update('payment',array('payment_status'=>'1','payment_details'=>$paymentdetail,'payment_id'=>$payment_id),array('id'=>$pay_id));
            // $this->session->unset_userdata('pay_id');
            if($updatestatus==true){
            	$update = $this->App_model->trans_wallet();
            	// print_r($update);die;
            		redirect('app_control/payment_success');
                $this->session->set_flashdata('request_msg',"Order Placed Successfully !!");
            }else{
            	$this->session->set_flashdata('request_err_msg',"Order Not Placed");
            }
                 
      }      
      redirect('/');
    }


    public function add_cart(){
    	$data = $this->input->post();
    	$member_id = $_SESSION['member_id'];
    	$data['customer_id']=$member_id;
    	$data['added_on']=date('Y-m-d');
    	$result = $this->App_model->add_cart_amount($data);
    	if($result){	
   			$this->session->set_userdata($result);
   		  redirect('app_control/redirectpages');
   		}else{
   			$this->session->set_flashdata('web_err_msg','Please Try Again!');
   		  redirect('app_control/redirectpages');
   		}

    }

    public function cart_count(){
    	$member_id = $_SESSION['member_id'];
    	$result = $this->App_model->count_cart($member_id);
    	
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
