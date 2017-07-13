<?php if (!defined('BASEPATH')) die();

class Quotation extends CI_Controller {
	
	private $site_id="";
	private $menu_titel="quotation";

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now	= date('Y-m-d H:i:s');
		// $this->load->model('M_quotation','mm');
		if(!$this->authenty->check_subscriber()){
			redirect(base_url().'Logout');
		}
	}


	public function index($id='')
	{
		$data['menu_titel']		= $this->menu_titel;
		$data['page_titel']		= "Quotation";
		$data['smenu_titel']	= "Quotation";
		$data['authen'] 		= $this->authenty->sess();

		if (isset($_SESSION['message'])){
			$data['message'] = $_SESSION['message'];
    		unset($_SESSION['message']);			
		}

		if ($id <> ""){
			// get data
			$sql = "SELECT purchase_number FROM tb_purchase_header WHERE id='".$id."'";
			$data['purchase_number'] = $this->db->query($sql)->row_array()['purchase_number'];

			$sql = "SELECT GROUP_CONCAT(description) description FROM tb_purchase_request T1 
					INNER JOIN tb_options T2 ON T1.op_id=T2.op_id  WHERE purchase_id='".$id."'";
			$data['specification'] = $this->db->query($sql)->row_array()['description'];

			$sql = "SELECT T1.id, T1.vendor_name, T1.quotation, T1.purchase_request_number, T1.status
					FROM tb_quotation_respon T1 WHERE T1.purchase_request_number='".$data['purchase_number']."'";
			$data['quotation']	= $this->db->query($sql)->result_array();

		}
		$data['vendor']	= $this->db->query("SELECT * FROM tb_vendor WHERE isPreferred=1 AND trash<>1")->result_array();

		$sql = "SELECT * FROM tb_quotation";
		$data['quotation_list']	= $this->db->query($sql)->result_array();
		
		// Quotation
		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_quotation.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	public function save()
	{
		$vendor 		= $this->input->post('txt_vendor');
		$othervendor 	= $this->input->post('txt_otherVendor');
		$subject 		= $this->input->post('txt_subject');
		$specification 	= $this->input->post('txt_specification');
		$date 			= $this->input->post('txt_date');
		$purchase_number= $this->input->post('txt_purchase_number');
		$email_user 	= $_SESSION['email'];
		$attachment_tor	= "";
		$attachment_rfq	= "";
		$attachment_invitation	= "";
		$str_unique		= date('dMYHis');
		$error_arr 		= array();

		// validation here
		// .......

		$penerima = array();
		if (count($vendor) > 0){
			foreach ($vendor as $key => $value) {
				$x = explode("|", $value);
				$nama = $x[0];
				$email = $x[1];
				$data = array(
					'nama' => $nama,
					'email' => $email
				);
				$penerima[] = $data;
			}
		}
		if (count($othervendor) > 0){
			foreach ($othervendor as $key => $value) {
				$x = explode("|", $value);
				$nama = $x[0];
				$email = $x[1];
				$data = array(
					'nama' => $nama,
					'email' => $email
				);
				$penerima[] = $data;
			}
		}

		$data = array();
		// $sql = "SELECT t1.id,t2.op_titel as item, t1.description, t1.qty,t1.unit, t1.unit_price
		// 		FROM tb_purchase_request t1 INNER JOIN tb_options t2 ON t1.op_id=t2.op_id WHERE status=0";
		// $data = $this->db->query($sql)->result_array();
		if ($specification <> ""){
			$data = explode(",", $specification);			
		}

		// upload file tor
		// upload file rfq			
		$path_home='documents';
		if(!is_dir($path_home))
		{
			mkdir($path_home);
		}

		$path_dir= $this->config->item('quotation_path');//'documents/quotation';
		if(!is_dir($path_dir))
		{
			mkdir($path_dir);
		}

        if ($_FILES['tor']['name'] <> "") {
        	$filename = "tor-".$str_unique.$_FILES['tor']['name'];
			$config1['upload_path']          = $path_dir.'/';
	        $config1['allowed_types']        = 'pdf|docx|doc';
        	$config1['file_name'] = $filename;
            if (0 < $_FILES['tor']['error']) {
                $error_arr[] = 'Error during file upload' . $_FILES['tor']['error'];
            } else {
                if (file_exists($path_dir.'/'. $filename)) {
					$error_arr[] = 'File already exists : ' . $filename;
                } else {
                    $this->load->library('upload', $config1);
                    $this->upload->initialize($config1);
                    if (!$this->upload->do_upload('tor')) {
                        $error_arr[] = $filename." - ".$this->upload->display_errors();
                    } else {
						$attachment_tor = $filename;
                    }
                }
            }
        }
        if ($_FILES['rfq']['name'] <> "") {
        	$filename = "rfq-".$str_unique.$_FILES['rfq']['name'];
			$config2['upload_path']          = $path_dir.'/';
	        $config2['allowed_types']        = 'pdf|docx|doc';
        	$config2['file_name'] = $filename;
            if (0 < $_FILES['rfq']['error']) {
                $error_arr[] = 'Error during file upload' . $_FILES['rfq']['error'];
            } else {
                if (file_exists($path_dir.'/'. $filename)) {
					$error_arr[] = 'File already exists : ' . $filename;
                } else {
                    $this->load->library('upload', $config2);
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_upload('rfq')) {
                        $error_arr[] = $filename." - ".$this->upload->display_errors();
                    } else {
						$attachment_rfq = $filename;
                    }
                }
            }
        }
        if ($_FILES['invitation']['name'] <> "") {
        	$filename = "inv-".$str_unique.$_FILES['invitation']['name'];
			$config3['upload_path']          = $path_dir.'/';
	        $config3['allowed_types']        = 'pdf|docx|doc';
        	$config3['file_name'] = $filename;
            if (0 < $_FILES['invitation']['error']) {
                $error_arr[] = 'Error during file upload' . $_FILES['invitation']['error'];
            } else {
                if (file_exists($path_dir.'/'. $filename)) {
					$error_arr[] = 'File already exists : ' . $filename;
                } else {
                    $this->load->library('upload', $config3);
                    $this->upload->initialize($config3);
                    if (!$this->upload->do_upload('invitation')) {
                        $error_arr[] = $filename." - ".$this->upload->display_errors();
                    } else {
						$attachment_invitation = $filename;
                    }
                }
            }
        }
        // print_r($_FILES);
        // die();

        $msg = "error";
        if (count($error_arr) == 0){
			//save data to table
			$param = array(
				'subject'			=> $subject,
				'specification'		=> $specification,
				'submission_date'	=> $date,
				'attachment_tor' 	=> $attachment_tor,
				'attachment_rfq'	=> $attachment_rfq,
				'attachment_invitation'	=> $attachment_invitation,
				'purchase_number'	=> $purchase_number
			);
			$result = $this->db->insert('tb_quotation', $param);
			$insert_id = $this->db->insert_id();

			// send email
			if (count($penerima) > 0){
				foreach ($penerima as $key => $value) {
					
					$token = sha1("quot".$insert_id."-".$value['email'].date('d-M-Y H:i:s'));
					$link  = base_url('link/submission/').$token;

					$status = $this->send_email($value['email'], $value['nama'], $data, $date, $email_user, $subject, $attachment_tor, $attachment_rfq, $attachment_invitation, $link);
					if ($status) {						
						$param = array(
							'name'		=> $value['nama'],
							'email'		=> $value['email'],
							'isSend'	=> '1',
							'quotation_id' => $insert_id,
							'token'		=> $token
						);
					} else {			
						$param = array(
							'name'		=> $value['nama'],
							'email'		=> $value['email'],
							'isSend'	=> '0',
							'quotation_id' => $insert_id,
							'token'		=> $token
						);
					}
					// status == 1 (Berhasil terkirim) || status == 0 (Gagal terkirim)
					$result = $this->db->insert('tb_quotation_recipient', $param);
				}
			}
        	$msg = "success";

        } else {
        	print_r($error_arr);
		 	log_message('error', implode(", ", $error_arr));
        }

		$_SESSION['message'] = $msg;
		$_SESSION['error_arr'] =$error_arr;
		redirect('Quotation');
		// echo "<pre>";
		// print_r($penerima);

	}

	public function saveWinner(){
		$purchase_number 	= $this->input->post('txt_purchase_number');
		$winner 			= $this->input->post('txt_winner');

		$data = array(
			'status' => 'WINNER'
		);
		$where = array(
			'id'	=> $winner
		);

		// update data vendor pemenang
		$status = $this->db->update('tb_quotation_respon', $data, $where);
		echo $this->db->last_query();
		if ($status){
			$data = array(
				'status' => 'CLOSED'
			);
			$where = array(
				'purchase_number'	=> $purchase_number
			);
			// close quotation karena sudah ada pemenangnya
			$status = $this->db->update('tb_quotation', $data, $where);
			echo $this->db->last_query();
			if ($status){
				// die();
				redirect('Quotation');			
			}
		}
		// print_r($data);
	}

	private function send_email($email_to ='', $nama='', $data ='', $submision_date='', $email_user='', $subject, $attachment_tor, $attachment_rfq, $attachment_invitation, $link = ''){
		
		$text = "<p>Dear  Bapak/Ibu ".$nama."</p>";
		$text .= "<br>";
		$text .= "<p style='text-align:justify'>FHI 360 Indonesia is dedicated to improving lives in lasting ways by advancing integrated, locally driven solutions for human development. In partnership with government agencies and nongovernmental organizations, FHI 360 oversees initiatives that prevent and treat HIV, particularly among most-at-risk populations; that provide state-of-the-art responses to tuberculosis (TB); and that strengthen the Indonesian military’s response to HIV.</p>";
		$text .= "<p>FHI 360 now invite you to send a quotation for the following item:</p>";
		
		// Data
		if (count($data)>0){
			// $text .= "<table border='1' cellpadding='8px' cellspacing='0'>
			// 			<tr>
			// 				<th>No</th>
			// 				<th>Item</th>
			// 				<th>description</th>
			// 				<th>Qty</th>
			// 				<th>Unit</th>
			// 				<th>Estimated Cost</th>
			// 			</tr>";

			// 	$no = 1;
			// 	foreach ($data as $key => $value) {
			// 		$text .= "<tr>";
			// 		$text .= "
			// 			<td>".$no++."</td>
			// 			<td>".$value['item']."</td>
			// 			<td>".$value['description']."</td>
			// 			<td>".$value['qty']."</td>
			// 			<td>".$value['unit']."</td>
			// 			<td>".number_format($value['unit_price'] * $value['qty'])."</td>";
			// 		$text .= "</tr>";
			// 	}

			// $text .= "</table>";
			$text .= "<ul>";
			for ($i=0; $i < count($data); $i++) { 
				$text .= "<li>".$data[$i]."</li>";
			}
			$text .= "</ul>";

		}
		$text .= "<p>Please find TOR and RFP/RFQ on atatchments for detail information.</p>";
		$text .= "<p>The last submission on ".$submision_date.", please upload your quotation to this <a href='".$link."'>link</a></p>";
		$text .= "<br>";
		$text .="<p>Jakarta, ".date('d F Y')."</p>";
		$text .="<p>Procurement Team</p>";
		$text .="<p>FHI 360 Indonesia</p>";

		$this->load->library('email');
		$this->email->from($email_user, 'Procurement Team - FHI 360 Indoensia');
		$this->email->to($email_to);

		$this->email->subject($subject);
		$this->email->message($text);

		// Attachment 
		$path_dir= $this->config->item('quotation_path');//FCPATH.'documents/quotation/';
		if ($attachment_tor <> ''){
			$this->email->attach($path_dir.$attachment_tor);			
		}
		if ($attachment_rfq <> ''){
			$this->email->attach($path_dir.$attachment_rfq);			
		}
		if ($attachment_invitation <> ''){
			$this->email->attach($path_dir.$attachment_invitation);			
		}

		// You need to pass FALSE while sending in order for the email data
		// to not be cleared - if that happens, print_debugger() would have
		// nothing to output.
		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $log = $this->email->print_debugger(array('headers'));
		 	log_message('error', $this->email->print_debugger(array('headers')));
			// die();
		}

		// echo "Sending Email ...";
		return $status;
	}


}


/* End of file quotation.php */
/* Location: ./application/modules/quotation/controllers/quotation.php */
