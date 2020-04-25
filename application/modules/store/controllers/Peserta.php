<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Peserta.php.
 * Desc: Extending Front_Controller. Check /core/Front_Controller
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Peserta extends Front_Controller
{
	private $view_dir = 'store/peserta';

	function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		$this->load->model('store/Peserta_model', 'MPeserta');
		$this->load->model('store/Pelelang_model', 'MPelelang');
		$this->load->model('store/Tawaran_model', 'MBid');
		$this->load->model('store/Order_model', 'MOrder');
		$this->load->model('store/Konfirmasi_model', 'MConfirm');
		$this->load->model('store/Produk_model', 'MProduk');
		$this->load->model('store/Kota_model', 'MKota');
		$this->load->model('store/Ongkir_model', 'MOngkir');
	}

	/**
	 * Show Front interface
	 */
	function index()
	{
		if ( $this->session->userdata('signed_in') ) {
			$this->profil();
			exit;
		} else {
			$this->registrasi();
			exit;
		}
	}

	/**
	 * Show Registration Form
	 */
	function registrasi()
	{
		$this->global['pageTitle'] = 'Registrasi';
		$this->global['contentTitle'] = 'Registrasi';
		$this->global['name'] = $this->uName;

		$data = array();
		$rs_kota = $this->MKota->get_data(array(), array(), 0);
		$data['records_kota'] = $rs_kota;
		$this->digiLayout($data, $this->view_dir . "/daftar", $this->global);
	}

	/**
	 * Submit Registration Form
	 */
	function insert_data()
	{
		$reg_as = $this->input->post('reg_as', TRUE);
		$reg_nama = $this->input->post('reg_nama', TRUE);
		$reg_email = $this->input->post('reg_email', TRUE);
		$reg_username = $this->input->post('reg_username', TRUE);
		$reg_password = $this->input->post('reg_password', TRUE);
		$password = sha1($reg_password);
		$reg_address = $this->input->post('reg_address', TRUE);
		$reg_kota = $this->input->post('reg_kota', TRUE);
		$reg_phone = $this->input->post('reg_phone', TRUE);
		$current_date = date('Y-m-d H:i:s');

		if ( $reg_as === "bidder" ) {
			$dataInfo = array(
				'nama_peserta' => $reg_nama, 'akun_peserta' => $reg_username, 'sandi_peserta' => $password,
				'email_peserta' => $reg_email, 'telepon_peserta' => $reg_phone, 'alamat_peserta' => $reg_address, 'id_kota' => $reg_kota, 'tgl_daftar_peserta' => $current_date, 'status_peserta' => 1
			);
			$count = $this->MPeserta->check_data_exists(array('email_peserta' => $reg_email));
			if ($count > 0) {
				setFlashData('error', 'Alamat Email ' . $reg_email . ' yang Anda input sudah ada, harap input alamat email yang lain.');
				redirect('peserta/registrasi');
			} else {
				$result = $this->MPeserta->insert_data($dataInfo);

				if ($result > 0) {
					setFlashData('success', $reg_nama . ', Anda telah terdaftar di sistem kami.');
					redirect('peserta/registrasi');
				} else {
					setFlashData('error', $reg_nama . ', Anda gagal terdaftar di sistem kami.');
					redirect('peserta/registrasi');
				}
			}
		} elseif ($reg_as === "auctioner") {
			$dataInfo = array(
				'nama_pelelang' => $reg_nama, 'akun_pelelang' => $reg_username, 'sandi_pelelang' => $password,
				'email_pelelang' => $reg_email, 'telepon_pelelang' => $reg_phone, 'alamat_pelelang' => $reg_address, 'id_kota' => $reg_kota, 'tgl_daftar_pelelang' => $current_date, 'status_pelelang' => 1
			);
			$count = $this->MPelelang->check_data_exists(array('email_pelelang' => $reg_email));
			if ($count > 0) {
				setFlashData('error', 'Alamat Email ' . $reg_email . ' yang Anda input sudah ada, harap input alamat email yang lain.');
				redirect('peserta/registrasi');
			} else {
				$result = $this->MPelelang->insert_data($dataInfo);

				if ($result > 0) {
					setFlashData('success', $reg_nama . ', Anda telah terdaftar di sistem kami.');
					redirect('peserta/registrasi');
				} else {
					setFlashData('error', $reg_nama . ', Anda gagal terdaftar di sistem kami.');
					redirect('peserta/registrasi');
				}
			}
		} else {
			setFlashData('error', 'Harap mengisi form registrasi.');
			redirect('peserta/registrasi');
		}
	}

	/**
	 * Modify Users
	 */
	function modify_data()
	{
		$reg_nama = $this->input->post('reg_nama', TRUE);
		$reg_email = $this->input->post('reg_email', TRUE);
		$reg_username = $this->input->post('reg_username', TRUE);
		$reg_password = $this->input->post('reg_password', TRUE);
		$reg_address = $this->input->post('reg_address', TRUE);
		$reg_kota = $this->input->post('reg_kota', TRUE);
		$reg_phone = $this->input->post('reg_phone', TRUE);

		if (!empty($reg_password)) {
			$password = sha1($reg_password);
			$dataInfo = array(
				'nama_peserta' => $reg_nama, 'sandi_peserta' => $password,
				'email_peserta' => $reg_email, 'telepon_peserta' => $reg_phone, 'alamat_peserta' => $reg_address, 'id_kota' => $reg_kota
			);
		} else {
			$dataInfo = array(
				'nama_peserta' => $reg_nama,
				'email_peserta' => $reg_email, 'telepon_peserta' => $reg_phone, 'alamat_peserta' => $reg_address, 'id_kota' => $reg_kota
			);
		}

		$result = $this->MPeserta->update_data($dataInfo, $reg_username);

		if ($result > 0) {
			setFlashData('success', 'Informasi Akun Anda telah sukses diubah');
			redirect('peserta/profil');
		} else {
			setFlashData('error', 'Informasi Akun Anda gagal diubah');
			redirect('peserta/profil');
		}
	}

	/**
	 * Show Profile Page
	 */
	function profil()
	{
		if ($this->session->userdata('signed_in')) {
			$this->global['pageTitle'] = 'Profil Peserta';
			$this->global['contentTitle'] = 'Profil Peserta';
			$this->global['name'] = $this->uName;

			$username = $this->uKey;
			$rs_peserta = $this->MPeserta->get_data_info($username);

			$data['records_peserta'] = $rs_peserta;
			$rs_kota = $this->MKota->get_data(array(), array(), 0);
			$data['records_kota'] = $rs_kota;
			$this->digiLayout($data, $this->view_dir . "/profil", $this->global);
		} else {
			$this->registrasi();
		}
	}

	/**
	 * Show Status Bid Page
	 */
	function status_bid()
	{
		if ($this->session->userdata('signed_in')) {
			$this->global['pageTitle'] = 'Status Bid';
			$this->global['contentTitle'] = 'Status Bid';
			$this->global['name'] = $this->uName;

			$peserta_id = $this->uBid;
			$username = $this->uKey;

			$arrWhere = array('id_peserta' => $peserta_id);
			$rs_bid = $this->MBid->get_data($arrWhere, array('waktu_tawaran' => 'ASC'), 100, 0);
			$arr_data = array();
			foreach ($rs_bid as $rb) {
				$row['id'] = $rb['id_tawaran'];
				$row['peserta_id'] = $peserta_id;
				$row['item_id'] = (int) $rb['id_lelang'];
				$rs_items = $this->MProduk->get_data_info((int) $rb['id_lelang']);
				$row['item_name'] = empty($rs_items) ? "Item telah dihapus" : $rs_items[0]['nama_lelang'];
				$row['item_img'] = empty($rs_items) ? "undefined.jpg" : $rs_items[0]['gambar_produk'];
				$row['item_status'] = empty($rs_items) ? "undefined" : $rs_items[0]['status_lelang'];
				$row['bid_price'] = (int) $rb['jumlah_tawaran'];
				$row['bid_type'] = $rb['tipe_tawaran'];
				$row['bid_time'] = $rb['waktu_tawaran'];
				$row['bid_status'] = $rb['status_tawaran'];
				$rs_order = $this->MOrder->get_data(array('id_tawaran' => $rb['id_tawaran']), array(), 1, 0);
				$row['order_status'] = !empty($rs_order) ? $rs_order[0]['status_order'] : '';

				array_push($arr_data, $row);
			}

			$data['records_bid'] = $arr_data;
			$this->digiLayout($data, $this->view_dir . "/status_bid", $this->global);
		} else {
			$this->registrasi();
		}
	}

	/**
	 * Show Checkout Bid Page
	 */
	function checkout($id)
	{
		if ($this->session->userdata('signed_in')) {
			$this->global['pageTitle'] = 'Checkout Order';
			$this->global['contentTitle'] = 'Checkout Order';
			$this->global['name'] = $this->uName;

			$username = $this->uKey;

			$rs_bid = $this->MBid->get_data_info((int)$id);
			$rs_items = $this->MProduk->get_data_info((int)$rs_bid[0]['id_lelang']);
			
			$rs_peserta = $this->MPeserta->get_data_info($username);
			$rs_kota = $this->MKota->get_data_info((int)$rs_peserta[0]['id_kota']);
			$rs_ongkir = $this->MOngkir->get_data_info((int)$rs_kota[0]['id_kota']);

			$data['records_peserta'] = $rs_peserta;
			$data['records_kota'] = $rs_kota;
			$data['records_ongkir'] = $rs_ongkir;
			$data['records_produk'] = $rs_items;
			$data['records_bid'] = $rs_bid;
			$this->digiLayout($data, $this->view_dir . "/checkout", $this->global);
		} else {
			$this->registrasi();
		}
	}

	/**
	 * Show Invoice Page
	 */
	function list_invoice()
	{
		if ($this->session->userdata('signed_in')) {
			$this->global['pageTitle'] = 'List Invoice';
			$this->global['contentTitle'] = 'List Invoice';
			$this->global['name'] = $this->uName;

			$peserta_id = $this->uBid;
			$username = $this->uKey;

			$arrWhere = array('id_peserta' => $peserta_id);
			$rs_order = $this->MOrder->get_data($arrWhere, array('tgl_order' => 'ASC'), 100, 0);
			$arr_data = array();
			foreach ($rs_order as $rb) {
				$row['id'] = $rb['id_order'];
				$row['order_num'] = $rb['notrans_order'];
				$row['order_date'] = $rb['tgl_order'];
				$row['peserta_id'] = $peserta_id;
				$row['bid_id'] = $rb['id_tawaran'];
				$rs_bid = $this->MBid->get_data_info($row['bid_id']);
				$row['item_id'] = (int) $rs_bid[0]['id_lelang'];
				$rs_items = $this->MProduk->get_data_info($row['item_id']);
				$rs_ongkir = $this->MOngkir->get_data_info($rb['id_biaya_kirim']);
				$row['item_name'] = empty($rs_items) ? "Item telah dihapus" : $rs_items[0]['nama_lelang'];
				$row['item_img'] = empty($rs_items) ? "undefined.jpg" : $rs_items[0]['gambar_produk'];
				$row['item_status'] = empty($rs_items) ? "undefined" : $rs_items[0]['status_lelang'];
				$row['bid_price'] = (int) $rs_bid[0]['jumlah_tawaran'];
				$row['bid_type'] = $rs_bid[0]['tipe_tawaran'];
				$row['order_total'] = (int) ( $rs_bid[0]['jumlah_tawaran'] + $rs_ongkir[0]['jumlah_biaya_kirim'] );
				$row['order_status'] = $rb['status_order'];

				array_push($arr_data, $row);
			}

			$data['records_order'] = $arr_data;
			$this->digiLayout($data, $this->view_dir . "/invoice", $this->global);
		} else {
			$this->registrasi();
		}
	}

	/**
	 * Process Order
	 */
	function add_order()
	{
		$no_trans = $this->MOrder->get_key_data("TR");
		$tgl_order = date('Y-m-d H:i:s');
		$bid_id = $this->input->post('id', TRUE);
		$shipping_id = $this->input->post('id_ongkir', TRUE);
		$peserta_id = $this->uBid;

		$dataInfo = array(
			'notrans_order' => $no_trans, 'tgl_order' => $tgl_order, 'id_tawaran' => (int) $bid_id, 'id_biaya_kirim' => (int) $shipping_id, 'id_peserta' => (int) $peserta_id
		);
		$count = $this->MOrder->check_data_exists(array('notrans_order' => $no_trans));
		if ($count > 0) {
			setFlashData('error', 'Telah terjadi kesalahan sistem, harap mengulangi proses Checkout Anda.');
			redirect('peserta/checkout/' . $bid_id);
		} else {
			$result = $this->MOrder->insert_data($dataInfo);

			if ($result > 0) {
				setFlashData('success', 'Nomor Order ', $no_trans . ', telah sukses dibuat.');
				redirect('peserta/list-invoice');
			} else {
				setFlashData('error', 'Nomor Order ', $no_trans . ', telah gagal dibuat.');
				redirect('peserta/list-invoice');
			}
		}
	}

	/**
	 * Show Payment Information Page
	 */
	function pay_order($id)
	{
		$this->global['pageTitle'] = 'Pay Order';
		$this->global['contentTitle'] = 'Pay Order';
		$this->global['name'] = $this->uName;

		$data['no_order'] = $id;
		$this->digiLayout($data, $this->view_dir . "/payment_info", $this->global);
	}

	/**
	 * Show Payment Confirmation Page
	 */
	function pay_confirm()
	{
		$this->global['pageTitle'] = 'Confirm Payment';
		$this->global['contentTitle'] = 'Confirm Payment';
		$this->global['name'] = $this->uName;

		$id = $this->input->post('id', TRUE);

		$data['no_order'] = $id;
		$this->digiLayout($data, $this->view_dir . "/confirmation", $this->global);
	}

	/**
	 * Process Confirm Payment
	 */
	function add_pay()
	{
		$no_trans = $this->input->post('no_trans', TRUE);
		$date_add = date('Y-m-d H:i:s');
		$no_rek = $this->input->post('no_rek', TRUE);
		$rek_bank = $this->input->post('rek_bank', TRUE);
		$rek_nama = $this->input->post('rek_nama', TRUE);
		$tgl_transfer = $this->input->post('tgl_transfer', TRUE);
		$jml_transfer = $this->input->post('jml_transfer', TRUE);
		$bank_transfer = $this->input->post('bank_transfer', TRUE);
		$bukti_transfer = "bukti_transfer";
		$peserta_id = $this->uBid;

		$config['upload_path']          = './uploads/bukti_transfer/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 2048;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 1024;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($bukti_transfer)) {
			setFlashData('error', 'Gagal upload gambar ' . $this->upload->display_errors());
			$dataInfo = array(
				'tgl_konfirmasi' => $date_add, 'notrans_order' => $no_trans, 'no_rek' => $no_rek, 'nama_bank' => $rek_bank, 'atas_nama' => $rek_nama, 'nominal' => $jml_transfer, 'tgl_transfer' => $tgl_transfer, 'id_peserta' => $peserta_id, 'bank_tujuan' => $bank_transfer
			);
		} else {
			setFlashData('success', 'Sukses upload gambar ' . $this->upload->data('file_name'));
			$filename = $this->upload->data('file_name');       // Returns: mypic.jpg
			$dataInfo = array(
				'tgl_konfirmasi' => $date_add, 'notrans_order' => $no_trans, 'no_rek' => $no_rek, 'nama_bank' => $rek_bank, 'atas_nama' => $rek_nama, 'nominal' => $jml_transfer, 'tgl_transfer' => $tgl_transfer, 'id_peserta' => $peserta_id, 'bank_tujuan' => $bank_transfer, 'file_konfirmasi' => $this->upload->data('file_name')
			);
		}

		$count = $this->MConfirm->check_data_exists(array('notrans_order' => $no_trans));
		if ($count > 0) {
			setFlashData('error', 'Anda sudah pernah mengkonfirmasi order '.$no_trans.' sebelumnya.');
			redirect('peserta/list-invoice');
		} else {
			$result = $this->MConfirm->insert_data($dataInfo);

			if ($result > 0) {
				setFlashData('success', 'Nomor Order '. $no_trans . ', telah sukses dikonfirmasi.');
				// $this->MOrder->update_data(array('status_order'=>'verify_pay'), $no_trans);
				$this->MOrder->update_data(array('status_order'=>'paid'), $no_trans); // directly update status paid to auctioner
				redirect('peserta/list-invoice');
			} else {
				setFlashData('error', 'Nomor Order '. $no_trans . ', telah gagal dikonfirmasi.');
				redirect('peserta/list-invoice');
			}
		}
	}

	/**
	 * Show Shipping Detail Page
	 */
	function shipping_detail($id)
	{
		$this->global['pageTitle'] = 'Lihat Resi Pengiriman ' . $id;
		$this->global['contentTitle'] = 'Lihat Resi Pengiriman ' . $id;
		$this->global['name'] = $this->uName;

		$arrWhere = array('notrans_order' => $id);
		$rs_order = $this->MOrder->get_data($arrWhere, array(), 1, 0);

		$data['order'] = $rs_order;
		$data['no_order'] = $id;
		$this->digiLayout($data, $this->view_dir . "/shipping-detail", $this->global);
	}

	/**
	 * Action Finish Order (Change Status Order)
	 */
	function finish_order()
	{
		$fid = $this->input->post('id', TRUE);
		$status = $this->input->post('order_accept');

		if ( empty($status) ) {
			redirect('peserta/shipping-detail/' . $fid);
		} else {
			$dataInfo = array('status_order' => $status);
			$result = $this->MOrder->update_data($dataInfo, $fid);
			if ($result == true) {
				setFlashData('success', 'Your Order is Done');
				redirect('peserta/list-invoice');
			} else {
				setFlashData('error', 'Failed Update Order');
				redirect('peserta/shipping-detail/' . $fid);
			}
		}
	}
}
