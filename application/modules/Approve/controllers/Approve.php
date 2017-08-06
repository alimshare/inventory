<?php if (!defined('BASEPATH')) die();

class Approve extends CI_Controller {

	private $limit=20;
	private $site_id='';
	private $menu_titel='Approve';
	private $page_titel='Approve/Reject';
	private $message = "";

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		// $this->load->model('m_durations');
		if(!$this->authenty->check_editor()){
			redirect(base_url().'Logout');
		}
	}

	public function index()
	{
		$data['menu_titel']=$this->menu_titel;
		$data['page_titel']=$this->page_titel;

		$data['authen'] = $this->authenty->sess();

		$sql = "select id,request_number number,attachment,account_name user,create_date,token,'REQUEST' type from tb_request WHERE status='PENDING'
				UNION
				select id,purchase_number,attachment,create_by,create_date,token,'PURCHASE REQUEST' type from tb_purchase_header WHERE status='PENDING'
				UNION 
				select id,'-',attachment,create_by,create_date,token,'MINI PROPOSAL' type from tb_mini_proposal WHERE status='PENDING';";
		$data['data_all'] = $this->db->query($sql)->result_array();

		$sql = "select id,request_number number,attachment,account_name user,create_date,'REQUEST' type from tb_request WHERE status='REJECT'
				UNION
				select id,purchase_number,attachment,create_by,create_date,'PURCHASE REQUEST' type from tb_purchase_header WHERE status='REJECT'
				UNION 
				select id,'-',attachment,create_by,create_date,'MINI PROPOSAL' type from tb_mini_proposal WHERE status='REJECT';";
		$data['reject_all'] = $this->db->query($sql)->result_array();

		$sql = "select id,request_number number,attachment,account_name user,create_date from tb_request WHERE status='APPROVE'";
		$data['request_approve'] = $this->db->query($sql)->result_array();

		$sql = "SELECT T1.id,T1.purchase_number number,attachment,T1.create_by user,T1.create_date,T4.status 'statusNow', GROUP_CONCAT(T3.op_titel) item
				FROM tb_purchase_header T1 
				INNER JOIN tb_purchase_request T2 ON T1.id=T2.purchase_id 
				INNER JOIN tb_options T3 ON T3.op_id=T2.op_id 
				LEFT JOIN tb_quotation T4 ON T4.purchase_number=T1.purchase_number
				WHERE T1.status='APPROVE'
				GROUP BY T1.id,T1.purchase_number,attachment,T1.create_by,T1.create_date,T4.status";
		$data['pr_approve'] = $this->db->query($sql)->result_array();

		$sql = "SELECT T1.id,'-',T1.attachment,T1.create_by,T1.create_date,T1.token,'MINI PROPOSAL' type, COALESCE(T2.id, 0) purchase_id, T2.purchase_number 'purchase_number'
				FROM tb_mini_proposal T1 left join tb_purchase_header T2 on T1.id=T2.id_mini_proposal
				WHERE T1.status='APPROVE';";
		$data['mini_proposal'] = $this->db->query($sql)->result_array();

		$sql = "";
		$data['memo_approve'] = array();

		$sql = "";
		$data['po_approve'] = array();

		$data['path'] = base_url().'documents';

		if (isset($_SESSION['message'])){
			$data['message'] = $_SESSION['message'];
    		unset($_SESSION['message']);			
		}

		$this->load->view('intranet_includes/v_header.php', $data);
		$this->load->view('v_list.php');
		$this->load->view('intranet_includes/v_footer.php');
	}

	// function test(){
	// 	$_SESSION['message'] = 'success';
	// 	redirect('approve');
	// }

	public function data_json_all()
	{
		$str = "AND item_category='duration'";
		$data['data_all']=$this->m_durations->get_data_json_all($str);		
		echo json_encode(array('aaData' => $data['data_all']));
	}


	public function saveResponse($id, $requestType, $decision,$flag=0){		

		$error = 0;
		// $id = $this->input->post('txt_id');

		if ($decision == "YES"){
			$status = 'APPROVED';

			$title 		= 'Approve Request';
			$body 		= 'Your Request Approved';

		} else {
			$status 	= 'REJECTED';
			$title 		= 'Reject Request';
			$body 		= 'Your Request Rejected';
		}

		if ($requestType == 'REQUEST'){
			$tblname = 'tb_request';
			$sql = "SELECT number,request_number,account_name,DATE_FORMAT(T1.create_date,'%d %M %Y') tanggal, submitto,submitfrom,
					T1.list_id,T1.project_id,T1.loca_id,T3.op_titel as item,T4.op_titel as brand,T2.list_model,T2.list_sn,T5.loca_name,T5.loca_province,attachment
					FROM tb_request T1 INNER JOIN tb_lists T2 ON T1.list_id=T2.list_id
					LEFT JOIN tb_options T3 ON T3.op_kode=T2.list_item AND T3.op_tipe='Items' 
					LEFT JOIN tb_options T4 ON T4.op_kode=T2.list_item AND T3.op_tipe='Brands' 
					LEFT JOIN tb_locations T5 ON T5.loca_code=T2.list_location_code
					WHERE 1=1  AND id='".$id."'";

		} else if ($requestType == "PURCHASE"){
			$tblname = 'tb_purchase_header';
			$sql = "SELECT * FROM tb_purchase_header WHERE id='".$id."'";
		} else {
			$error++;
		}

		$result = 0;
		$attachment = "";
		if ($error == 0){

			if ($sql <> ""){
				$rec 		= $this->db->query($sql)->row_array();
				$to 		= $rec['submitfrom'];

				if ($status=="APPROVED" && $tblname=="tb_request") $attachment = $this->config->item('document_path').'request\\'.$rec['attachment'];
				if ($status=="APPROVED" && $tblname=="tb_purchase_header") $attachment = $this->config->item('document_path').'purchase_request\\'.$rec['attachment'];
				
				$result 	= $this->send_email($to, $title, $body, $attachment);			
				if ($result){
					$data_update = array(
						'status' 		=> $status
					);
					$this->db->where_in('id', $id);
					$status = $this->db->update($tblname, $data_update);

					if ($status){
						$result = $status;	
					}
				}	
			}			
		}

		if ($flag==0){
			redirect('Login');
		} else {
			redirect('Approve');
		}

		return $result;
	}

	private function send_email($sendTo, $subject='', $emailContent='', $attachment=''){

		$this->load->library('email');

		$this->email->from($this->config->item('app_email'), 'Procurement Team - FHI 360 Indoensia');
		$this->email->to($sendTo);

		$this->email->subject($subject);
		$this->email->message($emailContent);
		
		if ($attachment <> '') $this->email->attach($attachment);

		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $this->email->print_debugger(array('headers'));
			die();
		}

		return $status;
	}

	/* Response Request menggunakan Email */
	public function confirmRequest($token, $response){
		$message 	= "";
		$result 	= false;
		echo $response = base64_decode($response);
		echo "<br>";

		if ($response != "APPROVE" && $response != "REJECT") {
			$message	= "Respon tidak valid";
		} else {
			$sql 		= "SELECT id,status,attachment,submitfrom,list_id,account_name,request_number FROM tb_request WHERE token='$token'";
			$execute 	= $this->db->query($sql);
			if ($execute->num_rows() > 0){
				// token valid
				$row 	= $execute->row();
				if ($row->status == "PENDING"){

					$data_update = array(
						'status' 		=> $response
					);
					$this->db->where('token', $token);
					$status = $this->db->update('tb_request', $data_update);

					if ($status){
						
						$attachment = $this->config->item('request_path').$row->attachment;
						if ($response == "APPROVE"){
							$message = "Request Approved";
						} else {
							$message 	= "Request Rejected";
							$attachment = ""; // attachment hanya dikirim jika request APPROVE
						}

						$isSend = $this->send_email($row->submitfrom , 'Request '.$response.' : '.$row->request_number, $message, $attachment);
						if ($isSend){

							if ($response == "APPROVE"){
								$data_update = array(
									'list_user' => $row->account_name
								);
								$this->db->where('list_id', $row->list_id);
								$status = $this->db->update('tb_lists', $data_update);
							}

							$message = "\"The request has been approved\". Please check your email and or go to dashboard and view \"Aprove/Reject Menu\"";
							$result = true;

						} else {
							$message = "Send Email Failed ";
						}
					}				
				} else {
					$message = "Token sudah tidak berlaku";
				}
			} else {
				$message = "Token tidak valid";
			}
		}

		echo $this->message = $message;
		return $result;
	}

	public function confirmRequestApp($token,$response){
		$result = $this->confirmRequest($token, $response);
		// die();
		if ($result){
			$_SESSION['message'] = "success";
		} else {
			$_SESSION['message'] = "error";			
		}
		redirect('Approve');
	}

	public function confirmPurchase($token, $response){
		$message 	= "";
		$result 	= false;
		echo $response = base64_decode($response);
		echo "<br>";

		if ($response != "APPROVE" && $response != "REJECT") {
			$message	= "Respon tidak valid";
		} else {
			$sql 		= "SELECT id,status,attachment,submitfrom,create_by,user_id,purchase_number FROM tb_purchase_header WHERE token='$token'";
			$execute 	= $this->db->query($sql);
			if ($execute->num_rows() > 0){
				// token valid
				$row 	= $execute->row();
				if ($row->status == "PENDING"){

					$data_update = array(
						'status' 		=> $response
					);
					$this->db->where('token', $token);
					$status = $this->db->update('tb_purchase_header', $data_update);

					if ($status){
						
						$attachment = $this->config->item('purchase_path').$row->attachment;
						if ($response == "APPROVE"){
							$message = "Purchase Request Approved";
						} else {
							$message 	= "Purchase Request Rejected";
							$attachment = ""; // attachment hanya dikirim jika request APPROVE
						}

						$isSend = $this->send_email($row->submitfrom , 'Purchase Request '.$response.' : '.$row->purchase_number, $message, $attachment);
						if ($isSend){

							// if ($response == "APPROVE"){
							// 	$data_update = array(
							// 		'list_user' => $row->account_name
							// 	);
							// 	$this->db->where('list_id', $row->list_id);
							// 	$status = $this->db->update('tb_lists', $data_update);
							// }

							$message = "purchase request has been ".$response;	
							$result = true;						
						} else {
							$message = "Send Email Failed ";
						}
					}				
				} else {
					$message = "Token sudah tidak berlaku";
				}
			} else {
				$message = "Token tidak valid";
			}
		}

		echo $this->message = $message;
		return $result;
	}

	public function confirmPurchaseApp($token,$response){
		$result = $this->confirmPurchase($token, $response);
		// die();
		if ($result){
			$_SESSION['message'] = "success";
		} else {
			$_SESSION['message'] = "error";			
		}
		redirect('Approve');
	}


	public function confirmMiniProposal($token, $response){
		$message 	= "";
		$result 	= false;
		echo $response = base64_decode($response);
		echo "<br>";

		if ($response != "APPROVE" && $response != "REJECT") {
			$message	= "Respon tidak valid";
		} else {
			$sql 		= "SELECT id,status,attachment,submitfrom,create_by,background FROM tb_mini_proposal WHERE token='$token'";
			$execute 	= $this->db->query($sql);
			if ($execute->num_rows() > 0){
				// token valid
				$row 	= $execute->row();
				if ($row->status == "PENDING"){

					$data_update = array(
						'status' 		=> $response
					);
					$this->db->where('token', $token);
					$status = $this->db->update('tb_mini_proposal', $data_update);

					if ($status){
						
						$attachment = $this->config->item('mini_proposal_path').$row->attachment;
						if ($response == "APPROVE"){
							$message = "Mini Proposal Approved <br> <p>".$row->background."</p>";
						} else {
							$message = "Mini Proposal Rejected <br> <p>".$row->background."</p>";
							$attachment = ""; // attachment hanya dikirim jika request APPROVE
						}

						$isSend = $this->send_email($row->submitfrom , 'Mini Proposal '.$response, $message, $attachment);
						if ($isSend){

							// if ($response == "APPROVE"){
							// 	$data_update = array(
							// 		'list_user' => $row->account_name
							// 	);
							// 	$this->db->where('list_id', $row->list_id);
							// 	$status = $this->db->update('tb_lists', $data_update);
							// }

							$message = "mini proposal request has been ".$response;	
							$result = true;						
						} else {
							$message = "Send Email Failed ";
						}
					}				
				} else {
					$message = "Token sudah tidak berlaku";
				}
			} else {
				$message = "Token tidak valid";
			}
		}

		echo $this->message = $message;
		return $result;
	}

	public function confirmMiniProposalApp($token,$response){
		$result = $this->confirmMiniProposal($token, $response);
		// die();
		if ($result){
			$_SESSION['message'] = "success";
		} else {
			$_SESSION['message'] = "error";			
		}
		redirect('Approve');		
	}



}


/* End of file approve.php */
/* Location: ./application/modules/settings/controllers/approve.php */
