<?php if (!defined('BASEPATH')) die();

	
class ConsumableStuff extends CI_Controller
{
	
	private $menu_titel='Consumable Stuff Request';

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}
	}

	function index(){
		
		if (isset($_SESSION['message'])){
			$data['message'] = $_SESSION['message'];
    		unset($_SESSION['message']);			
		}

		$data['menu_titel']	= $this->menu_titel;
		$data['page_titel']	= "";
		$data['smenu_titel']='Request Consumable Stuff';
		$data['authen'] 	= $this->authenty->sess();	

		$data['unit_item'] = $this->M_General->getItems('item_unit','option');
		
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

	function saveConsumableStuff(){

		if (!isset($_POST['stuff'])){
			redirect('Request/ConsumableStuff');
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

		$gfas 			= $this->M_General->getGFAS($_SESSION['project_id']);
		$number			= $this->M_General->get_purchase_number();
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
			'purchase_type'	=> 'STUFF',
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
				);
				$status = $this->db->insert('tb_purchase_request',$data);

				if (!$status){
					$hit_error++;
		 			log_message('error', $this->db->last_query());
				}
			}

			if ($hit_error == 0){ // tidak ada error

				$filename = $this->pdf($request_id); // create file , return filename
				if ($filename != ""){
					$status = $this->send_email($request_id); // send request via email
					if ($status) {
						$_SESSION['message'] = "<strong>Consumable Stuff Request submitted successfully,</strong> 
												click the following link to view the attachment : 
												<a href='".base_url().$this->config->item('purchase_path').$filename."' target='_blank'>view</a> ";
					} else {
						$_SESSION['message'] = "<strong>Failed to <em>send email</em></strong>";
					}					
				} else {
					$_SESSION['message'] = "<strong>Failed to <em>create file</em></strong>";					
				}			

			}			
		}

		redirect('Request/ConsumableStuff');
		
	}

	private function pdf($id){
        $this->load->library('FPDF_Custom');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$data = $this->getSendEmailData($id);
		$this->load->view('purchase_pdf', $data);

		$path 		= $this->config->item('purchase_path');
		$filename 	= "purchase".$data['header']['number']."-".date('m')."-".date('Y').".pdf";
		$fullpath 	= $path.$filename;

		if (!file_exists($fullpath)){ // jika file PDF tidak terbentuk 
			$filename = "";
		}

		return $filename;
	}	



	private function send_email($id){

		$this->load->library('email');
		$data = $this->getSendEmailData($id);

		$data['link_approve'] 	= base_url('Link/confirmPurchase').'/'.$data['header']['token'].'/'.base64_encode("APPROVE");
		$data['link_reject']	= base_url('Link/confirmPurchase').'/'.$data['header']['token'].'/'.base64_encode("REJECT");

		$parameter['data']		= $data;
		$text = $this->load->view('template/send_purchase',$parameter, TRUE);

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

		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $this->email->print_debugger(array('headers'));
			// echo $attachment;
		 	log_message('error', $this->email->print_debugger(array('headers')));
			die();

		} else {

			$data_update = array(
				'send_email' => '1'
			);
    		$this->db->where_in('id', $id);
    		$this->db->update('tb_purchase_header', $data_update);

		}

		// echo "<br>success send email to : ".$data['header']['submitto'];
		return $status;
	}

	private function getSendEmailData($id) {
		$sql 	= "	SELECT T1.*,DATE_FORMAT(T1.create_date,'%d %M %Y')  tanggal,T2.username,T2.email,T2.signature 
					FROM tb_purchase_header T1 LEFT JOIN tb_userapp T2 ON T1.create_by=T2.account_name WHERE T1.id = '".$id."'";
		$data['header'] = $this->db->query($sql)->row_array();
		$data['header']['path'] = 'images/items/';

		$sql 	= "	SELECT tb_purchase_request.*
					FROM tb_purchase_request WHERE purchase_id = '".$id."'";
		$data['data'] 	= $this->db->query($sql)->result_array();

		$data['header']['gfas'] = $this->M_General->getGFAS($_SESSION['project_id']);

		return $data;
	}

}


?>