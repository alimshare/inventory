<?php ob_start(); if (!defined('BASEPATH')) die();

class Purchase_request extends CI_Controller {
	private $limit=40;
	private $site_id="";
	private $menu_titel='Purchase Request';


	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$this->load->model('M_purchase_request','mm');
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}
	}

	public function index($id=0)
	{
		$data['menu_titel']= $this->menu_titel;
		$data['page_titel']="Purchase Request";
		$data['smenu_titel']='Purchase Request Form';
		$data['authen'] = $this->authenty->sess();

		$sql = "SELECT * FROM tb_items WHERE item_category='item_unit' ORDER BY item_name";
		$result = $this->db->query($sql)->result_array();		
		$option_item = "";
		foreach ($result as $key => $value) {
			$option_item .= "<option value='".$value['item_name']."'>".$value['item_name']."</option>";
		}
		$data['unit_item'] = $option_item;

		$sql = "SELECT * FROM tb_options WHERE op_tipe='Items' ORDER BY op_titel";
		$result = $this->db->query($sql)->result_array();		
		$option_item = "";
		foreach ($result as $key => $value) {
			$option_item .= "<option value='".$value['op_id']."'>".$value['op_titel']."</option>";
		}
		$data['item'] = $option_item;

		$sql 				= "SELECT id,account_name,username,email FROM tb_userapp WHERE trash !=1 AND role='OPERATION'";
		$data['user'] 		= $this->db->query($sql)->result_array();

		$data['id_mini_proposal'] = $id;

		if (isset($_SESSION['message'])){
			$data['message'] = $_SESSION['message'];
    		unset($_SESSION['message']);			
		}


		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_purchase.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function test(){
		$_SESSION['message'] = "success";
		redirect('Purchase_request');		
	}

	public function lists()
	{
		$search = $this->input->post('txt_search');
		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	="";
		$data['smenu_titel']='Purchase Request Lists';
		$data['authen'] 	= $this->authenty->sess();
		
		$data['list_items'] = $this->mm->get_options_item_lists();
		
		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_purchase_request_lists.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function do_save(){
		// echo "<pre>";
		// print_r($this->input->post());
		// die();

		if (!isset($_POST['item'])){
			redirect('purchase_request');
		}

		$item 			= $this->input->post('item');
		$description 	= $this->input->post('description');
		$qty 			= $this->input->post('qty');
		$unit 			= $this->input->post('unit');
		$unit_price 	= $this->input->post('price');
		$submitto 		= $this->input->post('submitto');
		$submitfrom		= $_SESSION['email'];
		$user_id		= $_SESSION['us_id'];
		$justification	= $this->input->post('txt_justification_form');

		$id_mini_proposal	= $this->input->post('txt_mini_proposal');

		$create_by 		= trim($this->authenty->session_user());
		$create_date 	= date("Y-m-d H:i:s");
		$hit_error 		= 0;

		// $sql  = "SELECT gfas FROM tb_project WHERE project_id = '".$_SESSION['project_id']."'";
		// $gfas = $this->db->query($sql)->row_array()['gfas'];
		$gfas = $this->M_General->getGFAS($_SESSION['project_id']);

		$number			= $this->get_purchase_number();
		$request_number	= $number."/".$gfas."/". date("m")."/". date("Y");

		$path 			= $this->config->item('purchase_path');
		$filename 		= "purchase".$number."-".date('m')."-".date('Y').".pdf";

		$msg 	= "error";
		$data 	= array(
			'attachment'	=> $filename,
			'number' 		=> $number,
			'purchase_number'	=> $request_number,
			'justification'	=> $justification,
			'status' 		=> 'PENDING',
			'submitto' 		=> $submitto,
			'submitfrom'	=> $submitfrom,
			'token'			=> sha1("purc".$number."-".$create_date),
			'user_id' 		=> $user_id,
			'create_by' 	=> $create_by,
			'create_date' 	=> $create_date,
			'gfas'			=> $gfas,
			'id_mini_proposal' => $id_mini_proposal
		);
		die(var_dump($data));
		$status = $this->db->insert('tb_purchase_header',$data);

		if ($status){

			$request_id = $this->db->insert_id();

			for ($i=0; $i < count($item); $i++) { 
				$data = array(
					'purchase_id'	=> $request_id,
					'op_id'			=> $item[$i],
					'description' 	=> $description[$i],
					'qty' 			=> $qty[$i],
					'unit' 			=> $unit[$i],
					'unit_price' 	=> $unit_price[$i],
					'create_by' 	=> $create_by,
					'create_date' 	=> $create_date
				);
				$status = $this->db->insert('tb_purchase_request',$data);

				if (!$status){
					$hit_error++;
		 			log_message('error', $this->db->last_query());
				}
			}

			if ($hit_error == 0){ // tidak ada error
				$status = $this->pdf($request_id); // create PDF file
				if ($status) {
					$msg = "success";
				}
			}			
		}

		$_SESSION['message'] = $msg;
		redirect('Purchase_request');

	}

	public function pdf($id){
        $this->load->library('FPDF_Custom');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$sql 	= "	SELECT T1.*,DATE_FORMAT(T1.create_date,'%d %M %Y')  tanggal,T2.username,T2.email,T2.signature 
					FROM tb_purchase_header T1 LEFT JOIN tb_userapp T2 ON T1.create_by=T2.account_name WHERE T1.id = '".$id."'";
		$data['header'] = $this->db->query($sql)->row_array();
		$data['header']['path'] = 'images/items/';

		$sql 	= "	SELECT tb_purchase_request.*,tb_options.op_titel FROM tb_purchase_request 
					INNER JOIN tb_options ON tb_options.op_id=tb_purchase_request.op_id WHERE purchase_id = '".$id."'";
		$data['data'] 	= $this->db->query($sql)->result_array();

		// $sql 	= "SELECT gfas FROM tb_project WHERE project_id = '".$_SESSION['project_id']."'";
		// $data['header']['gfas'] = $this->db->query($sql)->row_array()['gfas'];
		$$data['header']['gfas'] = $this->M_General->getGFAS($_SESSION['project_id']);

		$this->load->view('purchase_pdf', $data);

		$status = 0;
		if ($data['header']['send_email'] == 0){

			$path 		= $this->config->item('purchase_path');
			$filename 	= "purchase".$data['header']['number']."-".date('m')."-".date('Y').".pdf";
			$fullpath 	= $path.$filename;

			$status 	= $this->send_email($data);	
			if ($status) {
				$data_update = array(
					'send_email' => '1'
				);
        		$this->db->where_in('id', $id);
        		$status = $this->db->update('tb_purchase_header', $data_update);
			}	
		}

		return $status;

	}	

	public function testPDF($id=1){
		$this->pdf($id);
	}

	private function send_email($data){	

		$data['link_approve'] 	= base_url('Link/confirmPurchase').'/'.$data['header']['token'].'/'.base64_encode("APPROVE");
		$data['link_reject']	= base_url('Link/confirmPurchase').'/'.$data['header']['token'].'/'.base64_encode("REJECT");

		$parameter['data']		= $data;
		$text = $this->load->view('template/send_purchase',$parameter, TRUE);

		// echo $text;
		// die();
		$number		= $data['header']['number']."/". date("m")."/". date("Y");

		$this->load->library('email');
		$this->email->from($this->config->item('app_email'), 'Procurement Team - FHI 360 Indoensia');
		$this->email->to($data['header']['submitto']);

		$this->email->subject('Purchase Request '.$number);
		$this->email->message($text);

		// Attachment
		$attachment = $data['header']['attachment'];
		if ($attachment <> ''){
			$attachment = $this->config->item('purchase_path').$attachment;

			$this->email->attach($attachment);			
		}

		// echo "<pre>";
		// print_r($this->email);
		// die();

		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $this->email->print_debugger(array('headers'));
			// echo $attachment;
		 	log_message('error', $this->email->print_debugger(array('headers')));
			die();
		}

		echo "<br>success send email to : ".$data['header']['submitto'];
		return $status;
	}

	function testSendEmail($id){
		$sql 			= "SELECT *,DATE_FORMAT(create_date,'%d %M %Y') tanggal FROM tb_purchase_header WHERE id = '".$id."'";
		$data['header'] = $this->db->query($sql)->row_array();

		$sql 			= "	SELECT tb_purchase_request.*,tb_options.op_titel FROM tb_purchase_request 
							INNER JOIN tb_options ON tb_options.op_id=tb_purchase_request.op_id WHERE purchase_id = '".$id."'";
		$data['data'] 	= $this->db->query($sql)->result_array();	

		$this->send_email($data);	
	}

	function get_purchase_number(){		
		$year 	= date("Y");
		$month 	= date("m");
		$sql = "SELECT number FROM tb_purchase_header WHERE 1=1 AND YEAR(create_date)='$year' AND MONTH(create_date)='$month' ORDER BY number DESC ";
		$result = $this->db->query($sql);		
		$data = "001";
		if($result->num_rows() > 0)
		{
			$data = $result->row_array()['number'];
			$data = intval($data); 
			$data = $data+1;
			
			if ($data < 10){
				$data = "00".$data;
			} else if ($data < 99){
				$data = "0".$data;
			}
		}
		return $data;
	}



	function saveServices(){
		// echo "<pre>";
		// print_r($this->input->post());
		// die();

		if (!isset($_POST['item'])){
			redirect('request/services');
		}

		$item 			= $this->input->post('item');
		$description 	= $this->input->post('description');
		$qty 			= $this->input->post('qty');
		$unit 			= $this->input->post('unit');
		$submitto 		= $this->input->post('submitto');
		$submitfrom		= $_SESSION['email'];
		$user_id		= $_SESSION['us_id'];
		$justification	= $this->input->post('txt_justification_form');
		$vendor			= $this->input->post('txt_vendor');

		$create_by 		= trim($this->authenty->session_user());
		$create_date 	= date("Y-m-d H:i:s");
		$hit_error 		= 0;

		$sql  = "SELECT gfas FROM tb_project WHERE project_id = '".$_SESSION['project_id']."'";
		$gfas = $this->db->query($sql)->row_array()['gfas'];

		$number			= $this->get_purchase_number();
		$request_number	= $number."/".$gfas."/". date("m")."/". date("Y");

		$path 			= $this->config->item('purchase_path');
		$filename 		= "purchase".$number."-".date('m')."-".date('Y').".pdf";

		$msg 	= "error";
		$data 	= array(
			'attachment'	=> $filename,
			'number' 		=> $number,
			'purchase_number'	=> $request_number,
			'justification'	=> $justification,
			'status' 		=> 'PENDING',
			'submitto' 		=> $submitto,
			'submitfrom'	=> $submitfrom,
			'token'			=> sha1("purc".$number."-".$create_date),
			'user_id' 		=> $user_id,
			'create_by' 	=> $create_by,
			'create_date' 	=> $create_date,
			'gfas'			=> $gfas,
			'purchase_type'	=> 'SERVICES',
			'id_vendor_category' => $vendor
		);
		$status = $this->db->insert('tb_purchase_header',$data);

		if ($status){

			$request_id = $this->db->insert_id();

			for ($i=0; $i < count($item); $i++) { 
				$data = array(
					'purchase_id'	=> $request_id,
					'item'			=> $item[$i],
					'description' 	=> $description[$i],
					'qty' 			=> $qty[$i],
					'unit' 			=> $unit[$i],
					'create_by' 	=> $create_by,
					'create_date' 	=> $create_date
				);
				$status = $this->db->insert('tb_purchase_request',$data);

				if (!$status){
					$hit_error++;
		 			log_message('error', $this->db->last_query());
				}
			}

			if ($hit_error == 0){ // tidak ada error
				$status = $this->pdf($request_id);
				if ($status) {
					$msg = "success";
				}
			}			
		}

		$_SESSION['message'] = $msg;
		redirect('Purchase_request');
	}


	function saveConsumableStuff(){
		// echo "<pre>";
		// print_r($this->input->post());
		// die();

		if (!isset($_POST['stuff'])){
			redirect('Purchase_request');
		}

		$stuff 			= $this->input->post('stuff');
		$item 			= $this->input->post('item');
		$qty 			= $this->input->post('qty');
		$unit 			= $this->input->post('unit');
		$unit_price 	= $this->input->post('price');
		$submitto 		= $this->input->post('submitto');
		$submitfrom		= $_SESSION['email'];
		$user_id		= $_SESSION['us_id'];
		$justification	= $this->input->post('txt_justification_form');

		$create_by 		= trim($this->authenty->session_user());
		$create_date 	= date("Y-m-d H:i:s");
		$hit_error 		= 0;

		$sql  = "SELECT gfas FROM tb_project WHERE project_id = '".$_SESSION['project_id']."'";
		$gfas = $this->db->query($sql)->row_array()['gfas'];

		$number			= $this->get_purchase_number();
		$request_number	= $number."/".$gfas."/". date("m")."/". date("Y");

		$path 			= $this->config->item('purchase_path');
		$filename 		= "purchase".$number."-".date('m')."-".date('Y').".pdf";

		$msg 	= "error";
		$data 	= array(
			'attachment'	=> $filename,
			'number' 		=> $number,
			'purchase_number'	=> $request_number,
			'justification'	=> $justification,
			'status' 		=> 'PENDING',
			'submitto' 		=> $submitto,
			'submitfrom'	=> $submitfrom,
			'token'			=> sha1("purc".$number."-".$create_date),
			'user_id' 		=> $user_id,
			'create_by' 	=> $create_by,
			'create_date' 	=> $create_date,
			'gfas'			=> $gfas
		);
		$status = $this->db->insert('tb_purchase_header',$data);

		if ($status){

			$request_id = $this->db->insert_id();

			for ($i=0; $i < count($stuff); $i++) { 
				$data = array(
					'purchase_id'	=> $request_id,
					'stuff_category'=> $stuff[$i],
					'item' 			=> $item[$i],
					'qty' 			=> $qty[$i],
					'unit' 			=> $unit[$i],
					'unit_price' 	=> $unit_price[$i],
					'create_by' 	=> $create_by,
					'create_date' 	=> $create_date,
					'purchase_type'	=> 'STUFF',
				);
				$status = $this->db->insert('tb_purchase_request',$data);

				if (!$status){
					$hit_error++;
		 			log_message('error', $this->db->last_query());
				}
			}

			if ($hit_error == 0){ // tidak ada error
				$status = $this->pdf($request_id);
				if ($status) {
					$msg = "success";
				}
			}			
		}

		$_SESSION['message'] = $msg;
		redirect('Purchase_request');

		
	}


}



/* End of file Purchase_request.php */
/* Location: ./application/modules/controllers/purchase_request/purchase_request.php */
