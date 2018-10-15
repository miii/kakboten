<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller
{
	
	function error_404()
	{
		header("HTTP/1.0 404 Not Found");
		redirect('/');
	}
	
}

?>