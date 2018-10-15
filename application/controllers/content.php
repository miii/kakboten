<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class content extends CI_Controller {

	public function get($week, $day) {
		
		$this->load->model('v3_model');
		
		$this->load->model('jb_model');
		
		$this->jb_model->checkFoodData();
		
		$data = $this->v3_model->fetchFood((int) $week, (int) $day + 1);
		
		if (!$data) return false;
		
		$data['foodHistory'] = '';
		$data['vegHistory'] = '';
		
		foreach($data['raw'][0] as $history) $data['foodHistory'] .= $this->load->view('v3/history', array('history' => $history), true);
		foreach($data['raw'][1] as $history) $data['vegHistory'] .= $this->load->view('v3/history', array('history' => $history), true);
		
		echo $this->load->view('v3/content', $data);
		
	}
	
	public function tutorial() {
		
		echo $this->load->view('v3/tutorial');
		
	}
	
}