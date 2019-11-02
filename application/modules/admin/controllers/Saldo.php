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
			$this->load->model('admin/Order_model', 'MOrder');
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
		$fpelelang = $this->accBid;
		$fid_akun_bank = $this->input->post('fid', TRUE);
		$fsaldo = (int) $this->input->post('fsaldo', TRUE);

		$arrWhere = array('b.id_pelelang' => $fpelelang, 'o.status_order' => 'received');

		$arrWhere2 = array('p.id_pelelang' => $fpelelang, 's.status' => 1);

		$orders = $this->MOrder->get_total_orders($arrWhere);
		$saldo_p = $this->MSaldo->get_total_saldo($arrWhere2);

		$saldo = (int) $saldo_p[0]['total'];
		$total_order = (int) $orders[0]['total'];
		$jml_saldo = $total_order - $saldo;

		if ($fsaldo > (int) $jml_saldo) {
			setFlashData('error', 'Jumlah dana yang Anda minta melebihi sisa Total Order yang Anda miliki');
			redirect('admin/saldo/withdraw');
		} else {
			$dataInfo = array('id_pelelang' => $fpelelang, 'id_akun_bank' => $fid_akun_bank, 'jumlah_saldo' => $fsaldo);
			$result = $this->MSaldo->insert_data($dataInfo);

			if ($result > 0) {
				setFlashData('success', 'Pencairan dana akan diproses oleh admin dalam waktu 1x24jam');
				redirect('admin/pelelang/profil/' . $this->accKey);
			} else {
				setFlashData('error', 'Saldo gagal direquest');
				redirect('admin/saldo/withdraw');
			}
		}
	}
}
