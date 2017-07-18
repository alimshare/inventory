<?php 
if (!defined('BASEPATH')) die();

class DirectFund extends CI_Controller
{
	
	private $menu_titel='Direct Fund';

	function __construct()
	{
		parent::__construct();
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}

		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$this->load->model('M_request');
        $this->load->library('FPDF_Custom');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
	}

	function index(){	

		if (isset($_SESSION['message'])){
			$data['message'] = $_SESSION['message'];
    		unset($_SESSION['message']);			
		}

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

	function saveDirectFund(){

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
			$insert_id 	= $this->db->insert_id(); // id of new record
			$filename 	= $this->miniProposal($insert_id, true); // create mini proposal , return name of file
			if ($filename != "") {
				$status = $this->sendEmailMiniProposal($insert_id); // send mini proposal via email
				if ($status) {	
					$_SESSION['message'] = "<strong>Mini proposal submitted successfully,</strong> 
											click the following link to view the attachment : 
											<a href='".base_url().$this->config->item('mini_proposal_path').$filename."' target='_blank'>view</a> ";
				} else {
					$_SESSION['message'] = "<strong>Failed to <em>send email</em></strong>";
				}					
			} else {
				$_SESSION['message'] = "<strong>Failed to <em>create file</em></strong>";					
			}
		}
		
		redirect('Request/DirectFund');
	}

	function miniProposal($id, $send_email = false){

		$result 	= "";

		$path 	= $this->config->item('mini_proposal_path');

		$rec = $this->M_request->getSendEmailData($id); // Get Send Email Data

		$pdf = new FPDF_Custom();
		$parameter['pdf'] 	= $pdf;
		$parameter['data'] 	= $rec;
		$this->load->view('mini_proposal_pdf',$parameter);

		$filename 	= $id."-miniprop-".date('YmdHis').".pdf";
		if ($rec->attachment == ""){
			$pdf->Output($path.$filename,'F'); // buat file 
			$data_update = array(
				'attachment'	=> $filename
			);
    		$this->db->where_in('id', $id);
    		$status = $this->db->update('tb_mini_proposal', $data_update);
    		
    		if ($status) $result = $filename;
		}

		return $result;
	}

	private function sendEmailMiniProposal($id){	

		$this->load->library('email');
		$data = $this->M_request->getSendEmailData($id); // Get Send Email Data

		
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

		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $this->email->print_debugger(array('headers'));
		 	log_message('error', $this->email->print_debugger(array('headers')));
			die();
		}

		return $status;
	}
}

 ?>