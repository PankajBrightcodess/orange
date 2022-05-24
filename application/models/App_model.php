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

	
}