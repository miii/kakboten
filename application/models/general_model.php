<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model {
	
	public $defaultImage = 'images/defaultImage.png';
	public $schoolsURL = array('jb');	
	public $type = array('food' => 0, 'veg' => 1);
	public $colors = array('09F', 'D00', 'BA00FF', 'EB7F15', '2C9C15');
	public $daysURL = array('mandag', 'tisdag', 'onsdag', 'torsdag', 'fredag');
	public $days = array('Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag');
	
	public $header = array(	
		
		'title'			=>	'Käkboten',
		'description' 	=>	'Käkboten levererar information om dagens käk på din skola med möjlighet att kommentera, gilla och söka på maträtter och tillfällen. Allt på ett snyggt och smidigt sätt!',
		'keywords'		=>	'käkboten, kakboten, jb, gävle, john, bauergymnasiet, bauer, gymnasiet, matsedel, mat, käk, ångköket, thoren, bot',
		
		'ogType'		=> 'blog',
		'ogImage'		=> 'images/logo/fb_image.png',
		
		'fbAdmins'		=> '100000758672423',
		'fbAppID'		=> '175974195843586',
		
		'mobile'		=> false
	
	);
	
	public function __construct() {
		
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()) $this->header['mobile'] = true;
		
		$random = rand(0, 4);
		$this->header['logoColor'] = $this->colors[$random];
		
		$this->defaultImage = base_url() . $this->defaultImage;
		
	}

	public function fixFoodString($foodString, $length) {
		
		if (strlen($foodString) > $length) {
			
			if(strlen($foodString) > $length - 3) {
				
				$foodString = preg_replace('#^(.+) ([A-ZÅÄÖa-zåäö0-9]+)\s*$#', '$1', $foodString);
				
			}
			
			$foodString .= '...';
			
		}

		return $foodString;
		
	}

	public function toAscii($str, $replace=array(), $delimiter='-') {
			
			if( !empty($replace) ) {
				$str = str_replace((array)$replace, ' ', $str);
			}
		
			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		
			return $clean;
			
	}
	
	public function array_searchRecursive($needle, $haystack, $strict=false, $path=array()) {
		
	    if( !is_array($haystack) ) {
	        return false;
	    }
	 
	    foreach( $haystack as $key => $val ) {
	        if( is_array($val) && $subPath = $this->array_searchRecursive($needle, $val, $strict, $path) ) {
	            $path = array_merge($path, array($key), $subPath);
	            return $path;
	        } elseif( (!$strict && $val == $needle) || ($strict && $val === $needle) ) {
	            $path[] = $key;
	            return $path;
	        }
	    }
	    return false;
	}
	
	public function getFoodImage($imageURL) {
		
		if (empty($imageURL)) return $this->defaultImage;
		else return $imageURL;
		
	}
	
	############################################################################################################################
	
	public function insertFoodData($menu, $foodArray) {
		
		$noError = true;
		
		foreach($menu as $day) {
			
			$menuQuery = $this->db->insert('menu', $day);
			if (!$menuQuery) $noError = false;
			
		}
		
		foreach($foodArray as $food) {
			
			$foodQuery = $this->db->insert('food', $food);
			if (!$foodQuery) $noError = false;
			
		}
		
		if (!$noError) log_message('error', 'Insert Food Data Failed');
		
		return $noError;
		
	}
	
	public function today($schoolID) {
		
		$year = (int) date('Y');
		$week = (int) date('W');
		
		if ($day == 0) $day = 7;
		
		$this->db->select('food.food, food.url, food.image_url');
		$this->db->from('menu');
		$this->db->join('food', 'menu.food_id = food.id OR menu.veg_id = food.id');
		$this->db->where('menu.year', $year);
		$this->db->where('menu.week', $week);
		$this->db->where('menu.day', $day);
		$this->db->where('menu.school_id', $schoolID);
		$this->db->order_by('food.type', 'asc');
		$this->db->limit(2);
		
		$query = $this->db->get();
		$result = $query->result();
		
		if (!$result) return false;
		
		$data['food'] = get_object_vars($result[0]);
		if (isset($result[1])) $data['veg'] = get_object_vars($result[1]);
		
		$data['year'] = $year;
		$data['week'] = $week;
		$data['dayURL'] = $this->daysURL[$day - 1];
		$data['dayString'] = $this->days[$day - 1];
	
		return $data;
		
	}
	
	public function menu($schoolID, $day, $week, $year) {
		
		$day++;
		
		$this->db->select('food.food, food.url, food.image_url');
		$this->db->from('menu');
		$this->db->join('food', 'menu.food_id = food.id OR menu.veg_id = food.id');
		$this->db->where('menu.year', $year);
		$this->db->where('menu.week', $week);
		$this->db->where('menu.day', $day);
		$this->db->where('menu.school_id', $schoolID);
		$this->db->order_by('food.type', 'asc');
		$this->db->limit(2);
		
		$query = $this->db->get();
		$result = $query->result();
		
		if (empty($result)) return false;
		
		$data['food'] = get_object_vars($result[0]);
		if (isset($result[1])) $data['veg'] = get_object_vars($result[1]);
		
		$data['year'] = $year;
		$data['week'] = $week;
		$data['dayURL'] = $this->daysURL[$day - 1];
		$data['dayString'] = $this->days[$day - 1];
	
		return $data;
		
	}
	
	public function foodpage($schoolID, $foodURL) {
		
		$foodURL = $this->db->escape_str($foodURL);
		
		$year = (int) date('Y');
		$week = (int) date('W');
		
		$day = (int) date('w');
		if ($day == 0) $day = 7;
		
		$this->db->select('food.id, food.type, food.food, food.image_url, COUNT(menu.id) as served');
		$this->db->from('food');
		$this->db->join('menu', "(food.id = menu.food_id OR food.id = menu.veg_id) AND ((menu.week < {$week}) OR (menu.week <= {$week} AND menu.day <= {$day}))", 'left');
		$this->db->where('food.url', $foodURL);
		$this->db->limit(1);
		
		$query = $this->db->get();
		$result = $query->result();
		
		$data = get_object_vars($result[0]);
		
		if ($data['served'] > 0) {
			
			$this->db->select('year, week, day, food_id, veg_id');
			$this->db->from('menu');
			$this->db->where("food_id = {$data['id']} OR veg_id = {$data['id']} AND ((menu.week < {$week}) OR (menu.week <= {$week} AND menu.day <= {$day}))");
			
			$query = $this->db->get();
			$result = $query->result();
			
			$c = 0;

			foreach($result as $row) {
				
				$foodData = get_object_vars($row);
				
				$data['servedArray'][$c]['date']['year'] = $foodData['year'];
				$data['servedArray'][$c]['date']['week'] = $foodData['week'];
				$data['servedArray'][$c]['date']['day'] = $this->days[$foodData['day'] - 1];
				
				$data['servedArray'][$c]['food'] = $foodData['food_id'] == $data['id'] ? true : false;
				$data['servedArray'][$c]['veg'] = $foodData['veg_id'] == $data['id'] ? true : false;
				
				$c++;
				
			}
			
		}
		
		if (is_null($data['food'])) return false;
	
		return $data;
		
	}
	
	public function getYearsAndWeeks($schoolID) {
		
		$this->db->select('DISTINCT(week)');
		$this->db->from('menu');
		$this->db->where('school_id', $schoolID);
		
		$query = $this->db->get();
		$result = $query->result();
		
		foreach($result as $row) {
			
			$temp = get_object_vars($row);
			$weeks[] = $temp['week'];	
			
		}
		
		$this->db->select('DISTINCT(year)');
		$this->db->from('menu');
		$this->db->where('menu.school_id', $schoolID);
		
		$query = $this->db->get();
		$result = $query->result();
		
		foreach($result as $row) {
			
			$temp = get_object_vars($row);
			$years[] = $temp['year'];	
			
		}
	
		return array('years' => $years, 'weeks' => $weeks);
		
	}
	
	public function search($schoolID, $searchQuery) {
		
		$searchQuery = $this->db->escape_str($searchQuery);
		
		$this->db->select('food.food, food.type, food.url, COUNT(*) as served');
		$this->db->from('food');
		$this->db->join('menu', 'food.id = menu.food_id OR food.id = menu.veg_id');
		$this->db->like('food.food', $searchQuery);
		$this->db->where('food.food', $schoolID);
		$this->db->group_by('food.id');
		$this->db->order_by("CASE WHEN food.food LIKE '{$searchQuery}' THEN 0 WHEN food.food LIKE '{$searchQuery}%' THEN 1 ELSE 2 END");
		$this->db->ar_orderby[0] = str_replace('`CASE`', 'CASE', $this->db->ar_orderby[0]);
		$this->db->order_by('served', 'desc');
		$this->db->order_by('food.type', 'asc');
		$this->db->order_by('food.food', 'asc');
		
		$query = $this->db->get();
		$result = $query->result();
		$data = array();
		
		foreach ($result as $i => $row) {
			
			$data[$i] = get_object_vars($row);
			$data[$i]['query'] = $searchQuery;
			
		}
	
		return $data;
		
	}
	
	#######################################################################################
	
	public function adminGetFoodList($smartSort = true) {
		
		$day = (int) date('d');
		$week = (int) date('W');
		
		if ($day > 5 || $day < 1) $week++;
	
		$this->db->select('food.*, menu.school_id');
		$this->db->from('food');
		$this->db->join('menu', 'food.id = menu.food_id OR food.id = menu.veg_id');
		$this->db->group_by('food.id');
		
		if ($smartSort) {
			
			$this->db->order_by('CASE WHEN LENGTH(food.image_url) < 1 THEN 0 ELSE 1 END');
			$this->db->ar_orderby[0] = str_replace('`CASE`', 'CASE', $this->db->ar_orderby[0]);
			$this->db->order_by("CASE WHEN menu.week >= {$week} THEN 0 ELSE 1 END");
			$this->db->ar_orderby[1] = str_replace('`CASE`', 'CASE', $this->db->ar_orderby[1]);
			$this->db->order_by('menu.week', 'asc');
			$this->db->order_by('menu.day', 'asc');
			
		} else {
			$this->db->order_by('food.food', 'asc');
		}
		
		$this->db->order_by('food.type', 'asc');
		
		$query = $this->db->get();
		$result = $query->result();
		
		$data = array();
		$foodTotal = 0;
		$hasImage = 0;
		
		foreach ($result as $i => $row) {
			
			$data[$i] = get_object_vars($row);
			
			$foodTotal++;
			if (!empty($data[$i]['image_url'])) $hasImage++;
			
			$data[$i]['school_id'] = $this->schoolsURL[$data[$i]['school_id']];
			
		}
	
		return array('foodArray' => $data, 'foodTotal' => $foodTotal, 'hasNotImage' => ($foodTotal - $hasImage));
		
	}
	
	public function adminSaveImages($imageArray) {
		
		$imageArray = (array) $imageArray;
		
		foreach($imageArray as $id => $data) {
			
			if ($data['new'] !== $data['old']) {
				
				$this->db->where('id', $id);
				$query = $this->db->update('food', array('image_url' => $data['new']));
				if (!$query) log_message('error', "Admin: Failed to Save Image (foodID: {$id}, image_url: {$data['new']})");
			
			}
			
		}
		
	}

	public function adminGetMergelist($foodIDs) {
		
		$foods = 0;
		
		foreach($foodIDs as $foodID => $selected) {
			
			if (!empty($selected)) {
					
				$this->db->or_where('food.id', $foodID);
				$foods++;
				
			}
			
		}
		
		if ($foods < 2) redirect('haxor/merge');
	
		$this->db->select('food.*, menu.school_id');
		$this->db->from('food');
		$this->db->join('menu', 'food.id = menu.food_id OR food.id = menu.veg_id', 'inner');
		$this->db->group_by('food.id');
		$this->db->order_by('COUNT(menu.id)', 'desc');
		$this->db->order_by('food.image_url', 'desc');
		
		$query = $this->db->get();
		$result = $query->result();
		$onlyVeg = true;
		
		foreach ($result as $i => $row) {
			
			$data[$i] = get_object_vars($row);
			$data[$i]['school_id'] = $this->schoolsURL[$data[$i]['school_id']];
			
			if ($data[$i]['type'] == 0) $onlyVeg = false;
			
		}
		
		return array('foodArray' => $data, 'onlyVeg' => $onlyVeg);
		
	}

	public function adminMergeFood($formData) {
		
		if (empty($formData)) redirect('haxor/merge/');
		
		$this->db->insert('food', $formData['new']);
		$insertID = $this->db->insert_id();
		
		foreach($formData['old'] as $id) {
		
			$foodData['food_id'] = $insertID;
			$this->db->where('menu.food_id', $id);
			$this->db->update('menu', $foodData);
			
			$vegData['veg_id'] = $insertID;
			$this->db->where('menu.veg_id', $id);
			$this->db->update('menu', $vegData);
			
		}
		
		foreach($formData['old'] as $id) {
			
			$this->db->or_where('food.id', $id);
			
		}
		
		$this->db->delete('food');
		
	}

	public function adminEditFood($url) {
		
		$this->db->select('*');
		$this->db->from('food');
		$this->db->where('url', $url);
		
		$query = $this->db->get();
		$result = $query->result();
		
		if (empty($result)) redirect('haxor');
		
		return get_object_vars($result[0]);
		
	}

	public function adminSaveEdit($formData) {
		
		if (empty($formData)) redirect('haxor/merge/');
		
		$this->db->where('id', $formData['id']);
		unset($formData['id']);
		
		$this->db->update('food', $formData);
		
	}
	
}

?>