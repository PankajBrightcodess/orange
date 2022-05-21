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
			if($insert_status){
				return true;
			}else{
				return false;
			}

		}
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

	
}