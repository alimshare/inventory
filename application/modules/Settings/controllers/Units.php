<?php if (!defined('BASEPATH')) die();
class Units extends CI_Controller {
	private $limit=20;
	private $site_id='';
	private $menu_titel='Settings';
	private $page_titel='Units';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_units','mm');
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

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_units.php');
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
		$this->form_validation->set_rules('txt_name', 'Name', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_project_select', 'Project', 'trim|xss_clean');

			$name = $this->input->post('txt_name');
			$project = $this->input->post('txt_project_select');

			$create_by = trim($this->authenty->session_user());
			$create_date = date("Y-m-d H:i:s");
			$modify_by = trim($this->authenty->session_user());
			$modify_date = date("Y-m-d H:i:s");

		// if($this->is_unique_name($name)==FALSE){
		// 	echo "The item name already exists.";
		// }else if($this->is_unique_code($code)==FALSE){
		// 	echo "The item code already exists.";
		// }else{
			if(isset($_POST['txt_id'])){
				$id = trim($this->input->post('txt_id'));
				$data_update = array(
					'unit_name' 	=> $name,
					'project_id' 	=> $project
				);
				$data_update_id = $this->mm->do_update($id, $data_update);
			}else{
				$data_insert = array(
					'unit_name' 	=> $name,
					'project_id' 	=> $project
				);
				$data_insert_id = $this->mm->do_insert($data_insert);
			}
			echo "ok";
		// }
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



}


/* End of file units.php */
/* Location: ./application/modules/settings/controllers/units.php */
