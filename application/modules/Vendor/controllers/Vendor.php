<?php if (!defined('BASEPATH')) die();

class Vendor extends CI_Controller {

	private $limit=20;
	private $site_id='';
	private $menu_titel='Settings';
	private $page_titel='vendor';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_vendor','mm');
		if(!$this->authenty->check_editor()){
			redirect(base_url().'Logout');
		}
	}

	public function index()
	{
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']=$this->page_titel;

		$data['authen'] = $this->authenty->sess();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_vendor.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function data_json_all()
	{
		$str = "";
		$data['data_all']=$this->mm->get_data_json_all($str);		
		echo json_encode(array('aaData' => $data['data_all']));
	}

}


/* End of file Vendor.php */
/* Location: ./application/modules/vendor/controllers/Vendor.php */
