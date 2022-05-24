<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function stack(){
		$data['title']="Stack";
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
}