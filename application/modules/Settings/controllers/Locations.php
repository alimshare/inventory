<?php if (!defined('BASEPATH')) die();

class Locations extends CI_Controller {

	private $limit=20;
	private $site_id='';
	private $menu_titel='Settings';
	private $page_titel='Project Locations';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_locations');
		if(!$this->authenty->check_editor()){
			redirect(base_url().'Logout');
		}
	}

	public function index()
	{
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']=$this->page_titel;

		$data['authen'] = $this->authenty->sess();
		$data['list_provinces'] = $this->m_locations->get_provinces();

		$sql 				= "SELECT project_id, project_code, project_name FROM tb_project ORDER by project_name";
		$data['project'] 	= $this->db->query($sql)->result_array();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_project_locations.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function get_provinces(){
		$id = $this->input->post('province');
		$query = $this->db->query("SELECT id,name  FROM provinces ORDER by name");
		$data ="<option value=''>Select...</option>";
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row){
				if ($id <> '' && strtoupper($id) == $row->name){
					$data .="<option value='".$row->name."' selected=''>".$row->name."</option>";
				} else {
					$data .="<option value='".$row->name."' >".$row->name."</option>";					
				}
			}
		}
		echo $data;
	}

	public function data_json_all()
	{
		$str = "";
		$data['data_all']=$this->m_locations->get_data_json_all($str);		
		echo json_encode(array('aaData' => $data['data_all']));
	}

	public function do_add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', '%s required.');
		$this->form_validation->set_rules('txt_project_select', 'Project', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_provinces_select', 'Province', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_district', 'District', 'trim|xss_clean');
		// $this->form_validation->set_rules('txt_name', 'Name', 'trim|xss_clean');
		// $this->form_validation->set_rules('txt_code', 'Code', 'trim|xss_clean');

			// $name = $this->input->post('txt_name');
			// $code = $this->input->post('txt_code');
			$project_id = $this->input->post('txt_project_select');
			$province = $this->input->post('txt_provinces_select');
			$district = $this->input->post('txt_district');

			$create_by = trim($this->authenty->session_user());
			$create_date = date("Y-m-d H:i:s");
			$modify_by = trim($this->authenty->session_user());
			$modify_date = date("Y-m-d H:i:s");

		if(isset($_POST['txt_id'])){
			$id = trim($this->input->post('txt_id'));
			$data_update = array(
				'project_id'	=> $project_id,
				'loca_district'	=> $district,
				'loca_province'	=> $province
			);
			$data_update_id = $this->m_locations->do_update($id, $data_update);
		}else{
			// if($this->is_unique_name($name)==FALSE){
			// 	echo "The project name already exists.";
			// }else if($this->is_unique_code($code)==FALSE){
			// 	echo "The project code already exists.";
			// }else{
				$data_insert = array(
					'project_id'	=> $project_id,
					'loca_district'	=> $district,
					'loca_province'	=> $province
				);
				$data_insert_id = $this->m_locations->do_insert($data_insert);
			// }
		}
		echo "ok";
		
	}

	public function edit($id='')
	{

		$data['data_all']=$this->m_locations->get_data_update($id);
		echo json_encode($data['data_all']);

	}

	public function do_del($id)
	{
		$data_update = $this->m_locations->do_delete($id);
		echo "ok";
	}

	public function is_unique_name($str)
	{
		if(trim($str)==""){
			return FALSE;
		}else{
			$data_duplicate=$this->m_locations->get_data_duplicate_name($str);
			if(!isset($_POST['txt_id'])){
				if(count($data_duplicate)>0){
					return FALSE;
				}else{
					return TRUE;
				}
			}else{
				if(count($data_duplicate)>0){
					if($data_duplicate->item_id==$this->input->post('txt_id')){
						return TRUE;
					}else{
						return FALSE;
					}
				}else{
					return TRUE;
				}
			}
		}
	}

	public function is_unique_code($str)
	{
		if(trim($str)==""){
			return FALSE;
		}else{
			$data_duplicate=$this->m_locations->get_data_duplicate_code($str);
			if(!isset($_POST['txt_id'])){
				if(count($data_duplicate)>0){
					return FALSE;
				}else{
					return TRUE;
				}
			}else{
				if(count($data_duplicate)>0){
					if($data_duplicate->item_id==$this->input->post('txt_id')){
						return TRUE;
					}else{
						return FALSE;
					}
				}else{
					return TRUE;
				}
			}
		}
	}

	// [ITEMS] Get Increment Item Code
	public function get_new_location_code(){
		$data="001";
		$sql =  "SELECT DISTINCT loca_code FROM tb_locations ORDER BY loca_code DESC LIMIT 1 ";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->loca_code;
			$data = intval($data); 
			$data = $data+1;
			// $data = $data<10 ? "0".$data : $data;
			
			if ($data < 10){
				$data = "00".$data;
			} else if ($data < 99){
				$data = "0".$data;
			}
		}
		echo $data;
	}


}


/* End of file locations.php */
/* Location: ./application/modules/settings/controllers/locations.php */
