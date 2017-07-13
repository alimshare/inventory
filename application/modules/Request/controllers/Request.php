<?php ob_start(); if (!defined('BASEPATH')) die();

class Request extends CI_Controller {
	private $limit=40;
	private $site_id="";
	private $menu_titel='Request';
	private $find = "";


	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$this->load->model('M_request');
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}
	}

	public function index()
	{
		$data['menu_titel']= $this->menu_titel;
		$data['page_titel']="Inventory Input Form";
		$data['smenu_titel']='Inventory Input Form';
		$data['authen'] = $this->authenty->sess();


		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_find.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function lists()
	{
		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	="";
		$data['smenu_titel']='Request Lists';
		$data['authen'] 	= $this->authenty->sess();
		
		$param 	= $this->input->post('txt_search');
		if ($param != ""){
			$this->find = $param;
			$data['search'] = $param;
		}

		if (isset($_SESSION['message'])){
			$data['message'] = $_SESSION['message'];
    		unset($_SESSION['message']);			
		}
		
		$data['list_items'] = $this->M_request->get_options_item_lists();
		
		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_request_lists.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function test(){
		$_SESSION['message'] = "success";
		redirect('Request/form');		
	}

	public function do_save(){
		// echo "<pre>";
		// print_r($this->input->post());		

		$user_id 	= $_SESSION['us_id'];
		$user_login = $_SESSION['us_user'];
		$user_email = $_SESSION['email'];
		$project_id = $_SESSION['project_id'];
		$unit_id 	= $_SESSION['unit_id'];
		$loca_id 	= $_SESSION['loca_id'];
		$duration	= $this->input->post('duration');
		$purpose	= $this->input->post('purpose');
		$to 		= $this->input->post('submitto');
		$list_id	= $this->input->post('list_id');
		$number		= $this->get_request_number();
		$request_number	= $number."/". date("m")."/". date("Y");

		$create_by = trim($this->authenty->session_user());
		$create_date = date("Y-m-d H:i:s");

		$data = array(
			'number' 		=> $number,
			'request_number'=> $request_number,
			'account_name' 	=> $user_login,
			'user_id' 		=> $user_id,
			'project_id'   	=> $project_id,
			'unit_id'   	=> $unit_id,
			'loca_id'   	=> $loca_id,
			'purpose'   	=> $purpose,
			'duration'   	=> $duration,
			'submitto'		=> $to,
			'submitfrom'	=> $user_email,
			'list_id'  		=> $list_id,
			'status'		=> 'PENDING',
			'token'			=> sha1("req".$number."-".$create_date),	
			'create_date' 	=> $create_date
		);

		$message = "error";
		$status = $this->db->insert('tb_request',$data);
		if ($status){
			$insert_id = $this->db->insert_id();
			$this->pdf($insert_id);
			$message = "success";
		} else {
			echo "<pre>";
			print_r($data);
			echo "</pre>";
			echo "<br>";
			// echo $this->db->last_query();
			// die('fail');
		}

		// $_SESSION['message'] = $message;
		echo "ok";
	}

	public function form($id="")
	{
		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	= "";
		$data['smenu_titel']='Request Form';
		$data['authen'] 	= $this->authenty->sess();

		$data['list_id'] 	= $id;

		$sql = "SELECT project_name FROM tb_project WHERE project_id='".$_SESSION['project_id']."'";
		$data['project_name'] = $this->db->query($sql)->row_array()['project_name'];

		$sql = "SELECT unit_name FROM tb_units WHERE id='".$_SESSION['unit_id']."'";
		$data['unit_name'] = $this->db->query($sql)->row_array()['unit_name'];

		$sql = "SELECT loca_province,loca_district FROM tb_project_location WHERE loca_id='".$_SESSION['loca_id']."'";
		$result = $this->db->query($sql)->row_array();
		$data['loca_province'] = $result['loca_province'];
		$data['loca_district'] = $result['loca_district'];
		
		$sql 				= "SELECT * FROM tb_items WHERE item_category='duration' AND trash !=1";
		$data['duration'] 	= $this->db->query($sql)->result_array();

		$sql 				= "SELECT id,account_name,username,email FROM tb_userapp WHERE trash !=1 AND role='OPERATION'";
		$data['user'] 		= $this->db->query($sql)->result_array();

		if (isset($_SESSION['message'])){
			$data['message'] = $_SESSION['message'];
    		unset($_SESSION['message']);			
		}
		
		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_request_form.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function pdf($id){
        $this->load->library('FPDF_Custom');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$path 	= $this->config->item('request_path');

		$sql 	= "
				SELECT 
					T1.id, number, request_number, COALESCE(T6.username,'root') username,T1.account_name,
					DATE_FORMAT(T1.create_date,'%d %M %Y') tanggal, submitto, submitfrom,
					T1.list_id, T1.project_id, T1.loca_id,
					T3.op_titel as item, T4.op_titel as brand, T2.list_model, T2.list_sn,
					T5.loca_name,T5.loca_province, token, T1.purpose, duration, T7.username as userTo,T6.signature signatureUser,T7.signature signatureTo
				FROM tb_request T1 
					INNER JOIN tb_lists T2 ON T1.list_id=T2.list_id
					LEFT JOIN tb_options T3 ON T3.op_kode=T2.list_item AND T3.op_tipe='Items' 
					LEFT JOIN tb_options T4 ON T4.op_kode=T2.list_brand AND T4.op_tipe='Brands' AND T4.op_paren=T2.list_item
					LEFT JOIN tb_locations T5 ON T5.loca_code=T2.list_location_code
					LEFT JOIN tb_userapp T6 ON T6.id = T1.user_id 
					LEFT JOIN tb_userapp T7 ON T7.email = T1.submitto 
				WHERE 1=1  AND T1.id='".$id."'";
		$rec = $this->db->query($sql)->row();

		$filename = "request".$rec->number."-".date('m')."-".date('Y').".pdf";

		$pdf = new FPDF_Custom();
		$parameter['pdf'] 	= $pdf;
		$parameter['data'] 	= $rec;

		$parameter['data']->path = 'images/items/';
		$this->load->view('request_pdf',$parameter);

		$status = $pdf->Output($path.$filename,'F');
		$result = $this->send_email($rec);

		$msg = "error";
		if ($result){

			$data_update = array(
				'send_email' 	=> '1',
				'attachment'	=> $filename
			);
    		$this->db->where_in('id', $id);
    		$status = $this->db->update('tb_request', $data_update);

    		if ($status){
				$msg = "success";    			
    		}
		}

		$_SESSION['message'] = $msg;
		redirect('Request/form');
	}

	private function send_email($data){	

		$this->load->library('email');

		$data->link_approve 	= base_url('Link/confirmRequest').'/'.$data->token.'/'.base64_encode("APPROVE");
		$data->link_reject 		= base_url('Link/confirmRequest').'/'.$data->token.'/'.base64_encode("REJECT");

		$parameter['data']		= $data;
		$text = $this->load->view('template/send_request',$parameter, TRUE);

		$this->email->from($this->config->item('app_email'), 'Procurement Team - FHI 360 Indoensia');
		$this->email->to($data->submitto);

		$this->email->subject('Request '.$data->request_number);
		$this->email->message($text);
		
		// Attachment 
		// $filename = "request".$data->number."-".date('m')."-".date('Y').".pdf";
		// $fullpath = $this->config->item('document_path').'request\\'.$filename;
		// $this->email->attach($fullpath);

		// echo "<pre>";
		// print_r($this->email);
		// die();

		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $this->email->print_debugger(array('headers'));
		 	log_message('error', $this->email->print_debugger(array('headers')));
			die();
		}

		return $status;
	}

	function testSendEmail(){
		// $sql 	= "
		// 		SELECT 
		// 			T1.id, number, request_number,COALESCE(username,'root') username,T1.account_name,
		// 			DATE_FORMAT(T1.create_date,'%d %M %Y') tanggal, submitto, submitfrom,
		// 			T1.list_id, T1.project_id, T1.loca_id,
		// 			T3.op_titel as item, T4.op_titel as brand, T2.list_model, T2.list_sn,
		// 			T5.loca_name,T5.loca_province, token
		// 		FROM tb_request T1 
		// 			INNER JOIN tb_lists T2 ON T1.list_id=T2.list_id
		// 			LEFT JOIN tb_options T3 ON T3.op_kode=T2.list_item AND T3.op_tipe='Items' 
		// 			LEFT JOIN tb_options T4 ON T4.op_kode=T2.list_brand AND T4.op_tipe='Brands' AND T4.op_paren=T2.list_item
		// 			LEFT JOIN tb_locations T5 ON T5.loca_code=T2.list_location_code
		// 			LEFT JOIN tb_userapp T6 ON T6.id = T1.user_id 
		// 		WHERE 1=1  AND T1.id='8'";
		// $rec = $this->db->query($sql)->row();
		// $this->send_email($rec);
	}

	function data_json($get=""){
		
		$str='';
		parse_str($get);	

		if(isset($item)){
			$str.= " AND lis.list_item='".$item."' ";
		}else {
			if ($this->input->post('txt_search') != ""){
				$find = $this->input->post('txt_search');
				$str.= " AND lis.list_item IN (SELECT op_kode FROM tb_options WHERE trash=0 AND op_titel LIKE '%".$find."%' AND op_tipe='Items') ";
			}
		}
		
		if(isset($brand)){
			$str.= " AND lis.list_brand='".$brand."' ";
		}

		// die($str);

		$draw=$_REQUEST['draw'];
		$length=$_REQUEST['length'];
		$start=$_REQUEST['start'];
		$search=$_REQUEST['search']["value"];


		if($search!=""){
			$data_all=$this->M_request->get_data_request($str, $start, $length, $search);
			$count_all=$this->M_request->get_data_count($str, $search);
		}else{
			$data_all=$this->M_request->get_data_request($str, $start, $length);
			$count_all=$this->M_request->get_data_count($str);
		}

		$output=array();
		$output['draw']=$draw;
		$output['recordsTotal']=$output['recordsFiltered']=$count_all;
		$output['data']=array();
		$output['data']=$data_all;
		echo json_encode($output);
		
	}

	function get_request_number(){		
		$year 	= date("Y");
		$month 	= date("m");
		$sql = "SELECT number FROM tb_request WHERE 1=1 AND YEAR(create_date)='$year' AND MONTH(create_date)='$month' ORDER BY number DESC ";
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

	function directFund(){	
		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	= "";
		$data['smenu_titel']='Direct Fund';
		$data['authen'] 	= $this->authenty->sess();	

		$sql 				= "SELECT id,account_name,username,email FROM tb_userapp WHERE trash !=1 AND role='OPERATION'";
		$data['user'] 		= $this->db->query($sql)->result_array();
		
		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_direct_fund.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	function services(){
		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	= "";
		$data['smenu_titel']='Request Service';
		$data['authen'] 	= $this->authenty->sess();	

		$sql = "SELECT * FROM tb_items WHERE item_category='item_unit' ORDER BY item_name";
		$result = $this->db->query($sql)->result_array();		
		$option_item = "";
		foreach ($result as $key => $value) {
			$option_item .= "<option value='".$value['item_name']."'>".$value['item_name']."</option>";
		}
		$data['unit_item'] = $option_item;
		
		$sql = "select * from tb_vendor_category order by tb_vendor_category.category_name";
		$result = $this->db->query($sql)->result_array();		
		$option_item = "";
		foreach ($result as $key => $value) {
			$option_item .= "<option value='".$value['category_id']."'>".$value['category_name']."</option>";
		}
		$data['vendor_category'] = $option_item;
		
		$sql 				= "SELECT id,account_name,username,email FROM tb_userapp WHERE trash !=1 AND role='OPERATION'";
		$data['user'] 		= $this->db->query($sql)->result_array();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_request_service.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	function consumableStuff(){
		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	= "";
		$data['smenu_titel']='Request Consumable Stuff';
		$data['authen'] 	= $this->authenty->sess();	

		$sql = "SELECT * FROM tb_items WHERE item_category='item_unit' ORDER BY item_name";
		$result = $this->db->query($sql)->result_array();		
		$option_item = "";
		foreach ($result as $key => $value) {
			$option_item .= "<option value='".$value['item_name']."'>".$value['item_name']."</option>";
		}
		$data['unit_item'] = $option_item;
		
		$sql = "select distinct item_category category from tb_items WHERE item_category NOT IN ('duration','item_unit') order by category ";
		$result = $this->db->query($sql)->result_array();		
		$option_item = "";
		foreach ($result as $key => $value) {
			$option_item .= "<option value='".$value['category']."'>".$value['category']."</option>";
		}
		$data['consumable_stuff'] = $option_item;

		$sql 				= "SELECT id,account_name,username,email FROM tb_userapp WHERE trash !=1 AND role='OPERATION'";
		$data['user'] 		= $this->db->query($sql)->result_array();

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_request_consumable_stuff.php');
		$this->load->view('intranet_includes/v_footer.php');

	}

	function electronicRequest(){
		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	= "";
		$data['smenu_titel']='Request Equipment/Electronic';
		$data['authen'] 	= $this->authenty->sess();	

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_request_electronic.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	function consultant(){
		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	= "";
		$data['smenu_titel']='Request consultant';
		$data['authen'] 	= $this->authenty->sess();	

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_request_consultant.php');
		$this->load->view('intranet_includes/v_footer.php');

	}


	function saveDirectFund(){
		// echo "<pre>";

		$background = $this->input->post('txt_background');
		$what = $this->input->post('txt_what');
		$why = $this->input->post('txt_why');
		$who = $this->input->post('txt_who');
		$where = $this->input->post('txt_where');
		$date_start = $this->input->post('txt_from');
		$date_end = $this->input->post('txt_to');
		$justification = $this->input->post('txt_justification');
		
		$num_participant = $this->input->post('txt_num_participant');
		$num_guess = $this->input->post('txt_num_guess');
		$num_staff = $this->input->post('txt_num_staff');
		$num_person = $this->input->post('txt_num_person');
		$num_faciliator = $this->input->post('txt_num_facilitator');
		
		$isFullDay = $this->input->post('isFullDay');
		$isHalfDay = $this->input->post('isHalfDay');
		$isHotel = $this->input->post('isHotel');
		$isPerdiem = $this->input->post('isPerdiem');
		$isTransportation = $this->input->post('isTransportation');
		$isMisc = $this->input->post('isMisc');
		$isPrinting = $this->input->post('isPrinting');
		$isAirplaneTicket = $this->input->post('isAirplaneTicket');

		$create_by 		= trim($this->authenty->session_user());
		$create_date 	= date("Y-m-d H:i:s");
		$submitto		= $this->input->post('txt_submitto');
		$submitfrom		= $_SESSION['email'];

		$data = array(
			'background' => $background,	
			'what' => $what,	
			'why' => $why,	
			'who' => $who,	
			'where_location' => $where,	
			'date_start' => $date_start,	
			'date_end' => $date_end,	
			'justification' => $justification,	
			'num_participant' => $num_participant,	
			'num_guess' => $num_guess,	
			'num_staff' => $num_staff,	
			'num_person' => $num_person,	
			'num_facilitator' => $num_faciliator,	
			'isFullDay' => $isFullDay,	
			'isHalfDay' => $isHalfDay,	
			'isHotel' => $isHotel,	
			'isPerdiem' => $isPerdiem,	
			'isTransportation' => $isTransportation,	
			'isMisc' => $isMisc,	
			'isPrinting' => $isPrinting,	
			'isAirplaneTicket' => $isAirplaneTicket,

			'create_by'	=> $create_by,	
			'create_date'	=> $create_date,
			'token'		=> sha1($create_date.$create_by),
			'status'	=> 'PENDING',
			'submitto'	=> $submitto,
			'submitfrom'=> $submitfrom
		);

		$status = $this->db->insert('tb_mini_proposal', $data);
		if ($status){
			// echo "success";
			// create mini proposal & send email
			$insert_id = $this->db->insert_id();
			$this->miniProposal($insert_id, true);
		} else {
			// echo "failed";
		}

		// print_r($data);

		// echo "</pre>";
	}

	function miniProposal($id, $send_email = false){
        $this->load->library('FPDF_Custom');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$path 	= $this->config->item('mini_proposal_path');

		$sql 	= "	SELECT T1.*,date(T1.create_date) dateCreate,T2.username submittoUsername, T3.username submitfromUsername
 					FROM tb_mini_proposal T1 LEFT JOIN tb_userapp T2 ON T2.email=T1.submitto
 					LEFT JOIN tb_userapp T3 ON T3.email=T1.submitfrom
					WHERE 1=1 AND T1.id='".$id."'";
		$rec 	= $this->db->query($sql)->row();
// echo $this->db->last_query(); die();

		$pdf = new FPDF_Custom();
		$parameter['pdf'] 	= $pdf;
		$parameter['data'] 	= $rec;

// echo "<pre>"; print_r($parameter);die();
		// $parameter['data']->path = 'images/items/';
		$this->load->view('mini_proposal_pdf',$parameter);

		$pdf->Output();
		// if (!file_exists($path.$filename)){
		// 	$pdf->Output($path.$filename,'F');
		// } else {
		// 	$filename = "";
		// }

		$result = false;

		$msg = "error";

		$filename = $id."-miniprop-".date('YmdHis').".pdf";
		if ($rec->attachment == ""){
			// $pdf->Output($path.$filename,'F');
			$data_update = array(
				'attachment'	=> $filename
			);
    		$this->db->where_in('id', $id);
    		// $status = $this->db->update('tb_mini_proposal', $data_update);
		}

		if ($send_email){
			// $status = $this->send_mini_proposal($rec);
			if ($status){
				$msg = "success";
				$result = true;
			}
		} else {			
			$msg = "success";
			$result = true;
		}


		// echo $msg;
		return $result;
	}

	private function send_mini_proposal($data){	

		$this->load->library('email');

		$data->link_approve 	= base_url('Link/confirmMini').'/'.$data->token.'/'.base64_encode("APPROVE");
		$data->link_reject 		= base_url('Link/confirmMini').'/'.$data->token.'/'.base64_encode("REJECT");

		$parameter['data']		= $data;
		$text = $this->load->view('template/send_mini',$parameter, TRUE);

		$this->email->from($this->config->item('app_email'), 'Procurement Team - FHI 360 Indoensia');
		$this->email->to($data->submitto);

		$this->email->subject('Mini Proposal');
		$this->email->message($text);
		
		// Attachment 
		$filename = $data->attachment;
		$fullpath = $this->config->item('mini_proposal_path').$filename;
		$this->email->attach($fullpath);

		// echo "<pre>";
		// print_r($this->email);
		// die();

		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $this->email->print_debugger(array('headers'));
		 	log_message('error', $this->email->print_debugger(array('headers')));
			die();
		}

		return $status;
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


}



/* End of file request.php */
/* Location: ./application/modules/controllers/request/request.php */
