<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saldo extends Back_Controller
{
	private $view_dir = 'admin/pelelang/';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		if ($this->accRole === 'auctioner') {
			$this->load->model('admin/Bank_model', 'MBank');
			$this->load->model('admin/Saldo_model', 'MSaldo');
		} else {
			redirect('admin');
		}
	}

	public function withdraw()
	{
		$this->global['pageTitle'] = "Penarikan Saldo";
		$this->global['contentHeader'] = 'Penarikan Saldo';
		$this->global['contentTitle'] = 'Penarikan Saldo';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$data = array();
		$rs_akun_bank = $this->MBank->get_data_info($this->accBid);
		$data['records_akun_bank'] = empty($rs_akun_bank) ? array() : $rs_akun_bank;
		$this->digiAdminLayout($data, $this->view_dir . 'saldo', $this->global);
	}

	public function request_withdrawal()
	{
		$pelelang = $this->accBid;
		$id_akun_bank = $this->input->post('fid', TRUE);
		$saldo = (int) $this->input->post('fsaldo', TRUE);

		$dataInfo = array('id_pelelang' => $pelelang, 'id_akun_bank' => $id_akun_bank, 'jumlah_saldo' => $saldo);
		$result = $this->MSaldo->insert_data($dataInfo);

		if ($result > 0) {
			setFlashData('success', 'Saldo telah sukses direquest');
			redirect('admin/pelelang/profil/' . $this->accKey);
		} else {
			setFlashData('error', 'Saldo gagal direquest');
			redirect('admin/saldo/withdraw');
		}
	}
}
