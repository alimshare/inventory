<?php //error_reporting(0);
if (!defined('BASEPATH')) die();
class Dashboard extends CI_Controller {
	private $site_id="";
	private $menu_titel='Dashboard';

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string_manipulation');
		$this->load->helper(array('form', 'url'));
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$this->load->library('Authenty');
		$this->load->library('Int_header');
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}
	}


	public function index()
	{
		$now=date('Y-m-d H:i:s');
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']="Dashboard";
		$data['authen'] = $this->authenty->sess();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_dashboard.php');

	}

	public function settings()
	{
		$now=date('Y-m-d H:i:s');
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']="Settings";
		$data['authen'] = $this->authenty->sess();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_settings.php');
	}


}


/* End of file dashboard.php */
/* Location: ./application/controllers/intranet/dashboard.php */
