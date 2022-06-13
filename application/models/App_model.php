<?php
class App_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		//$this->db->db_debug = false;
	}
	
	public function create_signup($data){
		$table=TP."member";
		$data['added_on']=date('Y-m-d');
		$check = $this->check_member($data);
		if($check==false){
			$insert_status = $this->db->insert($table,$data);
			$last_id = $this->db->insert_id();
			$result = $this->create_wallet($last_id);
			if($result){
				return true;
			}else{
				return false;
			}

		}
	}
	public function create_wallet($last_id){
		$data['user_id'] = $last_id;
		$data['added_on']=date('Y-m-d');
		$table = 'wallet';
		$result = $this->db->insert($table,$data);
			if($result){
				return true;
			}else{
				return false;
			}
	}
	public function get_wallet($member_id){
		$qry=$this->db->get_where('wallet',array('user_id' => $member_id));
    	return $qry->row_array();
	}
	public function get_wallet_list($member_id){
		$this->db->limit(5);
		$this->db->order_by('id','DESC');
		$qry=$this->db->get_where('transaction',array('user_id' => $member_id));
		return $qry->result_array();
	}
	public function check_member($data){
		$email = $data['email'];
		$username = $data['username'];
		$qry=$this->db->get_where('org_member',array('email' => $email,'username'=>$username));
    	return $qry->num_rows();
    }

    public function login_model($data){
		$username = $data['username'];
		$password = $data['password'];
		$qry=$this->db->get_where('org_member',array('username' => $username,'password'=>$password));
    	return $qry->row_array();
    }

    public function add_share($data){
    	$final = array();
    	$final['member_id']=$_SESSION['member_id'];
    	$final['amount']=$data['amount'];
    	$final['quentity']=$data['quantity'];
    	$final['final_amount']=$data['amount']*$data['quantity'];
    	$final['stack_name'] = $data['stack_name'];
    	$final['date'] =date('Y-m-d');
    	$final['time'] =date('H:i:s');
    	$final['added_on']=date('Y-m-d H:i:s');
    	$table=TP.'member_share';
    	if(!empty($final)){
    		$insert_status = $this->db->insert($table,$final);
    		$_SESSION['last_id'] = $this->db->insert_id();
			if($insert_status){
				return true;
			}else{
				return false;
			}
    	}
    }

    public function get_amount($last_id){
    	$qry=$this->db->get_where('member_share',array('id' => $last_id));
    	return $qry->row_array();

    }


    public function tanscation_model($data){
    	// print_r($data);die;
    	$transcation['member_id'] = $_SESSION['member_id'];
    	$transcation['amount'] = $data['amount'];
    	$result = $this->wallet_update($transcation);
    	if($result){
    		$final['user_id']=$_SESSION['member_id'];
    		$final['trans_type'] = 'Withdraw';
    		$final['trans_amount'] = $data['amount'];
    		$final['added_on'] = date('Y-m-d H:i:s');
    		$result = $this->db->insert('org_transaction',$final);
    		unset($_SESSION['last_id']);
    		return $result;
    	}
    	else{
    		return $result;
    	}

    }
    public function wallet_update($transcation){
    	$id = $transcation['member_id'];
    	$amount = $transcation['amount'];
    	$qry=$this->db->get_where('org_wallet',array('user_id' => $id));
    	$record =  $qry->row_array();

    	$storage_amount = $record['cradit'];
    	$final_amount = $storage_amount-$amount;
    	$data['cradit'] = $final_amount;
    	$data['updated_on'] = date('Y-m-d H:i:s');
    	if(!empty($data)){
    		$this->db->where('user_id',$id);
    		$qry = $this->db->update('org_wallet',$data);
    		if($qry == true){
    			return $qry;
    		}else{
    			return false;
    		}
    	}
    }

    public function add_amount_model($data){
    	$data['user_id'] = $_SESSION['member_id'];
    	$data['date'] = date('Y-m-d');
    	$data['time'] = date('H:i:s');
    	$data['added_on'] = date('Y-m-d H:i:s');
    	$length = 15;
		$request_no=substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz', ceil($length/strlen($x)) )),1,$length);
		$data['request_no'] = $request_no;
			if(!empty($data['user_id'])){
				$status=$this->db->insert('org_payment',$data);
				if($status){
					$uploads['pay_id']=$this->db->insert_id();
					return $uploads;
				}
				else{
					return false;
				}

			}
    }



    public function member_details($pay_id){
    	$this->db->where('t1.id',$pay_id);		
    	$this->db->select('t1.*,t2.name,t2.email,t2.contact');
    	$this->db->from('org_payment t1');
    	$this->db->join('org_member t2','t1.user_id=t2.id','left');
    	$qry = $this->db->get();
    	return $qry->row_array();

    }

    public function trans_wallet(){
    	 $pay_id = $this->session->userdata('pay_id');
    	 $this->db->where('id',$pay_id);
    	 $this->db->select('amount');
    	 $this->db->from('org_payment');
    	 $qry = $this->db->get();
    	 $amt = $qry->row_array();
    	 if(!empty($amt)){
    	 	  return $this->update_wallet($amt);
    	 }
    	 else{
    	 	return false;
    	 }
    }

    public function update_wallet($amt){
		$user_id = $this->session->userdata('member_id');	
		$query=$this->db->get_where('wallet',array('user_id' => $user_id));
		$result =  $query->row_array();
		$amount = $result['cradit'];
		// print_r($amount);
		// print_r($amt);die;
		$total = $amount+$amt['amount'];
		if(!empty($total)){
			$data['cradit']=$total;
			           $this->db->where("user_id",$user_id); 
				  $qry= $this->db->update("wallet", $data); 
				  if($qry){
				  	return $this->update_transcation($amt);
				  }else{
				  	return false;
				  }
		}
    }

    public function update_transcation($amt){
    	$record['user_id'] = $this->session->userdata('member_id');
    	$record['trans_type'] = 'Cradit';
    	$record['trans_amount'] = $amt['amount'];
    	$record['added_on'] = date('Y-m-d H:i:s');
    	$result = $this->db->insert('org_transaction',$record);
    		return $result;
    	}

    	// '''''''''''''''''''''''product''''''''''''''''''''''''''''


    public function productslist(){
    	$this->db->where('t1.status',1);
		$this->db->select('t1.*,t2.name as category_name,t3.product_type,t4.brand');
		$this->db->from('product t1');
		$this->db->join('category t2','t1.catg_id=t2.id','left');
		$this->db->join('product_type t3','t1.type_id=t3.id','left');
		$this->db->join('brand t4','t1.brand_id=t4.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
    }


    public function product_details_by_id($id){
    	$this->db->where(['t1.status'=>1,'t1.id'=>$id]);
		$this->db->select('t1.*,t2.name as category_name,t3.product_type,t4.brand');
		$this->db->from('product t1');
		$this->db->join('category t2','t1.catg_id=t2.id','left');
		$this->db->join('product_type t3','t1.type_id=t3.id','left');
		$this->db->join('brand t4','t1.brand_id=t4.id','left');
		$qry = $this->db->get();
		return $qry->row_array();
    }

    public function add_cart_amount($data){
    	$check = $this->check_previous_cart_product($data);
    	if($check!=true){
    		$result = $this->db->insert('cart',$data);
    	    if($result){ return true; } else{ return false; }
    	}else{
    		return $check;
    	}	
    	
    }
    public function check_previous_cart_product($data){
    	$custmr_id = $data['customer_id'];
    	$prdt_id = $data['product_id'];
    	$qnty=$data['qty'];
    	$qry=$this->db->get_where('cart',array('customer_id' =>$custmr_id,'product_id'=>$prdt_id,'status'=>1));
    	$rows = $qry->num_rows();
    	if($rows>0){
    		$result = $qry->row_array();
    		$pre_qty = $result['qty'];
    		$id = $result['id'];
    		$final['qty']=$qnty+$pre_qty;
			$this->db->where("id",$id); 
			$qry= $this->db->update("cart",$final); 
			  if($qry){
			  	return $check['verify']= true;
			  }else{
			  	return $check['verify']='Not upload Please Try Again!';
			  }
    	}else{
    		return $check['verify']=false; 
    	}

    }
    public function count_cart($member_id){
    	$query=$this->db->get_where('cart',array('customer_id'=>$member_id,'status'=>1));
		return  $query->num_rows();
    }

    public function cart_list($member_id){
    	$this->db->where(['t1.status'=>1,'t1.customer_id'=>$member_id]);
		$this->db->select('t1.customer_id,t1.product_id,t1.qty,t2.*,t3.name as category_name,t4.product_type,t5.brand');
		$this->db->from('cart t1');
		$this->db->join('product t2','t1.product_id=t2.id','left');
		$this->db->join('category t3','t2.catg_id=t3.id','left');
		$this->db->join('product_type t4','t2.type_id=t4.id','left');
		$this->db->join('brand t5','t2.brand_id=t5.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
    }

    public function get_member_details($member_id){
    	$query=$this->db->get_where('member',array('id'=>$member_id,'status'=>1));
		return  $query->row_array();
    }

    public function add_add_place_order($data){
    	$result = $this->db->insert('order',$data);
    	$last_id = $this->db->insert_id();
    	$_SESSION['last_id'] = $last_id;
    	if(!empty($last_id)){
    		$final = $this->add_product_details($last_id);
    		return $final;
    	}
    	else{
    		return $result;
    	}
    }

    public function add_product_details($last_id){
    	$query=$this->db->get_where('order',array('id'=>$last_id,'status'=>1));
		$orderList = $query->row_array();
		if(!empty($orderList['order_no'])){
			$member_id = $_SESSION['member_id'];
			$this->db->where(['t1.customer_id'=>$member_id,'t1.status'=>1]);
			$this->db->select('t1.*,t2.catg_id,t2.product_name,t2.offer_price');
			$this->db->from('cart t1');
			$this->db->join('product t2','t1.product_id=t2.id','left');
			$qry = $this->db->get();
			$res = $qry->result_array();
			foreach ($res as $key => $value) {
				$create_arr = array('product_id'=>$value['product_id'],'qnty'=>$value['qty'],'category_id'=>$value['catg_id'],'product_name'=>$value['product_name'],'price'=>$value['offer_price'],'order_id'=>$orderList['order_no'],'added_on'=>date('Y-m-d H:i:s'));
				$main_arr[]=$create_arr;
			}
			$order_no = $orderList['order_no'];
			$prd_add = $this->create_product($main_arr);
			$prd_status=$this->add_status($order_no);
			// $payment=$this->add_payment($order_no);
			if($prd_add==true AND $prd_status==true AND $payment==true){
				return true;
			}else{
				return true;
			}
			
		}
    }

    public function create_product($main_arr){
    	if(!empty($main_arr)){
    		foreach ($main_arr as $key => $value) {
				$result = $this->db->insert('order_details',$value);
				$final_result['verify']=$result;
    		}
    		if($final_result['verify']==true){
	    		$id = $_SESSION['member_id'];
	    		$this->db->where('customer_id',$id);
	    		$del = $this->db->delete('cart');
	    		if($del){ return true; }else{ return false; }
    		}
    	}
    	else{ return false; }	
    }

    public function add_status($order_no){
    	$array_status['order_id'] = $order_no;
    	$array_status['order_status'] = 1;
    	$array_status['added_on'] = date('Y-m-d');
    	$result = $this->db->insert('order_status',$array_status);
		return $result;

    }

    public function order_list($id){
    	$this->db->where(['t1.id'=>$id,'t1.status'=>1]);
		$this->db->select('t1.*,t2.name,t2.email,t2.contact');
		$this->db->from('order t1');
		$this->db->join('member t2','t1.customer_id=t2.id','left');
		$qry = $this->db->get();
		return  $qry->row_array();
    }

    public function insert_payment($order_id,$payment_id,$paymentdetail){
    	$insertstatus= $this->db->insert('product_payment',array('order_id'=>$order_id,'payment_details'=>$paymentdetail,'payment_id'=>$payment_id,'added_on'=>date('Y-m-d H:i:s')));
    	return $insertstatus;

    }
    public function update_order(){
    	$id = $_SESSION['last_id'];
    	$this->db->where('id',$id);
    	$update_status = $this->db->update('order',array('payment_status'=>1));
    	if($update_status==true){
    		unset($_SESSION['last_id']);
    		return true;
    	}
    	else{
    		return false;
    	}

    }



	
}