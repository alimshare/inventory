<?php if (!defined('BASEPATH')) die();

class Other extends CI_Controller {

	private $limit=20;
	private $site_id='';
	private $menu_titel='Settings';
	private $page_titel='Other';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		// $this->load->model('m_durations');
		if(!$this->authenty->check_editor()){
			redirect(base_url().'Logout');
		}
	}

	public function index()
	{
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']=$this->page_titel;

		$data['authen'] = $this->authenty->sess();

		$sql 			= "SELECT paramKey,paramValue FROM tb_parameter WHERE trash !=1";
		$dataTemp 		= $this->db->query($sql)->result_array();
		foreach ($dataTemp as $key => $value) {
			$data['param'][$value['paramKey']] = $value['paramValue'];
		}

		// echo "<pre>";
		// print_r($data['param']);
		// die();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_other.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function do_save(){

		echo "<pre>";
		print_r($this->input->post());
		die();

	}


}


/* End of file durations.php */
/* Location: ./application/modules/settings/controllers/durations.php */
