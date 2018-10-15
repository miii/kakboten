<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	public function index() {
		
		$this->load->model('v3_model');
		
		$this->load->library('user_agent');
		$this->load->helper('url');
		
		if ($this->agent->is_mobile()) redirect('http://mobil.kakboten.se/');
		
		$data['year'] = date('Y');
		$data['week'] = date('W');
		$day = date('N');
		
		if ($day > 5) {
			$data['week']++;
			$day = 1;
		}
		
		$day--;
		
		for($i = 0; $i < 5; $i++) {
			if ($i == $day) $data['class'][$i] = 'active';
			else $data['class'][$i] = '';
		}
		
		echo $this->load->view('v3/home', $data);
		
	}
	
}