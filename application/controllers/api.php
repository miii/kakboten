<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{
	
	function feed($school)
	{
		
		header('Content-type: application/json');
		
		$schoolID = array_search($school, $this->general_model->schoolsURL);
		if ($schoolID === false) {
			
			echo json_encode(false);
			return;
			
		}
		
		$data = $this->general_model->today($schoolID);
		
		if (empty($data)) {
			
			echo json_encode(false);
			return;
			
		}
		
		$json['food']['food'] = $data['food']['food'];
		$json['food']['image'] = $data['food']['image_url'];
		$json['veg']['food'] = $data['veg']['food'];
		$json['veg']['image'] = $data['veg']['image_url'];
		$json['url'] = site_url("{$school}/meny/{$data['dayURL']}-vecka-{$data['week']}-{$data['year']}");
		
		echo json_encode($json);
		
	}
	
}

?>