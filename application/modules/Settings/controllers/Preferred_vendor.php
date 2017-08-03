<?php if (!defined('BASEPATH')) die();

class Preferred_vendor extends CI_Controller {

	private $limit=20;
	private $site_id='';
	private $menu_titel='Settings';
	private $page_titel='Preferred vendor';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_preferred_vendor','mm');
		if(!$this->authenty->check_editor()){
			redirect(base_url().'Logout');
		}
	}

	public function index()
	{
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']=$this->page_titel;

		$data['authen'] = $this->authenty->sess();

		$sql 				= "SELECT category_id, category_code, category_name FROM tb_vendor_category ORDER by category_name";
		$data['category'] 	= $this->db->query($sql)->result_array();
		// print_r($data['category']);die();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_preferred_vendor.php');
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
		$this->form_validation->set_rules('txt_address', 'Address', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_pic', 'PIC', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_phone', 'Phone', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_email', 'Email', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_since', 'Since', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_vendor_category', 'Since', 'trim|xss_clean');

			$code 	= $this->input->post('txt_code');
			$name 	= $this->input->post('txt_name');
			$address = $this->input->post('txt_address');
			$pic 	= $this->input->post('txt_pic');
			$phone 	= $this->input->post('txt_phone');
			$email 	= $this->input->post('txt_email');
			$since 	= $this->input->post('txt_since');
			$category 	= $this->input->post('txt_vendor_category');

			$create_by = trim($this->authenty->session_user());
			$create_date = date("Y-m-d H:i:s");
			$modify_by = trim($this->authenty->session_user());
			$modify_date = date("Y-m-d H:i:s");

		if(isset($_POST['txt_id'])){
			$id = trim($this->input->post('txt_id'));
			$data_update = array(
				'vendor_code' 	=> $code,
				'vendor_name' 	=> $name,
				'vendor_address'=> $address,
				'vendor_contact'=> $pic,
				'vendor_phone' 	=> $phone,
				'vendor_email' 	=> $email,
				'vendor_since' 	=> $since,
				'category_id' 	=> $category,
				'modify_by' 	=> $modify_by,
				'modify_date' 	=> $modify_date
			);
			$data_update_id = $this->mm->do_update($id, $data_update);
		}else{
			if($this->is_unique_name($name)==FALSE){
				echo "The vendor name already exists.";
			}else if($this->is_unique_code($code)==FALSE){
				echo "The vendor code already exists.";
			}else{
				$data_insert = array(
					'vendor_code' 	=> $code,
					'vendor_name' 	=> $name,
					'vendor_address'=> $address,
					'vendor_contact'=> $pic,
					'vendor_phone' 	=> $phone,
					'vendor_email' 	=> $email,
					'vendor_since' 	=> $since,
					'category_id' 	=> $category,
					'isPreferred'	=> '1',
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
		$sql =  "SELECT DISTINCT vendor_code FROM tb_vendor ORDER BY vendor_code DESC LIMIT 1 ";
		$result=$this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$data = $result->row()->vendor_code;
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

}


/* End of file preferred_vendor.php */
/* Location: ./application/modules/settings/controllers/preferred_vendor.php */
