<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') !== true) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['location']      = 'Transaction';
        $data['user']          = $this->database->getrow('data_user');
        $data['transaction']   = $this->database->getrow('riwayat_user');
        $data['data']          = $this->database->getall('riwayat_user');
        $data['money']         = $this->database->sumall('data_user', 'SUM(saldo)');
        $data['deposit']       = $this->database->sumall('deposit_user', 'SUM(amount)');
        $data['withdraw']      = $this->database->sumall('payout_user', 'SUM(amount)');
    	$data['view']          = 'view/transaction';
        $this->load->view('template', $data);
    }
}
