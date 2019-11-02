<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends Back_Controller
{
	private $view_dir = 'admin/pelelang/';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		if ($this->accRole === 'auctioner') {
			$this->load->model('admin/Bank_model', 'MBank');
		} else {
			redirect('admin');
		}
	}

	public function create()
	{
		$fnorek = $this->input->post('fnorek', TRUE);
		$fnama = $this->input->post('fnama', TRUE);
		$fbank = $this->input->post('fbank', TRUE);
		$fpelelang = $this->accBid;

		$dataInfo = array(
			'no_akun_bank' => $fnorek, 'nama_akun_bank' => $fnama, 'bank_akun_bank' => $fbank, 'id_pelelang' => $fpelelang
		);
		$result = $this->MBank->insert_data($dataInfo);

		if ($result > 0) {
			$data = "success";
			echo json_encode($data);
		} else {
			$data = "fail";
			echo json_encode($data);
		}
	}
}
