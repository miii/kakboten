<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb extends CI_Controller
{

	private $indexhash = '';
	
	private $appID = '';
	private $appSecret = '';
	private $pageID = '';
	
	private $accessToken = '';
	private $expire = 'Jun 3 2012';
	
	function index($hash = '') {
		
		if ($hash !== $this->indexhash) return;
		
		$this->jb();
		
	}
	
	private function jb() {

		$year = (int) date('Y');
		$week = (int) date('W');
		
		$day = (int) date('w');
		if ($day == 0) $day = 7;
		
		$this->db->select('food.food, food.image_url');
		$this->db->from('menu');
		$this->db->join('food', 'menu.food_id = food.id OR menu.veg_id = food.id');
		$this->db->where('menu.year', $year);
		$this->db->where('menu.week', $week);
		$this->db->where('menu.day', $day);
		$this->db->order_by('menu.school_id');
		$this->db->order_by('food.type');
		$this->db->limit(2);
		
		$query = $this->db->get();
		$result = $query->result();
		
		if (!$result) return false;
		
		$food = get_object_vars($result[0]);
		$veg = get_object_vars($result[1]);
		
		$image = empty($food['image_url']) ? $this->general_model->defaultImage : $food['image_url'];
		$food = $food['food'];
		$veg = $veg['food'];
		$url = site_url("jb/meny/{$this->general_model->daysURL[$day - 1]}-vecka-{$week}-{$year}");
		
		$this->load->driver('cache');
		$op = md5($this->expire);
		
		if (strtotime('+1 week') > strtotime($this->expire) && $this->cache->file->get('lastop') !== $op) {
		
			$this->cache->file->save('lastop', $op, 15552000);
			mail('example@example.com', 'Åtkomstbevis till Post-To-Facebook håller på att gå ut...', "Åtkomstbevis till Post-To-Facebook går ut inom en vecka! ({$this->expire})", 'From: Käkboten <bot@kakboten.se>');
			
		}
		
		$api['access_token'] = $this->accessToken;

		$config['appId'] = $this->appID;
		$config['secret'] = $this->appSecret;
		
		$this->load->library('Facebook', $config);
		
		$accounts = $this->facebook->api('/me/accounts', 'GET', $api);

		foreach($accounts['data'] as $account) {
			
			if ($account['id'] == $this->pageID) $token = $account['access_token'];	
			
		}
		
		try {
			
			$publishStream = $this->facebook->api("/{$this->pageID}/feed", 'post', array(
				'access_token' 	=> $token,
				'name' 			=> "Idag serveras: {$food}",
				'link'    		=> $url,
				'picture' 		=> $image,
				'description'   => "Vegetariskt alternativ: {$veg}"
				)
			);
			
		} catch (FacebookApiException $e) {
			
			log_message('error', "Something went wrong in post-to-facebook script: {$e}");
			die($e);
			
		}
		
	}
	
}

?>