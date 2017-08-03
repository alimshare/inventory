<?php
if (!defined('BASEPATH')) die();
class Login extends CI_Controller {
	public function __construct()
	{
				parent::__construct();
				$this->load->helper('String_manipulation');
				//$this->load->helper(array('form', 'url'));
				$this->load->library('Authenty');
				date_default_timezone_set('Asia/Jakarta');
				$now=date('Y-m-d H:i:s');
				$this->site_id="1";
				if(isset($_SESSION['pass_changed'])){
					unset($_SESSION['pass_changed']);
				}
	}

	public function index()
	{
		$this->load->view('v_login.php');
	}

	public function do_login(){
		$this->load->library('Form_validation');
		$this->form_validation->set_message('required', '%s harus Diisi.');

		$this->form_validation->set_rules('txt_login_name', 'Nama login', 'trim|xss_clean');
		$this->form_validation->set_rules('txt_login_pass', 'Password', 'trim|xss_clean');

		error_reporting(E_ALL ^ E_DEPRECATED);
		$user = trim($this->input->post('txt_login_name'));
		$pass = trim($this->input->post('txt_login_pass'));
		$pass_encryte = sha1(md5($pass));

		if($this->authenty->do_validate($user,$pass_encryte) == FALSE){
			echo "The username or password you use is invalid";
		}else{
			echo "ok";
		}
	}

	public function logout(){
		session_destroy();
		redirect('Login','refresh');	
	}

	public function forget_password(){
		$this->load->view('forget_password.php');
	}

	public function forget_password_submit(){
		$this->load->library('Form_validation');
		$this->form_validation->set_rules('txt_email', 'Email', 'required|trim|xss_clean|valid_email');
		// generate token
		$email = $this->input->post('txt_email');
		$token = sha1(date('YmdHis').$email.'fhi360'.date('YmdHis'));
		$link  = base_url('Link/forget_password/').$token; 

		$data = array(
			'token' => $token
		);
		$update = $this->db->update('tb_userapp', $data, array('email'=> $email));
		if ($update){
			// send email
			// echo $this->db->last_query();
			// print_r($data);
			// die();
			$status = $this->send_email_forget_password($email, $link);

			if ($status) {
				redirect('Login');
			}
		} else {
			redirect('Login');
		}
	}

	private function send_email_forget_password($target, $link){

		$text = "<p>Click the provided link to reset your password : <br>";
		$text = "<a href='".$link."' target='_blank'>".$link."</a></p>";

		$this->load->library('email');

		$this->email->from($this->config->item('app_email'), 'Procurement Team - FHI 360 Indoensia');
		$this->email->to($target);

		$this->email->subject('Recovery Password');
		$this->email->message($text);
		
		$status = $this->email->send(FALSE);
		if (!$status) {
			// Will only print the email headers, excluding the message subject and body
			echo $this->email->print_debugger(array('headers'));
		 	log_message('error', $this->email->print_debugger(array('headers')));
			die();
		}

		return $status;
	}

	public function reset_password_submit(){

		$this->load->library('form_validation');
		$this->form_validation->set_message('required', '%s required.');
		$this->form_validation->set_rules('token', 'Password', 'required|trim|xss_clean');
		$this->form_validation->set_rules('txt_login_pass1', 'Password', 'required|trim|xss_clean|matches[txt_login_pass2]');
		
		$token 		= $this->input->post('token');
		$password 	= $this->input->post('txt_login_pass1');
		$data = array(
			'password' => sha1(md5($password)),
			'token' => ''
		);
		$update = $this->db->update('tb_userapp', $data, array('token'=> $token));
		if ($update){
			redirect('Login');
		} else {
			echo "Something error <br>please call administrator for more info";
		}

	}

}

/* End of file login.php */
/* Location: ./application/controllers/intranet/login.php */
