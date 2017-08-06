<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->load->view('message/confirmation_message');
	}

	public function submission($token=''){
		$message 	= "";
		$stat 		= "";
		$type 		= "";

		if ($token == ""){
			$message = "Token tidak valid";
			$stat 	 = "Peringatan ! ";
			$type 	 = "warning";
		} else {
			$sql = "SELECT T1.*, T2.subject, T2.submission_date, T2.purchase_number, T2.specification, T2.status statusQuotation, T3.vendor_name vendor
					from tb_quotation_recipient T1 inner join tb_quotation T2 on T1.quotation_id=T2.id left join tb_vendor T3 on T3.vendor_email=T1.email 
					where token ='$token'";
			$result = $this->db->query($sql)->row_array();

			if (count($result) == 0){
				$message = "Token tidak valid";
				$stat 	 = "Peringatan ! ";
				$type 	 = "warning";
			} else {
				$result['token'] = $token;
				if ($result['status']=="SUBMITTED"){
					if (isset($_SESSION['message'])){
						$message 	= $_SESSION['message'];
						$stat 	 	= "Success ! ";
						$type 	 	= "success";	
			    		unset($_SESSION['message']);			
					} else {
						$message 	= "Data sudah di submit, harap menghubungi admin jika ingin melakukan perbaikan data.";	
						$stat 	 	= "Success ! ";
						$type 	 	= "success";					
					}
				} else {
					$this->load->view('other/v_submission',$result);
				}				
			}
		}

		// echo $message;
		$parameter['type'] 		= $type;
		$parameter['status'] 	= $stat;
		$parameter['message'] 	= $message;
		$this->load->view('message/confirmation_message', $parameter);
	}

	public function submitQuotation(){
		$id 		= $this->input->post('txt_id');
		$vendor 	= $this->input->post('txt_vendor');
		$quotation 	= $this->input->post('txt_quotation');
		$purchase_number 	= $this->input->post('txt_purchase_number');
		$token 		= $this->input->post('txt_token');
		$email 		= $this->input->post('txt_email');
		$attachment = "";	

		// upload file quotation	
		$path_home='documents';
		if(!is_dir($path_home))
		{
			mkdir($path_home);
		}

		$path_dir= $this->config->item('vendorquotation_path');//'documents/vendor_quotation';
		if(!is_dir($path_dir))
		{
			mkdir($path_dir);
		}

        if ($_FILES['txt_quotation']['name'] <> "") {
			$config['upload_path']          = $path_dir.'/';
	        $config['allowed_types']        = 'pdf|docx';
	        if ($_FILES['txt_quotation']['name'] <> "") {

	        	$filename = $id.'-'.date('YmdHis').'-'.$_FILES['txt_quotation']['name'];
	        	$config['file_name'] = $filename;

	            if (0 < $_FILES['txt_quotation']['error']) {
	                echo $error_arr = 'Error during file upload' . $_FILES['txt_quotation']['error'];
	            } else {
	                if (file_exists($path_dir.'/'. $filename)) {
						echo $error_arr = 'File already exists : ' . $filename;
	                } else {
	                    $this->load->library('upload', $config);
	                    if (!$this->upload->do_upload('txt_quotation')) {
	                        echo $error_arr = $filename." - ".$this->upload->display_errors();
	                    } else {
							$attachment = $filename;
	                    }
	                }
	            }
	        }
	    }

	    if ($attachment <> ""){
	    	$data = array(
				'purchase_request_number'	=> $purchase_number,
				'quotation'					=> $attachment,
				'status'					=> 'PARTICIPANT',
				'date_submission'			=> date('Y-m-d'),
				'vendor_name'				=> $vendor,
				'id_quotation_recipient'	=> $id
	    	);

	    	$status = $this->db->insert('tb_quotation_respon', $data);
	    	if ($status){
	    		$data = array(
	    			'status' => 'SUBMITTED',
	    			'isConfirmed' => 1
	    		);
	    		$where = array(
	    			'id'	=> $id
	    		);
	    		$status = $this->db->update('tb_quotation_recipient', $data, $where);
	    		if ($status){
	    			$body_email = $vendor." has submitted the document for purchase number : ".$purchase_number ;

	    			$this->send_email($email, 'Quotation Response', $body_email, ''); // send ke vendor yang sudah melakukan upload

	    			$sql = "select GROUP_CONCAT(email) email from tb_userapp where role='OPERATION'";
	    			$res = $this->db->query($sql)->row_array();
	    			if (count($res)==0){
						$attachment = $this->config->item('vendorquotation_path').$attachment;
	    				$this->send_email($res['email'], 'Quotation Response', $body_email, $attachment); // send ke admin	    				
	    			}

	    			$_SESSION['message'] = 'success';
	    			redirect('Link/submission/'.$token);
	    		}
	    	}
	    }

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
		$stat 		= "";
		$type 		= "";

		$result 	= false;
		$response = base64_decode($response);
		// echo "<br>";

		if ($response != "APPROVE" && $response != "REJECT") {
			$message	= "Respon tidak valid";
			$stat 	 	= "Error ! ";
			$type 	 	= "danger";
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
							$message 	= "Request Approved";
							$stat 	 	= "Approve";
							$type 	 	= "success";
						} else {
							$message 	= "Request Rejected";
							$stat 	 	= "Rejected";
							$type 	 	= "success";
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
							$stat 	 	= "Info";
							$type 	 	= "info";
							$result = true;

						} else {
							$message 	= "Send Email Failed ";
							$stat 	 	= "Error, ";
							$type 	 	= "danger";
						}
					}				
				} else {
					$message = "Token sudah tidak berlaku";
					$stat 	 = "Peringatan ! ";
					$type 	 = "warning";
				}
			} else {
				$message = "Token tidak valid";
				$stat 	 = "Peringatan ! ";
				$type 	 = "warning";
			}
		}

		// echo $this->message = $message;
		
		$parameter['type'] 		= $type;
		$parameter['status'] 	= $stat;
		$parameter['message'] 	= $message;
		$this->load->view('message/confirmation_message', $parameter);

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
		redirect('approve');
	}

	public function confirmPurchase($token, $response){
		$message 	= "";
		$stat 		= "";
		$type 		= "";
		$result 	= false;
		
		$response = base64_decode($response);
		// echo "<br>";

		if ($response != "APPROVE" && $response != "REJECT") {
			$message	= "Respon tidak valid";
			$stat 	 	= "Error ! ";
			$type 	 	= "danger";
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
							$stat 	 	= "Approved ! ";
							$type 	 	= "success";
						} else {
							$message 	= "Purchase Request Rejected";
							$stat 	 	= "Rejected ! ";
							$type 	 	= "success";
							$attachment = ""; // attachment hanya dikirim jika request APPROVE
						}

						$isSend = $this->send_email($row->submitfrom , 'Purchase Request '.$response.' : '.$row->purchase_number, $message, $attachment);
						if ($isSend){
							// $message = "purchase request has been ".$response;
							$message = "\"The purchase request has been approved\". Please check your email and or go to dashboard and view \"Aprove/Reject Menu\"";
							$stat 	 	= "Info";
							$type 	 	= "info";	
							$result = true;						
						} else {
							$message = "Send Email Failed ";
							$stat 	 	= "Error, ";
							$type 	 	= "danger";
						}
					}				
				} else {
					$message = "Token sudah tidak berlaku";
					$stat 	 = "Peringatan ! ";
					$type 	 = "warning";
				}
			} else {
				$message = "Token tidak valid";
				$stat 	 = "Peringatan ! ";
				$type 	 = "warning";
			}
		}

		// echo $this->message = $message;
		
		$parameter['type'] 		= $type;
		$parameter['status'] 	= $stat;
		$parameter['message'] 	= $message;
		$this->load->view('message/confirmation_message', $parameter);

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
		redirect('approve');
	}

	public function confirmMini($token, $response){
		$message 	= "";
		$stat 		= "";
		$type 		= "";
		$result 	= false;
		
		$response = base64_decode($response);
		// echo "<br>";

		if ($response != "APPROVE" && $response != "REJECT") {
			$message	= "Respon tidak valid";
			$stat 	 	= "Error ! ";
			$type 	 	= "danger";
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
							$message 	= "Mini Proposal Approved <br> <p>".$row->background."</p>";
							$stat 	 	= "Approved ! ";
							$type 	 	= "success";
						} else {
							$message 	= "Mini Proposal Rejected <br> <p>".$row->background."</p>";
							$stat 	 	= "Rejected ! ";
							$type 	 	= "success";
							$attachment = ""; // attachment hanya dikirim jika request APPROVE
						}

						$isSend = $this->send_email($row->submitfrom , 'Mini Proposal '.$response, $message, $attachment);
						if ($isSend){

							// $message = "mini proposal request has been ".$response;	
							$message = "\"The purchase request has been ".strtolower($response)."\". Go to dashboard and view \"Aprove/Reject Menu\" for history ";
							$stat 	 	= "Info : ";
							$type 	 	= "info";
							$result = true;						
						} else {
							$message = "Send Email Failed ";
							$stat 	 	= "Error ! ";
							$type 	 	= "danger";
						}
					}				
				} else {
					$message = "Token sudah tidak berlaku";
					$stat 	 = "Peringatan ! ";
					$type 	 = "warning";
				}
			} else {
				$message = "Token tidak valid";
				$stat 	 = "Peringatan ! ";
				$type 	 = "warning";
			}
		}

		// echo $this->message = $message;
		
		$parameter['type'] 		= $type;
		$parameter['status'] 	= $stat;
		$parameter['message'] 	= $message;
		$this->load->view('message/confirmation_message', $parameter);
		
		return $result;
	}

	public function confirmMinieApp($token,$response){
		$result = $this->confirmMini($token, $response);
		// die();
		if ($result){
			$_SESSION['message'] = "success";
		} else {
			$_SESSION['message'] = "error";			
		}
		redirect('approve');
	}

	public function forget_password($token=""){
		$message 	= "";
		$stat 		= "";
		$type 		= "";

		if ($token <> ""){

			$sql 		= "SELECT 1 FROM tb_userapp WHERE token='$token'";
			$execute 	= $this->db->query($sql);
			if ($execute->num_rows() > 0){
				// token valid
				$row 	= $execute->row();

				$data['token'] = $token;
				$this->load->view('other/recovery_password.php', $data);

			} else {
				$message = "Token not valid";
				$stat 	 = "Warning ! ";
				$type 	 = "warning";
			}

		} else {
			$message = "Token not valid";
			$stat 	 = "Warning ! ";
			$type 	 = "warning";			
		}
		
		

		// echo $this->message = $message;
		$parameter['type'] 		= $type;
		$parameter['status'] 	= $stat;
		$parameter['message'] 	= $message;
		$this->load->view('message/confirmation_message', $parameter);

	}

}
