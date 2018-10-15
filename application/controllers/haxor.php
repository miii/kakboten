<?php

class Haxor extends CI_Controller
{
	
	function index()
	{
		$this->load->library('session');
		if (!$this->session->userdata('login')) redirect('/haxor/login/');
		
		if ($this->input->post('food')) {
			
			$this->general_model->adminSaveImages($this->input->post('food'));
			
		}
		
		$data = $this->general_model->adminGetFoodList();
		$this->load->view('admin/header');
		$this->load->view('admin/index', $data);
	}
	
	function merge()
	{
		$this->load->library('session');
		if (!$this->session->userdata('login')) redirect('/haxor/login/');
		
		$data = $this->general_model->adminGetFoodList(false);
		$this->load->view('admin/header');
		$this->load->view('admin/merge', $data);
	}
	
	function mergepage()
	{
		$this->load->library('session');
		if (!$this->session->userdata('login')) redirect('/haxor/login/');
		
		$data = $this->general_model->adminGetMergelist($this->input->post('merge'));
		$this->load->view('admin/header');
		$this->load->view('admin/mergepage', $data);
	}
	
	function mergesave()
	{
		$this->load->library('session');
		if (!$this->session->userdata('login')) redirect('/haxor/login/');
		
		$this->general_model->adminMergeFood($this->input->post('merge'));
		
		redirect('/haxor');
	}
	
	function edit($url)
	{
		$this->load->library('session');
		if (!$this->session->userdata('login')) redirect('/haxor/login/');
		
		$data['data'] = $this->general_model->adminEditFood($url);
		$this->load->view('admin/header');
		$this->load->view('admin/edit', $data);
	}
	
	function editsave()
	{
		$this->load->library('session');
		if (!$this->session->userdata('login')) redirect('/haxor/login/');
		
		$this->general_model->adminSaveEdit($this->input->post('edit'));
		
		redirect('/haxor');
	}
	
	function save()
	{
		$this->load->library('session');
		if (!$this->session->userdata('login')) redirect('/haxor/login/');
			
		$this->general_model->adminSaveImages($this->input->post('food'));
		
		redirect('/haxor/');
	}
	
	function login()
	{
		$this->load->library('session');
		
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		
		if ($this->session->userdata('login')) $this->session->unset_userdata('login');
		
		if ($user == 'admin' && $pass == 'kakbotenadmin12') {
		
			$data = array('login' => true);
			$this->session->set_userdata($data);
			redirect('/haxor');
			
		} else return $this->load->view('login');
	}
	
}

?>