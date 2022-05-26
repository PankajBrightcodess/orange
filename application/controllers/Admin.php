<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function stack(){
		$data['title']="Stack";
		$data['datatable']=true;
		$data['list']=$this->Account_model->stacklist();
		$this->template->load('pages','stack',$data);
	}

	public function save_stack(){
		$data =$this->input->post();

		$result = $this->Account_model->add_stack($data);
		if($result['verify']){
			$this->session->set_flashdata("msg","Insert Successfully !!");
			redirect('admin/stack/');
		}else{
			$this->session->set_flashdata("err_msg","Try Again !!");
			redirect('admin/stack/');
		}
	}

	public function edit_stack(){
		$id=$this->input->get('id');
		$data['list']=$this->Account_model->getlist_byid($id);
		$data['title']="Edit Stack";
		$this->template->load('pages','edit_stack',$data);
	}

	public function update_stack(){
		$data = $this->input->post();
		$result=$this->Account_model->stack_update($data);
		if($result['verify']){
			$this->session->set_flashdata("msg","Update Successfully !!");
			redirect('admin/stack/');
		}else{
			$this->session->set_flashdata("err_msg","Try Again !!");
			redirect('admin/stack/');
		}
	}

	public function delete_stack(){
		$id = $this->input->get('id');
		$result=$this->Account_model->stack_delete($id);
		if($result['verify']){
			$this->session->set_flashdata("msg","Delete Successfully !!");
			redirect('admin/stack/');
		}else{
			$this->session->set_flashdata("err_msg","Try Again !!");
			redirect('admin/stack/');
		}

	}

	public function userlist(){
		$data['title']="User List";
		$data['datatable']=true;
		$data['userlist']=$this->Account_model->userlist_model();
		$this->template->load('pages','user_list',$data);
	}

	public function update_user(){
		$data = $this->input->post();
		$result=$this->Account_model->update_userlist_model($data);
		if($result['verify']){
			$this->session->set_flashdata("msg","Update Successfully !!");
			redirect('admin/userlist/');
		}else{
			$this->session->set_flashdata("err_msg","Try Again !!");
			redirect('admin/userlist/');
		}
	}

	public function delete_user(){
		$id = $this->input->get('id');
		$result=$this->Account_model->user_delete($id);
		if($result['verify']){
			$this->session->set_flashdata("msg","Delete Successfully !!");
			redirect('admin/userlist/');
		}else{
			$this->session->set_flashdata("err_msg","Try Again !!");
			redirect('admin/userlist/');
		}
	}

	public function user_wallet(){
		$data['title']="User Wallet";
		$data['datatable']=true;
		$data['wallet']=$this->Account_model->userwallet_model();
		$this->template->load('pages','user_wallet',$data);
	}

	public function usershare_list(){
		$data['title']="User Share";
		$data['datatable']=true;
		$data['share']=$this->Account_model->usershare_model();
		$this->template->load('pages','user_share_list',$data);
	}



	// '''''''''''''''''''''''''''''''''''''''''''''PRODUCRT UNDER CONSTRUCTION'''''''''''''''''''''''''''''''''''''''''''''''''
	public function category(){
		$data['title']="Product Category";
		$data['datatable']=true;
		$data['categorylist']=$this->Account_model->categorylist();
		$this->template->load('pages','category',$data);
	}

	public function add_category(){
		$data = $this->input->post();
	  	unset($data['save_cat']);
		  if(!empty($_FILES['image']['name']))
		  {
		      $upload_path = './assets/admin_upload/category/';
	    	  $allowed_types = 'gif|jpg|jpeg|png|pdf|GIF|JPG|JPEG|PNG|PDF';
	    	  $result1 = upload_file("image",$upload_path,$allowed_types, time());
			  $src1=$result1['path'];
	       	  if(!empty($src1)){
	            $data['image'] = $src1;
	          }   
		  }
		$result=$this->Account_model->category_add($data);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Add Successfully !!");
	 		redirect('admin/category/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/category/');
	 	}  
	}

	public function update_category(){
		$data=$this->input->post();
		if(empty($data['image'])){
			unset($data['image']);
		}
		 if(!empty($_FILES['image']['name']))
		  {
		      $upload_path = './assets/admin_upload/category/';
	    	  $allowed_types = 'gif|jpg|jpeg|png|pdf|GIF|JPG|JPEG|PNG|PDF';
	    	  $result1 = upload_file("image",$upload_path,$allowed_types, time());
			  $src1=$result1['path'];
	       	  if(!empty($src1)){
	            $data['image'] = $src1;
	          } 
	       }
	       $result = $this->Account_model->category_update($data);
		if($result['verify']){
			$this->session->set_flashdata("msg","Update Successfully !!");
	 		redirect('admin/category/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/category/');
	 	}
}

	public function delete_category(){
		$id = $this->input->get('id');
		$result=$this->Account_model->category_delete($id);
		if($result['verify']){
			$this->session->set_flashdata("msg","Delete Successfully !!");
			redirect('admin/category/');
		}else{
			$this->session->set_flashdata("err_msg","Try Again !!");
			redirect('admin/category/');
		}
	}


	public function product_type(){
		$data['title']="Product Type";
		$data['datatable']=true;
		// $data['categorylist']=$this->Account_model->categorylist();
		$this->template->load('pages','product_type',$data);
	}

	public function add_product_type(){
		$data = $this->input->post();
	  	unset($data['save_cat']);
	  	// echo PRE;
		  // print_r($data);die;
		$result=$this->Account_model->producttype_add($data);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Add Successfully !!");
	 		redirect('admin/category/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/category/');
	 	}  
	}
}