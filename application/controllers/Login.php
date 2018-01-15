<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login')) {
            redirect('transaction');
        }
    }

    public function index()
    {
        $this->load->view('login');
    }

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if ($email == '' || $password == '') {
			$this->msg = array('login' => false, 'message' => 'empty');
		} else {
			$data = array('email' => $email, 'password' => $password);
			if ( $do = $this->database->login('data_admin', $data)) {
				$arr = array('login' => true, 'session' => $email, 'name' => $do->name, 'id' => $do->idadmin);
				$this->session->set_userdata($arr);
				$this->msg = array('login' => true, 'message' => 'success');
			} else {
				$this->msg = array('login' => false, 'message' => 'failed');
			}
		}
		echo json_encode($this->msg);
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */