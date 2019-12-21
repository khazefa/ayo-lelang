<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bid extends Back_Controller
{
	private $view_dir = 'admin/bid/';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		if ($this->accRole === 'auctioner') {
			$this->load->model('Tawaran_model', 'MBid');
			$this->load->model('Order_model', 'MOrder');
			$this->load->model('Konfirmasi_model', 'MConfirm');
			$this->load->model('Ongkir_model', 'MOngkir');
			$this->load->model('Produk_model', 'MProduk');
			$this->load->model('Peserta_model', 'MPeserta');
			$this->load->model('Pelelang_model', 'MPelelang');
		} else {
			redirect('admin');
		}
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
			$row['item_id'] = $rs_produk[0]['id_lelang'];
			$row['item_img'] = $rs_produk[0]['gambar_produk'];
			$row['item_name'] = $rs_produk[0]['nama_lelang'];
			$row['bidder_name'] = $rs_peserta[0]['nama_peserta'];
			$row['max_price'] = $rs_produk[0]['harga_maksimal'];
			$row['bid_price'] = $rb['jumlah_tawaran'];
			$row['bid_time'] = $rb['waktu_tawaran'];
			$row['bid_type'] = $rb['tipe_tawaran'];
			$row['bid_status'] = $rb['status_tawaran'];

			array_push($arr_bid, $row);
		}
		$data['records'] = $arr_bid;
		$this->digiAdminLayout($data, $this->view_dir . 'index', $this->global);
	}

	public function accept($id = NULL, $item_id = NULL)
	{
		$dataInfo = array('status_tawaran' => 'accepted');

		$result = $this->MBid->update_data($dataInfo, $id);
		if ($result == true) {
			$dataInfo2 = array('status_lelang' => 'end');
			$result2 = $this->MProduk->update_data($dataInfo2, $item_id);
			if($result2) {
				setFlashData('success', 'Bid is successfully Accepted');
			}
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

	public function orders()
	{
		$rs = array();
		$arrWhere = array();
		$arrOrder = array('o.tgl_order' => 'DESC');
		$limit = 0;

		$this->global['pageTitle'] = 'List Order';
		$this->global['contentHeader'] = 'List Order';
		$this->global['contentTitle'] = 'List Order';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$arrWhere = array('b.id_pelelang' => $this->accBid);
		$rs_order = $this->MOrder->get_data_orders($arrWhere, array('tgl_order' => 'ASC'), 500, 0);
		$arr_data = array();
		foreach ($rs_order as $rb) {
			$row['id'] = $rb['id_order'];
			$row['order_num'] = $rb['notrans_order'];
			$row['order_date'] = $rb['tgl_order'];
			$row['peserta_id'] = $rb['id_peserta'];
			$row['bid_id'] = $rb['id_tawaran'];
			$rs_bid = $this->MBid->get_data_info($row['bid_id']);
			$row['item_id'] = (int) $rs_bid[0]['id_lelang'];
			$rs_items = $this->MProduk->get_data_info($row['item_id']);
			$rs_ongkir = $this->MOngkir->get_data_info($rb['id_biaya_kirim']);
			$rs_bidder = $this->MPeserta->get_data_info2($rb['id_peserta']);
			$rs_auctioner = $this->MPelelang->get_data_info2($rs_items[0]['id_pelelang']);
			$rs_confirm = $this->MConfirm->get_data_info2($rb['notrans_order']);
			$row['item_name'] = $rs_items[0]['nama_lelang'];
			$row['item_img'] = $rs_items[0]['gambar_produk'];
			$row['item_status'] = $rs_items[0]['status_lelang'];
			$row['bid_price'] = (int) $rs_bid[0]['jumlah_tawaran'];
			$row['bid_type'] = $rs_bid[0]['tipe_tawaran'];
			$row['bidder'] = $rs_bidder[0]['nama_peserta'];
			$row['auctioner'] = $rs_auctioner[0]['nama_pelelang'];
			$row['order_total'] = (int) ($rs_bid[0]['jumlah_tawaran'] + $rs_ongkir[0]['jumlah_biaya_kirim']);
			$row['order_status'] = $rb['status_order'];
			$row['no_resi'] = $rb['order_no_resi'];
			$row['confirm_id'] = $rs_confirm[0]['id_konfirmasi'];

			array_push($arr_data, $row);
		}

		$data['records'] = $arr_data;
		$this->digiAdminLayout($data, $this->view_dir . 'order', $this->global);
	}
}
