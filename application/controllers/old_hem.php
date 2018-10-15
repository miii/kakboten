<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class old_hem extends CI_Controller {
	
	private $footerData = array(
	
		'facebookLink'	=>	'https://www.facebook.com/pages/K%C3%A4kboten/181136815315306'
	
	);

	public function index() {
		
		$header = $this->general_model->header;
		$header['title'] .= " - Startsida";
		
		$footer = $this->footerData;
		$footer['noLinkToFrontpage'] = true;
		
		$this->load->view('header', $header);
		$this->load->view('frontpage');
		$this->load->view('footer', $footer);
		
	}
	
}