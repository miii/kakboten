<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mobile_home extends CI_Controller {

	public function index() {
		
		$this->load->model('jb_model');
		$this->jb_model->checkFoodData();
		
		$this->load->library('user_agent');
		$this->load->helper('url');
		$this->load->model('v3_model');
		
		$data['year'] = date('Y');
		$data['week'] = date('W');
		$day = date('N');
		
		if ($day > 5) {
			$data['week']++;
			$day = 1;
		}
		
		$day--;
		
		$food = $this->v3_model->fetchFood((int) $data['week'], (int) $day + 1);
		if (!$food) return false;
		
		echo $this->load->view('v3/mobile', $food);
		
	}
	
}