<?php if (!defined('BASEPATH')) die();

class Users extends CI_Controller {

	private $limit=20;
	private $site_id='';
	private $menu_titel='Settings';
	private $page_titel='Projects';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_users');
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
		$this->load->view('v_users.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function data_json_all()
	{
		$str = "";
		$data['data_all']=$this->m_users->get_data_json_all($str);		
		echo json_encode(array('aaData' => $data['data_all']));
	}

	public function do_add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', '%s required.');
		$this->form_validation->set_rules('txt_account', 'Account Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('txt_password', 'Password', 'trim|xss_clean|matches[txt_password2]');
		$this->form_validation->set_rules('txt_username', 'Username', 'trim|xss_clean|alpha_numeric_spaces');
		$this->form_validation->set_rules('txt_email', 'Email', 'trim|xss_clean|valid_email');
		$this->form_validation->set_rules('txt_purpose', 'Purpose', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_role', 'Role', 'trim|xss_clean');

			$user_login = $this->input->post('txt_account');
			$password 	= $this->input->post('txt_password');
			$fullname 	= $this->input->post('txt_username');
			$email 		= $this->input->post('txt_email');
			$project 	= $this->input->post('txt_project_select');
			$unit 		= $this->input->post('txt_unit_select');
			$location 	= $this->input->post('txt_location_select');
			$purpose 	= $this->input->post('txt_purpose');
			$signature 	= $this->input->post('txt_signature');
			$role 		= $this->input->post('txt_role');

			$create_by = trim($this->authenty->session_user());
			$create_date = date("Y-m-d H:i:s");
			$modify_by = trim($this->authenty->session_user());
			$modify_date = date("Y-m-d H:i:s");

		if(isset($_POST['txt_id'])){
			$id = trim($this->input->post('txt_id'));
			$data_update = array(
				'account_name' 	=> $user_login,
				'username'   	=> $fullname,
				'email'   		=> $email,
				'project_id'   	=> $project,
				'unit_id'   	=> $unit,
				'loca_id'   	=> $location,
				'purpose'   	=> $purpose,
				'role'			=> $role,
				'modify_by' 	=> $modify_by,
				'modify_date' 	=> $modify_date
			);
			$data_update_id = $this->m_users->do_update($id, $data_update);
			echo $data_update_id."::";

		}else{
			
			if(count($this->m_users->get_data_duplicate('account_name',$user_login)) > 0){
				// echo $this->db->last_query();
				echo "User already exists.";
			}else{

				$data_insert = array(
					'account_name' 	=> $user_login,
					'password' 		=> sha1(md5($password)),
					'username'   	=> $fullname,
					'email'   		=> $email,
					'project_id'   	=> $project,
					'unit_id'   	=> $unit,
					'loca_id'   	=> $location,
					'purpose'   	=> $purpose,
					'signature'   	=> '',
					'role'			=> $role,
					'create_by' 	=> $create_by,
					'create_date' 	=> $create_date,
					'modify_by' 	=> $modify_by,
					'modify_date' 	=> $modify_date
				);
				$data_insert_id = $this->m_users->do_insert($data_insert);
				echo $data_insert_id."::";
				
			}
		}
		echo "ok";
	}		

	public function add()
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
		$this->load->view('f_user.php');
		$this->load->view('intranet_includes/v_footer.php');
	}	

	public function vedit($id="")
	{
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']=$this->page_titel;

		$data['authen'] = $this->authenty->sess();
		$data['id'] = $id;
		$data['user'] = $this->m_users->get_data_update($id);

		$sql 				= "SELECT project_id, project_code, project_name FROM tb_project ORDER by project_name";
		$data['project'] 	= $this->db->query($sql)->result_array();

		$sql 				= "SELECT T1.*,T2.project_name FROM tb_project_location T1 INNER JOIN tb_project T2 ON T1.project_id=T2.project_id ORDER by project_name ASC";
		$data['location'] 	= $this->db->query($sql)->result_array();

		$sql 				= "SELECT id,unit_name,project_code,project_name 
								FROM tb_units T1 INNER JOIN tb_project T2 ON T1.project_id=T2.project_id 
								ORDER by unit_name,project_code";
		$data['unit'] 		= $this->db->query($sql)->result_array();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('f_user_edit.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function edit($id='')
	{

		$data['data_all']=$this->m_users->get_data_update($id);
		echo json_encode($data['data_all']);

	}

	public function do_del($id)
	{
		$data_update = $this->m_users->do_delete($id);
		echo "ok";
	}

	public function is_unique_name($str)
	{
		if(trim($str)==""){
			return FALSE;
		}else{
			$data_duplicate=$this->m_users->get_data_duplicate_name($str);
			if(!isset($_POST['txt_id'])){ // insert
				if(count($data_duplicate)>0){
					echo "false";
					return FALSE;
				}else {
					echo "true";
					return TRUE;
				}
			}else{ // update
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
			$data_duplicate=$this->m_users->get_data_duplicate_code($str);
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

	public function do_upload()
    {
        $status = "";
		$msg = "";
		$file = "";

		$path_home='images';
		if(!is_dir($path_home))
		{
			mkdir($path_home);
		}

		$path_dir='images/items';
		if(!is_dir($path_dir))
		{
			mkdir($path_dir);
		}

		$config['upload_path']          = $path_dir.'/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

		$temporary 						= explode(".", $_FILES["txt_signature"]["name"]);
		$file_extension 				= end($temporary);
		$filename 						= date('YmdHis').".".$file_extension;
		$config['file_name']			= $filename;

		if (isset($_FILES['txt_signature']['name'])) {
            if (0 < $_FILES['txt_signature']['error']) {
				$data = array('msg' => 'Error during file upload' . $_FILES['file']['error']);
                //echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists($path_dir.'/'. $_FILES['txt_signature']['name'])) {
					$data = array('msg' => 'File already exists : ' . $filename, 'filename' => $filename);
                    //echo 'File already exists : ' . $_FILES['txt_item_image']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('txt_signature')) {
                        echo $this->upload->display_errors();
                    } else {
                        //echo 'success';
						$id = trim($this->input->post('id'));
						$data_update = array(
							'signature' 	=> $filename
						);
						$data_update_id = $this->m_users->do_update($id, $data_update);

						$data = array('msg' => 'success', 'filename' => $filename);
                    }
                }
            }
        }else {
			$data = array('msg' => 'Please choose a file');
            //echo 'Please choose a file';
        }
		echo json_encode($data);
    }

    function profile(){
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']=$this->page_titel;

		$data['authen'] = $this->authenty->sess();

		$sql = "SELECT T1.* , T2.project_code, T2.project_name, T3.unit_name, T4.loca_province
				FROM tb_userapp T1 
				left join tb_project T2 on T2.project_id=T1.project_id
				left join tb_units T3 on T3.id=T1.unit_id
				left join tb_project_location T4 on T4.loca_id=T1.loca_id
 				WHERE T1.id='".$_SESSION['us_id']."'";
		$data['user']	= $this->db->query($sql)->row();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('profile.php'); 
		$this->load->view('intranet_includes/v_footer.php');
    }

    function updateProfile(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_username', 'Username', 'trim|xss_clean|alpha_numeric_spaces');
		$this->form_validation->set_rules('txt_email', 'Email', 'trim|xss_clean|valid_email');

			$fullname 	= $this->input->post('txt_username');
			$email 		= $this->input->post('txt_email');

			$modify_by = trim($this->authenty->session_user());
			$modify_date = date("Y-m-d H:i:s");

			$data_update = array(
				'username'   	=> $fullname,
				'email'   		=> $email,
				'modify_by' 	=> $modify_by,
				'modify_date' 	=> $modify_date
			);
			$data_update_id = $this->m_users->do_update($_SESSION['us_id'], $data_update);

			redirect('Users/profile');
    }

}


/* End of file projects.php */
/* Location: ./application/modules/settings/controllers/projects.php */
