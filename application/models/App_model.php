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

	
}