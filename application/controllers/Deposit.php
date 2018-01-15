<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {
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
        $data['location']      = 'Deposit';
        $data['user']          = $this->database->getrow('data_user');
        $data['transaction']   = $this->database->getrow('riwayat_user');
        $data['data']          = $this->database->getall('deposit_user');
        $data['money']         = $this->database->sumall('data_user', 'SUM(saldo)');
        $data['deposit']       = $this->database->sumall('deposit_user', 'SUM(amount)');
        $data['withdraw']      = $this->database->sumall('payout_user', 'SUM(amount)');
    	$data['view']          = 'view/deposit';
        $this->load->view('template', $data);
    }

    public function search()
    {
    	$key = $this->input->post('keyword');
    	if (empty($key)) {
    		$this->msg = "";
    	} else {
	    	$do = $this->database->getquery("SELECT * FROM data_user WHERE email LIKE '%$key%' ORDER BY email LIMIT 0,5");
	    	if ($do == false) {
	    		$this->msg = '<li>Nothing Found</li>';
	    	} else {
		    	foreach ($do as $value) {
		    	$this->msg = '<li onClick="selects('.$value->user_id.');">'.$value->email.'</li>';
				}
	    	}
    	}

    	echo $this->msg;
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
    	$id 		= $this->input->post('id');
    	$amount		= $this->input->post('amount');
    	$password	= $this->input->post('password');
    	if (empty($id) || empty($amount) || empty($password)) {
    		$this->msg = json_encode(array('error' => true, 'msg' => 'empty'));
    	} else {
    		$check = $this->database->check('data_admin', array('password' => $password, 'idadmin' => $this->session->userdata('id')));
    		if ($check !== false) {
    			$do = $this->database->custom("UPDATE data_user SET saldo = saldo+'$amount' WHERE user_id = $id");
    			if ($do == true) {
    				$get = $this->database->getwhere('data_user', array('user_id' => $id));
    				$data = array(
    					'invoice' 	=> "MD".$this->hash(5),
    					'iduser'	=> $id,
    					'amount'	=> $amount,
    					'date'		=> date('Y-m-d h:i:s'),
    					'cashier'	=> $this->session->userdata('id')
    				);
    				$set = $this->database->insertdt('deposit_user', $data);
    				$this->msg = json_encode(array('error' => false, 'name' => $get->name, 'amount' => "Rp ".number_format($amount)));
    			} else {
    				$this->msg = json_encode(array('error' => true, 'msg' => 'fail'));
    			}
    		} else {
				$this->msg = json_encode(array('error' => true, 'msg' => 'password'));
    		}
    	}
    	echo $this->msg;
    }
}

/* End of file Deposit.php */
/* Location: ./application/controllers/Deposit.php */