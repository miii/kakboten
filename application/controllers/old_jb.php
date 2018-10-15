<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class old_jb extends CI_Controller {
	
	private $schoolID = 0;
	private $school = 'jb';
	private $schoolFull = 'John Bauergymnasiet';
	private $footerData = array(
	
		'facebookLink'	=>	'https://www.facebook.com/pages/K%C3%A4kboten-John-Bauergymnasiet/256583497745874'
	
	);
	
	private function checkFoodData() {
		
		$this->load->model('jb_model');
		
		$year = (int) date('Y');
		$week = (int) date('W');
		
		$this->db->select('MAX(week) as lastWeek');
		$this->db->from('menu');
		$this->db->where('year', $year);
		$this->db->limit(1);
		
		$query = $this->db->get();
		$result = $query->result();
		$data = get_object_vars($result[0]);
		
		if ($week > $data['lastWeek']) $this->jb_model->saveMenu();
		
	}

	public function index() {
		
		$this->checkFoodData();
		
		$data = $this->general_model->today($this->schoolID);
		
		if (!$data) return $this->noFood();
		
		$data['schoolURL'] = $this->school;
		$data['food']['image_url'] = $this->general_model->getFoodImage($data['food']['image_url']);
		
		$data['shortFood'] = $this->general_model->fixFoodString($data['food']['food'], 36);
		$data['page'] = 'menu';
		
		$header = $this->general_model->header;
		$header['title'] .= " {$this->schoolFull} - Dagens käk";
		$this->load->view('header', $header);
		
		$this->load->view('menu', $data);
		$this->load->view('footer', $this->footerData);
		
	}
	
	public function noFood() {
		
		$this->checkFoodData();
		
		$header = $this->general_model->header;
		$header['title'] .= " {$this->schoolFull} - Du blev aldrig bjuden";
		
		$data['schoolURL'] = $this->school;
		
		$this->load->view('header', $header);
		$this->load->view('noFood', $data);
		$this->load->view('footer', $this->footerData);
		
	}
	
	public function meny($dayString = '') {
		
		$this->checkFoodData();
		
		$dayArray = explode('-', $dayString);
		
		if (count($dayArray) == 4) {
			
			$day = array_search($dayArray[0], $this->general_model->daysURL);
			$week = (int) $dayArray[2];
			$year = (int) $dayArray[3];
			
			if (is_int($day) && $dayArray[1] == 'vecka') {
			
				$data = $this->general_model->menu($this->schoolID, $day, $week, $year);
				
				if ($data) {
			
					$data['schoolURL'] = $this->school;
					$data['food']['image_url'] = $this->general_model->getFoodImage($data['food']['image_url']);
					
					$header = $this->general_model->header;
					$header['title'] .= " {$this->schoolFull} - {$data['dayString']}, vecka {$data['week']}, {$data['year']}";

					$data['shortFood'] = $this->general_model->fixFoodString($data['food']['food'], 36);
					$data['page'] = 'menu';
					
					$footer = $this->footerData;
					$footer['food'] = $data['food']['food'];
					$footer['shortFood'] = $data['shortFood'];
					
					$this->load->view('header', $header);
					$this->load->view('menu', $data);
					$this->load->view('footer', $footer);
					
					return true;
					
				}
				
			}
			
			
		}
		
		$this->noFood();
		return false;
		
	}
	
	public function matratt($foodURL = '') {
		
		$this->checkFoodData();
		
		$data = $this->general_model->foodpage($this->schoolID, $foodURL);
		
		if ($data) {
			
			$data['foodURL'] = $foodURL;
			$data['schoolURL'] = $this->school;
			$data['imageURL'] = $this->general_model->getFoodImage($data['image_url']);
			
			$header = $this->general_model->header;
			$header['title'] .= " {$this->schoolFull} - {$data['food']}";
			
			$data['shortFood'] = $this->general_model->fixFoodString($data['food'], 35);
			
			$this->load->view('header', $header);
			$this->load->view('foodpage', $data);
			$this->load->view('footer', $this->footerData);
			
		} else $this->noFood();
		
	}
	
	public function sok() {
		
		$this->checkFoodData();
		
		$data = $this->general_model->getYearsAndWeeks($this->schoolID);
		
		$data['yearnow'] = date('Y');
		$data['weeknow'] = date('W');
		$data['daynow'] = date('w') - 1;
		if ($data['daynow'] < 0 || $data['daynow'] > 4) $data['weeknow']++;
		if ($data['weeknow'] > 52) $data['yearnow']++;
		
		$data['schoolURL'] = $this->school;
		
		$data['daysURL'] = $this->general_model->daysURL;
		$data['days'] = $this->general_model->days;
		
		$header = $this->general_model->header;
		$header['title'] .= " {$this->schoolFull} - Sök";
		
		$this->load->view('header', $header);
		$this->load->view('search', $data);
		$this->load->view('footer', $this->footerData);
	
	}
	
	public function searchResults() {
		
		$searchQuery = $this->input->post('query');
		
		if (strlen($searchQuery) < 3) return false;
		$data = $this->general_model->search($this->schoolID, $searchQuery);
		
		foreach ($data as $id => $row) {
			
			$row['class'] = $id % 2 == 0 ? 'dark' : '';
			$row['schoolURL'] = $this->school;
			
			$this->load->view('searchResults', $row);
			
		}
	
	}
	
}