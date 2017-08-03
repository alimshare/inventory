<?php if (!defined('BASEPATH')) die();

class Consultant extends CI_Controller {

	private $limit=20;
	private $site_id='';
	private $menu_titel='Settings';
	private $page_titel='Consultant';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_consultant','mm');
		if(!$this->authenty->check_editor()){
			redirect(base_url().'Logout');
		}
	}

	public function index()
	{
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']=$this->page_titel;

		$data['authen'] = $this->authenty->sess();

		$sql 				= "SELECT project_id, project_code, project_name FROM tb_project ORDER by project_name";
		$data['project'] 	= $this->db->query($sql)->result_array();

		$sql 				= "SELECT T1.*,T2.project_name FROM tb_project_location T1 INNER JOIN tb_project T2 ON T1.project_id=T2.project_id ORDER by project_name ASC";
		$data['location'] 	= $this->db->query($sql)->result_array();

		$sql 				= "SELECT id,unit_name,project_code,project_name 
								FROM tb_units T1 INNER JOIN tb_project T2 ON T1.project_id=T2.project_id 
								ORDER by unit_name,project_code";
		$data['unit'] 		= $this->db->query($sql)->result_array();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_consultant.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function data_json_all()
	{
		$str = "";
		$data['data_all']=$this->mm->get_data_json_all($str);		
		echo json_encode(array('aaData' => $data['data_all']));
	}

	public function do_add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', '%s required.');
		$this->form_validation->set_rules('txt_code', 'Code', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_name', 'Name', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_contract', 'Contract', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_from', 'From', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_to', 'To', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_project', 'Project', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_unit', 'Unit', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_location', 'Location', 'trim|xss_clean');

			$name 		= $this->input->post('txt_name');
			$code 		= $this->input->post('txt_code');
			$contract 	= $this->input->post('txt_contract');
			$from 		= $this->input->post('txt_from');
			$to 		= $this->input->post('txt_to');
			$project 	= $this->input->post('txt_project');
			$unit 		= $this->input->post('txt_unit');
			$location 	= $this->input->post('txt_location');

			$create_by = trim($this->authenty->session_user());
			$create_date = date("Y-m-d H:i:s");
			$modify_by = trim($this->authenty->session_user());
			$modify_date = date("Y-m-d H:i:s");

		if(isset($_POST['txt_id'])){
			$id = trim($this->input->post('txt_id'));
			$data_update = array(
				'consultant_code' 	=> $code,
				'consultant_name' 	=> $name,
				'contract'			=> $contract,
				'term_of_service_from' 	=> $from,
				'term_of_service_end' 	=> $to,
				'project_id' 		=> $project,
				'unit_id' 			=> $unit,
				'loca_id' 			=> $location,
				'modify_by' 	=> $modify_by,
				'modify_date' 	=> $modify_date
			);
			$data_update_id = $this->mm->do_update($id, $data_update);
		}else{
			if($this->is_unique_name($name)==FALSE){
				echo "The consultant name already exists.";
			}else if($this->is_unique_code($code)==FALSE){
				echo "The consultant code already exists.";
			}else{
				$data_insert = array(
					'consultant_code' 	=> $code,
					'consultant_name' 	=> $name,
					'contract'			=> $contract,
					'term_of_service_from' 	=> $from,
					'term_of_service_end' 	=> $to,
					'project_id' 		=> $project,
					'unit_id' 			=> $unit,
					'loca_id' 			=> $location,
					'create_by' 	=> $create_by,
					'create_date' 	=> $create_date,
					'modify_by' 	=> $modify_by,
					'modify_date' 	=> $modify_date
				);
				$data_insert_id = $this->mm->do_insert($data_insert);
			}
		}
		echo "ok";
		
	}

	public function edit($id='')
	{

		$data['data_all']=$this->mm->get_data_update($id);
		echo json_encode($data['data_all']);

	}

	public function do_del($id)
	{
		$data_update = $this->mm->do_delete($id);
		echo "ok";
	}

	public function is_unique_name($str)
	{
		if(trim($str)==""){
			return FALSE;
		}else{
			$data_duplicate=$this->mm->get_data_duplicate_name($str);
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
			$data_duplicate=$this->mm->get_data_duplicate_code($str);
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

	// [ITEMS] Get Increment Code
	public function get_new_code(){
		$data="001";
		$sql =  "SELECT DISTINCT consultant_code code FROM tb_consultant ORDER BY consultant_code DESC LIMIT 1 ";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->code;
			$data = intval($data); 
			$data = $data+1;
			
			if ($data < 10){
				$data = "00".$data;
			} else if ($data < 99){
				$data = "0".$data;
			}
		}
		echo $data;
	}

	public function getComboUnit($id, $unit_id=''){
		$sql   	= "SELECT id,unit_name name FROM tb_units T1 WHERE project_id='$id' ORDER by unit_name";
		$query 	= $this->db->query($sql);
		$data 	= "<option >Select ...</option>";
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row){
				if ($unit_id <> '' && $unit_id == $row->id){
					$data .="<option value='".$row->id."' selected=''>".$row->name."</option>";
				} else {
					$data .="<option value='".$row->id."' >".$row->name."</option>";					
				}
			}
		}
		echo $data;
	}

	public function getComboLocation($id, $loca_id=''){
		$sql   	= "SELECT loca_id id,loca_province,loca_district FROM tb_project_location T1 WHERE project_id='$id' ORDER by loca_province ASC,loca_district ASC";
		$query 	= $this->db->query($sql);
		$data 	= "<option >Select ...</option>";
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row){
				if ($loca_id <> '' && $loca_id == $row->id){
					$data .="<option value='".$row->id."' selected=''>".$row->loca_province." - ".$row->loca_district."</option>";
				} else {
					$data .="<option value='".$row->id."' >".$row->loca_province." - ".$row->loca_district."</option>";					
				}
			}
		}
		echo $data;		
	}

}


/* End of file consultant.php */
/* Location: ./application/modules/settings/controllers/consultant.php */
