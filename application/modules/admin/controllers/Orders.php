<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends Back_Controller
{
	private $view_dir = 'admin/orders/';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		if ($this->accRole === 'admin' || $this->accRole === 'staff') {
			$this->load->model('admin/Tawaran_model', 'MBid');
			$this->load->model('admin/Order_model', 'MOrder');
			$this->load->model('admin/Konfirmasi_model', 'MConfirm');
			$this->load->model('admin/Ongkir_model', 'MOngkir');
			$this->load->model('admin/Produk_model', 'MProduk');
			$this->load->model('admin/Peserta_model', 'MPeserta');
			$this->load->model('admin/Pelelang_model', 'MPelelang');
		} else {
			redirect('admin');
		}
	}

	public function index()
	{
		$this->global['pageTitle'] = 'List Order';
		$this->global['contentHeader'] = 'List Order';
		$this->global['contentTitle'] = 'List Order';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$arrWhere = array();
		$rs_order = $this->MOrder->get_data($arrWhere, array('tgl_order' => 'ASC'), 500, 0);
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
			$row['confirm_id'] = $rs_confirm[0]['id_konfirmasi'];

			array_push($arr_data, $row);
		}

		$data['records'] = $arr_data;
		$this->digiAdminLayout($data, $this->view_dir . 'index', $this->global);
	}

	public function verify($order_num)
	{
		$this->global['pageTitle'] = 'Verify Payment ' . $order_num;
		$this->global['contentHeader'] = 'Verify Payment ' . $order_num;
		$this->global['contentTitle'] = 'Verify Payment ' . $order_num;
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs_order = $this->MOrder->get_data_orders(array('o.notrans_order'=> $order_num), array(), 1, 0);

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
			$rs_confirm = $this->MConfirm->get_data_info2($order_num);
			$row['item_name'] = $rs_items[0]['nama_lelang'];
			$row['item_img'] = $rs_items[0]['gambar_produk'];
			$row['item_status'] = $rs_items[0]['status_lelang'];
			$row['bid_price'] = (int) $rs_bid[0]['jumlah_tawaran'];
			$row['bid_type'] = $rs_bid[0]['tipe_tawaran'];
			$row['bidder'] = $rs_bidder[0]['nama_peserta'];
			$row['auctioner'] = $rs_auctioner[0]['nama_pelelang'];
			$row['order_total'] = (int) ($rs_bid[0]['jumlah_tawaran'] + $rs_ongkir[0]['jumlah_biaya_kirim']);
			$row['order_status'] = $rb['status_order'];
			$row['confirmation'] = $rs_confirm[0];

			array_push($arr_data, $row);
		}

		$data['records'] = $arr_data;
		$this->digiAdminLayout($data, $this->view_dir . 'verify', $this->global);
	}

	public function verify_paid($order_num)
	{
		$dataInfo = array('status_konfirmasi' => 1);
		$result = $this->MConfirm->update_data($dataInfo, $order_num);
		if ($result == true) {
			$dataInfo2 = array('status_order' => 'paid');
			$result2 = $this->MOrder->update_data($dataInfo2, $order_num);
			if ($result2) {
				setFlashData('success', 'Payment Confirmation Verified');
				redirect('admin/orders');
			} else {
				setFlashData('error', 'Payment Confirmation Unverified');
				redirect('admin/orders/verify' . $order_num);
			}
		} else {
			setFlashData('error', 'Payment Confirmation Unverified');
			redirect('admin/orders/verify' . $order_num);
		}
	}
}
