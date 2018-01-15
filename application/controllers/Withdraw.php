<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') !== true) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['location']      = 'Withdraw';
        $data['user']          = $this->database->getrow('data_user');
        $data['transaction']   = $this->database->getrow('riwayat_user');
        $data['data']          = $this->database->getall('payout_user');
        $data['money']         = $this->database->sumall('data_user', 'SUM(saldo)');
        $data['deposit']       = $this->database->sumall('deposit_user', 'SUM(amount)');
        $data['withdraw']      = $this->database->sumall('payout_user', 'SUM(amount)');
    	$data['view']          = 'view/withdraw';
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
        $id         = $this->input->post('id');
        $amount     = $this->input->post('amount');
        $password   = $this->input->post('password');
        if (empty($id) || empty($amount) || empty($password)) {
            $this->msg = json_encode(array('error' => true, 'msg' => 'empty'));
        } else {
            $check = $this->database->check('data_user', array('password' => $password, 'user_id' => $id));
            if ($check !== false) {
                if ($check->saldo < $amount) {
                    $this->msg = json_encode(array('error' => true, 'msg' => 'saldo'));
                } else {
                    $do = $this->database->custom("UPDATE data_user SET saldo = saldo-'$amount' WHERE user_id = $id");
                    if ($do == true) {
                        $get = $this->database->getwhere('data_user', array('user_id' => $id));
                        $data = array(
                            'invoice'   => "MW".$this->hash(5),
                            'iduser'    => $id,
                            'amount'    => $amount,
                            'date'      => date('Y-m-d h:i:s'),
                            'cashier'   => $this->session->userdata('id')
                        );
                        $set = $this->database->insertdt('payout_user', $data);
                        $this->msg = json_encode(array('error' => false, 'name' => $get->name, 'amount' => "Rp ".number_format($amount)));
                    } else {
                        $this->msg = json_encode(array('error' => true, 'msg' => 'fail'));
                    }
                }
            } else {
                $this->msg = json_encode(array('error' => true, 'msg' => 'password'));
            }
        }
        echo $this->msg;
    }

}

/* End of file Withdraw.php */
/* Location: ./application/controllers/Withdraw.php */