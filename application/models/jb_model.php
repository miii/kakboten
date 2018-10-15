<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jb_model extends CI_Model {
	
	private $schoolID = 0;
	
	public function checkFoodData() {
		
		$year = (int) date('Y');
		$week = (int) date('W');
		
		$this->db->select('MAX(week) as lastWeek');
		$this->db->from('menu');
		$this->db->where('year', $year);
		$this->db->limit(1);
		
		$query = $this->db->get();
		$result = $query->result();
		$data = get_object_vars($result[0]);
		
		if ($week > $data['lastWeek']) $this->saveMenu();
		
	}

	public function saveMenu() {
		
		log_message('error', '[JB] No Food Data Exists, Parsing new data...');
		
		header('Content-Type: text/html; charset=utf-8');
		mb_internal_encoding('UTF-8');
		
		$html = file_get_contents('http://angkoket.se/?PageID=4950');
		$jb = explode('Matsedel: Engelska skolan och John Bauer i', $html);
		
		preg_match_all("#<(strong|em|b).*>(.+)</(strong|em|b)>#", $jb[1], $matches);
		//unset($matches[2][0]);
		
		$days = $this->general_model->days;
		$dbID = 0;
		$uniqueID = 1;
		
		$query = $this->db->query('SHOW TABLE STATUS LIKE "food"');
		$result = $query->result();
		
		$tableStatus = get_object_vars($result[0]);
		$uniqueID = $tableStatus['Auto_increment'];
		
		$query = $this->db->get('food');
		$foodArray['raw'] = array();
		$menu = array();
		
		foreach($query->result() as $row) {
			
			$row = get_object_vars($row);
			
			$foodArray['raw'][$row['id']] = $row['food'];
			
		}
		
		foreach($matches[0] as $id => $value) {
			
			$value = str_replace('&nbsp;' , ' ', $value);
			$value = preg_replace('#\s*$#' , '', $value);
			$value = utf8_encode($value);
			$value = html_entity_decode($value, ENT_COMPAT, 'UTF-8');
			$value = strip_tags($value);
			
			//if (preg_match('#^V\s*([0-9]{1,2}).*$#', $value, $match)) {
			if (preg_match('#^V\s*([0-9]{1,2}).*$#', $value, $match)) {
				
				$i = (int) $match[1];
				$c = 0;
				
			} elseif (preg_match('#^Veg\:\s*(.+)\s*#', $value, $match)) {
				
				$veg = ucfirst($match[1]);
				
				if (!in_array($veg, $foodArray['raw'])) {
					
					$foodArray['raw'][] = $veg;
					
					$foodArray[$uniqueID]['food'] = $veg;
					$foodArray[$uniqueID]['url'] = $this->general_model->toAscii($veg);
					$foodArray[$uniqueID]['type'] = $this->general_model->type['veg'];
					
					$vegID = $uniqueID;
					$uniqueID++;
					
				} else {
					
					$getFoodID = $this->general_model->array_searchRecursive($veg, $foodArray);
					$vegID = (int) $getFoodID[1];
					
				}
			
				$menu[$dbID]['school_id'] = $this->schoolID;
				$menu[$dbID]['year'] = date('Y');
				$menu[$dbID]['week'] = $i;
				$menu[$dbID]['day'] = $c;
				$menu[$dbID]['food_id'] = $foodID;
				$menu[$dbID]['veg_id'] = $vegID;
			
				$dbID++;
				
			} elseif (in_array($value, $days)) {
				
				$c++;
				
			} elseif ($value !== 'Klicka här') {
			
				$food = preg_replace("#^\s*(.+)\s*$#", '$1', $value);
				$food = ucfirst($food);
				
				if (!in_array($food, $foodArray['raw'])) {
					
					$foodArray['raw'][] = $food;
					
					$foodArray[$uniqueID]['food'] = $food;
					$foodArray[$uniqueID]['url'] = $this->general_model->toAscii($food);
					$foodArray[$uniqueID]['type'] = $this->general_model->type['food'];
					
					$foodID = (int) $uniqueID;
					$uniqueID++;
					
				} else {
					
					$getFoodID = $this->general_model->array_searchRecursive($food, $foodArray);
					$foodID = $getFoodID[1];
					
				}
				
			}
			
		}

		ksort($foodArray['raw']);

		unset($foodArray['raw']);
		
		return $this->general_model->insertFoodData($menu, $foodArray);
		
	}
	
}