<?php
class Account_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
	
	public function createadmin($data){
		$table=TP."users";
		$salt=random_string('alnum', 16);
		$password=md5($data['password'].SITE_SALT.$salt);
		$data['vp']=$data['password'];
		$data['password']=$password;
		$data['salt']=$salt;
		$data['created_on']=date('Y-m-d H:i:s');
		$data['updated_on']=date('Y-m-d H:i:s');
		$data['status']=1;
		if($this->db->insert($table,$data)){
			return true;
		}
	}
	
	public function login($data){
		$table=TP."users";
		$username=$data['username'];		
		$password=$data['password'];
		$this->db->where('username', $username);
		$query = $this->db->get($table);
		$result=$query->unbuffered_row('array');
		if(!empty($result)){
			$salt=$result['salt'];
			$password=md5($password.SITE_SALT.$salt);
			$hashpassword=$result['password'];
			if($password==$hashpassword && $result['status']==1){
				$result['verify']=true;
			}
		}
		if(!isset($result['verify'])){ $result=array('verify'=>"Wrong Credentials!"); }
		return $result;
	}
	
	public function createotp($username){
		$table=TP."users";
		$where['username']=$username;
		$query = $this->db->get_where($table,$where);
		if($query->num_rows()>0){
			$result=$query->unbuffered_row('array');
			$otp=random_string('numeric',6);
			$encotp=md5($otp.SITE_SALT.$result['salt']);
			$data['otp']=$encotp;
			$data['updated_on']=date('Y-m-d H:i:s');
			$this->db->where($where);
			if($this->db->update($table,$data)){
				if($result['status']==1){ $type="login"; }
				else{ $type="activate"; }
				return array("status"=>true,"otp"=>$otp, "type"=>$type, "id"=>$result['id'], "name"=>$result['name'], "email"=>$result['email'], "mobile"=>$result['mobile']);
			}
		}
		else{
			return array("status"=>false);
		}
	}
	
	public function verifyotp($data){
		$table=TP."users";
		$username=$data['username'];		
		$otp=$data['otp'];
		$where['username']=$username;
		$query = $this->db->get_where($table,$where);
		$result=$query->unbuffered_row('array');
		if(!empty($result)){
			if(time()-strtotime($result['updated_on'])<900){
				$salt=$result['salt'];
				$otp=md5($otp.SITE_SALT.$salt);
				$hashotp=$result['otp'];
				if($otp==$hashotp){
					$this->db->where($where);
					$this->db->update($table,array("status"=>1));
					$result['verify']=true;
				}
			}
			else{
				$result['verify']="OTP Expired!";
			}
		}
		if(!isset($result['verify'])){ $result['verify']="Invalid OTP!"; }
		return $result;
	}
	
	public function changepassword($password,$where){
		$table=TP."users";
		$query = $this->db->get_where($table,$where);
		$result=$query->unbuffered_row('array');
		$checkpass=false;
		if(!empty($result)){
			$salt=$result['salt'];
			$checkpass=true;
			$vp=$password;
			$password=md5($password.SITE_SALT.$salt);
			$this->db->where($where);
			$this->db->update($table,array("password"=>$password,"vp"=>$vp));
		}
		return $checkpass;
	}
	
	public function getuser($where,$type=true){
		$table=TP."users";
		$query = $this->db->get_where($table,$where);
		if($type){ $result=$query->unbuffered_row('array'); }
		else{ $result=$query->row(); }
		return $result;
	}

	public function getsidebar($where=array(),$type='all',$like=array()){
		if(!empty($like)){
            $this->db->like($like);
        }
        $this->db->order_by('position');
       $query = $this->db->get_where('sidebar',$where);
       if($type == 'all'){
           $return = $query->result_array();
       }else{
           $return = $query->unbuffered_row('array');
       }
       return $return;
    }

    public function savesidebar($postdata){
        unset($postdata['save_cat']);
        if(empty($postdata['activate_not'])){
            $postdata['activate_not'] = '{"0":""}';
        }
        if(empty($postdata['position'])){
            $postdata['position'] = 0;
        }
		if(!empty($postdata['icon'])){
            if(preg_match('/nav-icon/',$postdata['icon']) == 0){
                $icon_text = str_replace('class="','class="nav-icon ',$postdata['icon']);
                $postdata['icon'] = $icon_text;
            }
        }
        if(!empty($postdata['role_id'])){
            $role_array = explode('|',$postdata['role_id']);
            $role = array();
            if(!empty($role_array)){                
                foreach($role_array as $r){
                    $role[] = "\"$r\"";
                }                
            }else{
                $role[] = "\"1\"";
            }
            $postdata['role_id'] = implode(',',$role);
        }
        $position=$postdata['position'];
        if($postdata['parent']!=0){
			if($position==0){
				$this->db->where("id",$postdata['parent']);
				$query = $this->db->get("sidebar");
				$array=$query->unbuffered_row('array');
				$postdata['position']=$position=$array['position'];
			}
			if($postdata['status']==1){
				$query="UPDATE ".TP."sidebar set `status`='1' where `id`='$postdata[parent]'";
				$this->db->query($query);
			}
		}
		else{
			$this->db->select_max('position');
			$this->db->where("parent=(select id from ".TP."sidebar where `position`='$postdata[position]')");
			$query = $this->db->get("sidebar");
			$array=$query->row_array();
			if($array['position']!=0){
				$postdata['position']=$position=$array['position'];
			}
		}
        $query="UPDATE ".TP."sidebar set `position`=`position`+1 where `position`>'$position'";
		$this->db->query($query);
		$postdata['position']++;
        
        $insert_status = $this->db->insert('sidebar',$postdata);
        if($insert_status){
            return $postdata['position'];
        }else{
            return false;
        }
    }

    public function deletesidebar($id){
        $update_status = $this->db->update('sidebar',array('status'=>'0'),array('id'=>$id,'status'=>'1'));
        if($update_status){
            return true;
        }else{
            return false;
        }
    }

    public function update_sidebar($postdata){
        unset($postdata['save_cat']);
        $edit_id = $postdata['edit_id'];
        unset($postdata['edit_id']);
        if(empty($postdata['activate_not'])){
            $postdata['activate_not'] = '{"0":""}';
        }
        if(empty($postdata['position'])){
            $postdata['position'] = 0;
        }
		if(!empty($postdata['icon'])){
            if(preg_match('/nav-icon/',$postdata['icon']) == 0){
                $icon_text = str_replace('class="','class="nav-icon ',$postdata['icon']);
                $postdata['icon'] = $icon_text;
            }
        }
        if(!empty($postdata['role_id'])){
            $role_array = explode('|',$postdata['role_id']);
            $role = array();
            if(!empty($role_array)){                
                foreach($role_array as $r){
                    $role[] = "\"$r\"";
                }                
            }else{
                $role[] = "\"1\"";
            }
            $postdata['role_id'] = implode(',',$role);
        }
        
		$where="id='$edit_id' or parent='$edit_id'";
		$this->db->order_by('position');
		$getquery=$this->db->get_where("sidebar",$where);
		$array=$getquery->result_array();
        //Array ( [0] => Array ( [id] => 16 [activate_menu] => home [activate_not] => {"0":""} [base_url] => payment/report/ [icon] => [name] => adsfa [parent] => 12 [position] => 4 [role_id] => "member" [status] => 1 ) )
        if(is_array($array)){
			foreach($array as $key=>$row){
				$i=0;
				if($row['parent']==0){
					if($postdata['position']>$row['position']){ $postdata['position']-=count($array); }
					$array[$key]['activate_menu']=$postdata['activate_menu'];
					$array[$key]['activate_not']=$postdata['activate_not'];
					$array[$key]['base_url']=$postdata['base_url'];
					$array[$key]['icon']=$postdata['icon'];
					$array[$key]['name']=	$postdata['name'];
					$array[$key]['parent']=$postdata['parent'];
					$array[$key]['position']=$postdata['position'];
					$array[$key]['role_id']=$postdata['role_id'];
					$array[$key]['status']=$postdata['status'];
				}
				else{
					if($key>0){
						$array[$key]['position']=	$i++;
						$array[$key]['status']=$postdata['status'];
					}
					else{
						if($postdata['position']>$row['position']){ $postdata['position']-=count($array); }
						$array[$key]['activate_menu']=$postdata['activate_menu'];
						$array[$key]['activate_not']=$postdata['activate_not'];
						$array[$key]['base_url']=$postdata['base_url'];
						$array[$key]['icon']=$postdata['icon'];
						$array[$key]['name']=	$postdata['name'];
						$array[$key]['parent']=$postdata['parent'];
                        $array[$key]['position']=$postdata['position'];
                        $array[$key]['role_id']=$postdata['role_id'];
                        $array[$key]['status']=$postdata['status'];
					}
				}
			}
		}
        $this->db->delete("sidebar",$where);
		$this->reordermenu();
		$neworder=$array[0]['position'];
		if(is_array($array)){
			foreach($array as $key=>$data){
				if($key>1){
					$data['position']=++$neworder;
				}
				$neworder=$this->savesidebar($data);
			}
		}
    }

    public function getdynamic_sidebar(){
        // need to have role
        $role = $this->session->role;        
		$parentsidebar = $this->getsidebar(array('status'=>'1','parent'=>'0'),'all',array('role_id'=>"\"$role\""));
		$returnsidebar = array(); 
		$returnsidebar = $this->getall_parentwise_sidebar($parentsidebar);
       	return $returnsidebar;
    }

    public function getall_parentwise_sidebar($allsidebarparentid){
        $returnarray = array();
		$role = $this->session->role;
        if(!empty($allsidebarparentid)){
            foreach($allsidebarparentid as $key=>$oneid){
                $returnarray[$key] =$this->getsidebar(array('id'=>$oneid['id'],'status'=>'1'),'single',array('role_id'=>"\"$role\""));
                $onesubdata = $this->getsidebar(array('parent'=>$oneid['id'],'status'=>'1'),'all',array('role_id'=>"\"$role\""));
                if(!empty($onesubdata)){
                    $returnarray[$key]['submenu'] = $onesubdata;
                }else{
                    $returnarray[$key]['submenu'] = 0;
                }
            }
        }
        return $returnarray;
    }
	
	public function getOrderList($parent_id=0){
		$this->db->where("parent",$parent_id);
		$this->db->order_by('position');
		$query = $this->db->get("sidebar");
		$data=$query->result_array();
		return $data;
	}
	
	public function reordermenu(){
		$this->db->order_by('position');
		$getquery=$this->db->get_where("sidebar");
		$array=$getquery->result_array();
		if(is_array($array)){
			$i=0;
			foreach($array as $key=>$row){
				$i++;
				$update=array("position"=>$i);
				$this->db->update("sidebar",$update,array("id"=>$row['id']));
			}
		}
	}

	public function add_stack($data){
		unset($data['save_cat']);
		$data['added_on']= date('Y-m-d');
		$insert_stack['verify'] = $this->db->insert('share',$data);
        if($insert_stack['verify']){
            return $insert_stack;
        }else{
            return false;
        }
	}

	public function stacklist($type='all'){
	  $query = $this->db->get_where('share',array('status'=>1));
	  if($type == 'all'){
          $return = $query->result_array();
       }else{
          $return = $query->unbuffered_row('array');
       }
       return $return;
	}

	public function getlist_byid($id,$type = 'all'){
		$query = $this->db->get_where('share',array('status'=>1,'id'=>$id));
		  if($type == 'all'){
	          $return = $query->result_array();
	       }else{
	          $return = $query->unbuffered_row('array');
	       }
       return $return;

	}

	public function stack_update($data){
		unset($data['update_cat']);
		$this->db->where("id",$data['id']);
		$result['verify'] = $this->db->update('share',$data);
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}

	public function stack_delete($id){
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('share',array('status'=>0));
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}


	public function userlist_model(){
		$getquery=$this->db->get_where("member",array('status'=>1));
		$array=$getquery->result_array();
		return $array;
	}

	public function update_userlist_model($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('member',$data);
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}

	public function user_delete($id){
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('member',array('status'=>0));
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}

	public function userwallet_model(){
		$this->db->select('t1.*,t2.name,t2.email,t2.contact');
		$this->db->from('wallet t1');
		$this->db->join('member t2','t1.user_id=t2.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
	}

	public function usershare_model(){
		$this->db->order_by('id','DESC');
		$this->db->select('t1.*,t2.name,t2.email,t2.contact');
		$this->db->from('member_share t1');
		$this->db->join('member t2','t1.member_id=t2.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
	}

	public function category_add($data){
		$data['added_on']=date('Y-m-d');
		$result['verify'] = $this->db->insert('category',$data);
        if($result['verify']){
            return $result;
        }else{
            return false;
        }
	}

	public function categorylist(){
		$table=TP."category";
		$query = $this->db->get_where($table, array('status'=>1));
		$result=$query->result_array();
		return $result;
	}

	public function category_update($data){
		$id = $data['id'];
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('category',$data);
		if($result){
		   return $result;
		}
		else{
			return $result;
		}
	}

	public function category_delete($id){
		$this->db->where('id',$id);
		$result['verify'] = $this->db->update('category',array('status'=>0));
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}

	public function brand_add($data){
		$data['added_on']=date('Y-m-d');
		$result['verify'] = $this->db->insert('brand',$data);
        if($result['verify']){
            return $result;
        }else{
            return false;
        }
	}

	public function producttype_add($data){
		$data['added_on']=date('Y-m-d');
		$result['verify'] = $this->db->insert('product_type',$data);
        if($result['verify']){
            return $result;
        }else{
            return false;
        }
	}

	public function producttypelist(){
		$this->db->where('t1.status',1);
		$this->db->select('t1.*,t2.name as category_name');
		$this->db->from('product_type t1');
		$this->db->join('org_category t2','t1.catg_id=t2.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
	}

	public function producttype_update($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('product_type',$data);
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}

	public function producttype_delete($id){
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('product_type',array('status'=>0));
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}

	public function brandlist(){
		$this->db->where('t1.status',1);
		$this->db->select('t1.*,t2.name as category_name');
		$this->db->from('brand t1');
		$this->db->join('category t2','t1.catg_id=t2.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
	}

	public function brand_update($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('brand',$data);
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}


	public function brand_delete($id){
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('brand',array('status'=>0));
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}


	public function productlist(){
		$this->db->where('t1.status',1);
		$this->db->select('t1.*,t2.name as category_name,t3.product_type,t4.brand');
		$this->db->from('product t1');
		$this->db->join('category t2','t1.catg_id=t2.id','left');
		$this->db->join('product_type t3','t1.type_id=t3.id','left');
		$this->db->join('brand t4','t1.brand_id=t4.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
	}



	// '''''''''''''''''''''Product Area''''''''''''''''''''''''''

	// public function get_ptype_brand_list($id){
	// 	$ptype = $this->get_project_type_list($id);
	// 	$brand = $this->get_brand_list($id);
	// 	$allresult['product_type'] = $ptype;
	// 	$allresult['brand'] = $brand;
	// 	 return $allresult;
	// }
	public function get_project_type_list($id){
		$query = $this->db->get_where('product_type', array('status'=>1,'catg_id'=>$id));
		$result=$query->result_array();
		return $result;
	}

	public function get_brand_list($id){
		$query = $this->db->get_where('brand', array('status'=>1,'catg_id'=>$id));
		$result=$query->result_array();
		return $result;
	}

	public function product_add($data){
		unset($data['save_cat']);
		$data['added_on']=date('Y-m-d H:i:s');
		$result['verify'] = $this->db->insert('product',$data);
        if($result['verify']){
            return $result;
        }else{
            return false;
        }
	}

	public function update_product_model($data){
		$id = $data['id'];
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('product',$data);
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}

	public function product_delete_model($id){
		$this->db->where("id",$id);
		$result['verify'] = $this->db->update('product',array('status'=>0));
		if($result){
			return $result;
		}
		else{
			return $result;
		}
	}

	public function get_orderlist(){
		$this->db->select('t1.*,t2.name,t2.contact as mobile_no,t2.email');
		$this->db->from('org_order t1');
		$this->db->join('org_member t2','t1.customer_id=t2.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
	}

	public function order_listing($order_no){
		$this->db->where('t1.order_id',$order_no);
		$this->db->select('t1.order_id,t1.qnty,t2.*');
		$this->db->from('order_details t1');
		$this->db->join('product t2','t1.product_id=t2.id','left');
		$qry = $this->db->get();
		return $qry->result_array();
	}

	





}