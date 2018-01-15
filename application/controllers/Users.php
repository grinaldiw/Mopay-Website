<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    private $msg;
	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') !== true) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['location']      = 'Users';
        $data['user']          = $this->database->getrow('data_user');
        $data['transaction']   = $this->database->getrow('riwayat_user');
        $data['data']          = $this->database->getall('data_user');
        $data['money']         = $this->database->sumall('data_user', 'SUM(saldo)');
        $data['deposit']       = $this->database->sumall('deposit_user', 'SUM(amount)');
        $data['withdraw']      = $this->database->sumall('payout_user', 'SUM(amount)');
    	$data['view']          = 'view/users';
        $this->load->view('template', $data);
    }

    private function hash($lenght)
    { 
        $chars = "1234567890";
        $key = "";
        for($i = 0; $i <= $lenght; $i++){
            if (count($key) == $lenght) {
                $key = $key;
            } else {
                $key .= $chars[mt_rand(0, strlen($chars)-1)];
            }
        }
            return $key;
    }

    public function add()
    {
        $username   = $this->input->post('email');
        $name       = $this->input->post('name');
        if (empty($username) || empty($name)) {
            $this->msg = json_encode(array('error' => true));
        } else {
            $email      = $username."@student.smktelkom-mlg.sch.id";
            $password   = substr($username, 0, 5);
            $data       = array(
                    'user_id'    => $this->hash(6),
                    'name'       => $name,
                    'email'      => $email,
                    'password'   => $password,
                    'saldo'      => 0,
                    'status'     => 'Active'
            );

            $do = $this->database->insertdt('data_user', $data);
            if ($do == true) {
                $this->msg = json_encode(array('error' => false, 'email' => $email));
            } else {
                $this->msg = json_encode(array('error' => true)); 
            }
        }
        echo $this->msg;
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $do = $this->database->deletewhere('data_user', array('user_id' => $id));
        if ($do == true) {
            $this->msg = json_encode(array('error' => false));
        } else {
            $this->msg = json_encode(array('error' => true));
        }

        echo $this->msg;
    }
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */