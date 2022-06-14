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
		// print_r($data['categorylist']);die;
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
		$data['product_list']=$this->Account_model->producttypelist();
		// echo PRE;
		// print_r($data['product_list']);die;
		$categorys=$this->Account_model->categorylist();

		// $statelist = $this->Master_model->getall_state(array('type' =>'state'), 'all');
        $categoryoption = array();
        $categoryoption[''] = '-- Select Category --';
        if (!empty($categorys)) {
            foreach ($categorys as $list) {
                $categoryoption[$list['id']] = $list['name'];
            }
        }
        $data['categorys'] = $categoryoption;
		$this->template->load('pages','product_type',$data);
	}


	public function update_product_type(){
		$data = $this->input->post();
		$result=$this->Account_model->producttype_update($data);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Update Successfully !!");
	 		redirect('admin/product_type/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/product_type/');
	 	} 
	}
	public function delete_product_type(){
		$id = $this->input->get('id');
		$result=$this->Account_model->producttype_delete($id);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Update Successfully !!");
	 		redirect('admin/product_type/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/product_type/');
	 	} 
	}

	public function add_product_type(){
		$data = $this->input->post();
	  	unset($data['save_cat']);
	  	// echo PRE;
		  // print_r($data);die;
		$result=$this->Account_model->producttype_add($data);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Add Successfully !!");
	 		redirect('admin/product_type/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/product_type/');
	 	}  
	}

	public function brand(){
		$data['title']="Brand";
		$data['datatable']=true;
		$data['brand_list']=$this->Account_model->brandlist();

		$categorys=$this->Account_model->categorylist();
        $categoryoption = array();
        $categoryoption[''] = '-- Select Category --';
        if (!empty($categorys)){
            foreach ($categorys as $list) {
              $categoryoption[$list['id']] = $list['name'];
            }
        }
        $data['categorys'] = $categoryoption;
		$this->template->load('pages','brand',$data);
	}

	public function add_brand(){
		$data = $this->input->post();
		unset($data['save_cat']);
		$result=$this->Account_model->brand_add($data);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Add Successfully !!");
	 		redirect('admin/brand/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/brand/');
	 	}
	}

	public function update_brand(){
		$data = $this->input->post();
		$result=$this->Account_model->brand_update($data);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Update Successfully !!");
	 		redirect('admin/brand/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/brand/');
	 	} 
	}

	public function delete_brand(){
		$id = $this->input->get('id');
		// echo PRE;
		// print_r($id);die;
		$result=$this->Account_model->brand_delete($id);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Update Successfully !!");
	 		redirect('admin/product_type/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/product_type/');
	 	} 
	}

	// ''''''''''''''''''''''''''''''''''Product Area''''''''''''''''''''''''''''''''''''''''''

	public function product(){
		$data['title']="Product";
		$data['datatable']=true;
		$data['products']=$this->Account_model->productlist();
		$categorys=$this->Account_model->categorylist();
        $categoryoption = array();
        $categoryoption[''] = '-- Select Category --';
        if (!empty($categorys)) {
            foreach ($categorys as $list) {
                $categoryoption[$list['id']] = $list['name'];
            }
        }
        $data['categorys'] = $categoryoption;
		$this->template->load('pages','product',$data);
	}

	public function ajax_ptype(){
		$id = $this->input->post('catg_id');
		$result=$this->Account_model->get_project_type_list($id);
		// $categorys=$this->Account_model->categorylist();
       	if(!empty($result)){
       		$html= '<option>--Select Product Type--</option>';
   			foreach ($result as $key => $value) {
   				$html.= '<option value="'.$value['id'].'">'.$value['product_type'].'</option>';
   			}
       	}
       	echo $html;
	}

	public function ajax_brand(){
		$id = $this->input->post('catg_id');
		$result=$this->Account_model->get_brand_list($id);
        if(!empty($result)){
       		$html= '<option>--Select Brand--</option>';
   			foreach ($result as $key => $value) {
   				$html.= '<option value="'.$value['id'].'">'.$value['brand'].'</option>';
   			}
       	}
       	echo $html;
	}

	public function add_product(){
		$data=$this->input->post();
		 if(!empty($_FILES['image']['name']))
		  {
		      $upload_path = './assets/admin_upload/product/';
	    	  $allowed_types = 'gif|jpg|jpeg|png|pdf|GIF|JPG|JPEG|PNG|PDF';
	    	  $result1 = upload_file("image",$upload_path,$allowed_types, time());
			  $src1=$result1['path'];
	       	  if(!empty($src1)){
	            $data['image'] = $src1;
	          }   
		  }
		$result=$this->Account_model->product_add($data);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Add Successfully !!");
	 		redirect('admin/product/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/product/');
	 	} 
	}

	public function update_product(){
		$data = $this->input->post();
		if(!empty($_FILES['image']['name'])){
			$upload_path = './assets/admin_upload/product/';
	    	  $allowed_types = 'gif|jpg|jpeg|png|pdf|GIF|JPG|JPEG|PNG|PDF';
	    	  $result1 = upload_file("image",$upload_path,$allowed_types,time());
			  $src1=$result1['path'];
	       	  if(!empty($src1)){
	            $data['image'] = $src1;
	          } 
		}
		$result=$this->Account_model->update_product_model($data);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Update Successfully !!");
	 		redirect('admin/product/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/product/');
	 	}
	}


	public function product_delete(){
		$id = $this->input->get('id');
		$result=$this->Account_model->product_delete_model($id);
	 	if($result['verify']){
	 		$this->session->set_flashdata("msg","Delete Successfully !!");
	 		redirect('admin/product/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/product/');
	 	} 
	}


	public function image(){
		$data['id'] = $this->input->get('id');
		$data['title']="Add Extra Product Image";
		$data['datatable']=true;
		$this->template->load('pages','add_image',$data);
	}
	public function add_image(){
		$id = $this->input->post('id');
		  $count=  count($_FILES['image']['name']);
		$name = $_FILES['image']['name'];
		$type = $_FILES['image']['type'];
		$tmp_name = $_FILES['image']['tmp_name'];
		$error = $_FILES['image']['error'];
		$size = $_FILES['image']['size'];
		for ($i=0; $i < $count; $i++) { 
			$arr = array(['name'=>$name[$i],'type'=>$type[$i],'tmp_name'=>$tmp_name[$i],'error'=>$error[$i],'size'=>$size[$i]]);
			$_FILES[]=$arr;
		}
			$_FILES[$name]['tmp_name'];die;
		if(!empty($final)){
			foreach ($final as $key => $value) {
				if(!empty($value[0]['name'])){
					$upload_path = './assets/admin_upload/product/';
			        $allowed_types = 'gif|jpg|jpeg|png|pdf|GIF|JPG|JPEG|PNG|PDF';
			    	$result1 = upload_file("image",$upload_path,$allowed_types,time());
					$src1=$result1['path'];
			       	if(!empty($src1)){
			          $data['image'] = $src1;
			        } 
				}
	          } 
			
			}
		}


	public function order_list(){
		$data['title']="Order List";
		$data['datatable']=true;
		$data['orderlist']=$this->Account_model->get_orderlist();
		$this->template->load('pages','order_list',$data);
	}

	public function order_product(){
		$order_no = $this->uri->segment(3);
		$data['title']="Order List";
		$data['datatable']=true;
		$data['orderproduct']=$this->Account_model->order_listing($order_no);
		$this->template->load('pages','order_product_list',$data);

	}

	public function update_delivery_status(){
		$data = $this->input->post();
		$result=$this->Account_model->update_deliverystatus($data);
		if(!empty($result)){
	 		$this->session->set_flashdata("msg","Delivery Status Successfully !!");
	 		redirect('admin/order_list/');
	 	}else{
	 		$this->session->set_flashdata("err_msg","Try Again !!");
	 		redirect('admin/order_list/');
	 	} 
	}

		
		
	}?>