<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index(){
		session_destroy();
		redirect('Login','refresh');		
	}

	
	
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */