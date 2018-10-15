<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tablet_home extends CI_Controller {

	public function index() {
		
		$this->load->library('user_agent');
		$this->load->helper('url');
		
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
		
		echo $this->load->view('v3/tablet', $data);
		
	}
	
}