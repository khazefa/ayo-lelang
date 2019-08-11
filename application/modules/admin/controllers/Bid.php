<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bid extends Back_Controller
{
	private $view_dir = 'admin/bid/';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		$this->load->model('Tawaran_model', 'MBid');
		$this->load->model('Produk_model', 'MProduk');
		$this->load->model('Peserta_model', 'MPeserta');
	}

	public function index()
	{
		$rs = array();
		$arrWhere = array();
		$arrOrder = array('waktu_tawaran' => 'ASC');
		$limit = 0;

		$this->global['pageTitle'] = 'List Bid';
		$this->global['contentHeader'] = 'List Bid';
		$this->global['contentTitle'] = 'List Bid';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$arrWhere = array('id_pelelang' => $this->accBid);
		$rs_bid = $this->MBid->get_data($arrWhere, $arrOrder, $limit);

		$arr_bid = array();
		foreach ($rs_bid as $rb) {
			$rs_produk = $this->MProduk->get_data_info((int)$rb['id_lelang']);
			$rs_peserta = $this->MPeserta->get_data_info2((int)$rb['id_peserta']);
			$row['id'] = $rb['id_tawaran'];
			$row['item_img'] = $rs_produk[0]['gambar_produk'];
			$row['item_name'] = $rs_produk[0]['nama_lelang'];
			$row['bidder_name'] = $rs_peserta[0]['nama_peserta'];
			$row['bid_price'] = $rb['jumlah_tawaran'];
			$row['bid_time'] = $rb['waktu_tawaran'];
			$row['bid_type'] = $rb['tipe_tawaran'];
			$row['bid_status'] = $rb['status_tawaran'];

			array_push($arr_bid, $row);
		}
		$data['records'] = $arr_bid;
		$this->digiAdminLayout($data, $this->view_dir . 'index', $this->global);
	}

	public function accept($id = NULL)
	{
		$dataInfo = array('status_tawaran' => 'accepted');

		$result = $this->MBid->update_data($dataInfo, $id);
		if ($result == true) {
			setFlashData('success', 'Bid is successfully Accepted');
		} else {
			setFlashData('error', 'Bid is failed to Accept');
		}
		redirect('admin/bid');
	}

	public function reject($id = NULL)
	{
		$dataInfo = array('status_tawaran' => 'rejected');

		$result = $this->MBid->update_data($dataInfo, $id);
		if ($result == true) {
			setFlashData('success', 'Bid is successfully Rejected');
		} else {
			setFlashData('error', 'Bid is failed to Rejected');
		}
		redirect('admin/bid');
	}
}
