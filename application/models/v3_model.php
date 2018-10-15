<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class v3_model extends CI_Model {
	
	public $defaultImage = 'images/v3/nofood.png';
	
	// Enable or disable caching
	private $cacheQuery = true;
	
	// Method to fetch food from specific day & week
	public function fetchFood($week, $day) {
		
		// Load cache driver
		$this->load->driver('cache');
		
		// Current year, define $n for later use
		$year = (int) date('Y');
		$n = 0;
		
		// If caching is enabled
		if ($this->cacheQuery && $this->cache->file->get("{$year}-{$week}-{$day}")) return $this->replaceNoFoodImage($this->cache->file->get("{$year}-{$week}-{$day}"));
		
		// Ask for food + veg earlier served dates
		$query = $this->db->query("
		
		SELECT *
		FROM (menu)
		JOIN food ON menu.food_id = food.id OR menu.veg_id = food.id
		WHERE food.id = (SELECT food_id FROM menu WHERE menu.year = {$year}
		AND menu.week =  {$week}
		AND menu.day =  {$day}
		AND menu.school_id =  0)
		OR food.id = (SELECT veg_id FROM menu WHERE menu.year = {$year}
		AND menu.week =  {$week}
		AND menu.day =  {$day}
		AND menu.school_id =  0)
		ORDER BY food.type, menu.year DESC, menu.week DESC, menu.day DESC

		");
				
		// Run the query
		$result = $query->result();
		
		// If there's no results, return
		if (!$result) return false;
		
		// Loop through the queried rows
		foreach($result as $row) {
			
			// If food id is unknown, add new id
			if(!isset($id[$row->id])) $id[$row->id] = $n++;
			
			// Save row data as array in $raw
			$raw[$id[$row->id]][] = get_object_vars($row);
			
		}
		
		// Save the food data for later use in the content view
		$data['food'] = $raw[0][0];
		$data['veg'] = isset($raw[1]) ? $raw[1][0] : $raw[0][0];
		
		// Unset todays date from history
		unset($raw[0][0], $raw[1][0]);
		$data['raw'] = $raw;
	
		// Only save last 5 dates
		$data['raw'][0] = array_slice($data['raw'][0], 0, 5);
		$data['raw'][1] = array_slice($data['raw'][1], 0, 5);
		
		// Save result into cache if food is served this week
		if ($this->cacheQuery && $week - date('W') >= 0 && $week - date('W') <= 1) $this->cache->file->save("{$year}-{$week}-{$day}", $data, 86400);
	
		return $this->replaceNoFoodImage($data);
		
	}
	
	public function replaceNoFoodImage($data) {
		
		if (empty($data['food']['image_url'])) $data['food']['image_url'] = $this->defaultImage;
		if (empty($data['veg']['image_url'])) $data['veg']['image_url'] = $this->defaultImage;
		
		return $data;
		
	}
	
}

?>