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

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		$this->load->model('store/Peserta_model', 'MPeserta');
		$this->load->model('store/Tawaran_model', 'MBid');
		$this->load->model('store/Order_model', 'MOrder');
		$this->load->model('store/Produk_model', 'MProduk');
		$this->load->model('store/Kota_model', 'MKota');
		$this->load->model('store/Ongkir_model', 'MOngkir');
	}

	/**
	 * Show Front interface
	 */
	public function index()
	{
		if ( $this->session->userdata('signed_in') ) {
			$this->profile();
			exit;
		} else {
			$this->registrasi();
			exit;
		}
	}

	/**
	 * Show Registration Form
	 */
	public function registrasi()
	{
		$this->global['pageTitle'] = 'Registrasi Peserta';
		$this->global['contentTitle'] = 'Registrasi Peserta';
		$this->global['name'] = $this->uName;

		$data = array();
		$rs_kota = $this->MKota->get_data(array(), array(), 0);
		$data['records_kota'] = $rs_kota;
		$this->digiLayout($data, $this->view_dir . "/daftar", $this->global);
	}

	/**
	 * Submit Registration Form
	 */
	public function insert_data()
	{
		$reg_nama = $this->input->post('reg_nama', TRUE);
		$reg_email = $this->input->post('reg_email', TRUE);
		$reg_username = $this->input->post('reg_username', TRUE);
		$reg_password = $this->input->post('reg_password', TRUE);
		$password = sha1($reg_password);
		$reg_address = $this->input->post('reg_address', TRUE);
		$reg_kota = $this->input->post('reg_kota', TRUE);
		$reg_phone = $this->input->post('reg_phone', TRUE);
		$current_date = date('Y-m-d H:i:s');

		$dataInfo = array(
			'nama_peserta' => $reg_nama, 'akun_peserta' => $reg_username, 'sandi_peserta' => $password,
			'email_peserta' => $reg_email, 'telepon_peserta' => $reg_phone, 'alamat_peserta' => $reg_address, 'id_kota' => $reg_kota, 'tgl_daftar_peserta' => $current_date, 'status_peserta' => 1
		);
		$count = $this->MPeserta->check_data_exists(array('email_peserta' => $reg_email));
		if ($count > 0) {
			setFlashData('error', 'Alamat Email '. $reg_email .' yang Anda input sudah ada, harap input alamat email yang lain.');
			redirect('peserta/registrasi');
		} else {
			$result = $this->MPeserta->insert_data($dataInfo);

			if ($result > 0) {
				setFlashData('success', $reg_nama. ', Anda telah terdaftar di sistem kami.');
				redirect('peserta/registrasi');
			} else {
				setFlashData('error', $reg_nama. ', Anda gagal terdaftar di sistem kami.');
				redirect('peserta/registrasi');
			}
		}
	}

	/**
	 * Modify Users
	 */
	public function modify_data()
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
	public function profil()
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
	public function status_bid()
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
				$rs_items = $this->MProduk->get_data_info($row['item_id']);
				$row['item_name'] = $rs_items[0]['nama_lelang'];
				$row['item_img'] = $rs_items[0]['gambar_produk'];
				$row['item_status'] = $rs_items[0]['status_lelang'];
				$row['bid_price'] = (int) $rb['jumlah_tawaran'];
				$row['bid_type'] = $rb['tipe_tawaran'];
				$row['bid_time'] = $rb['waktu_tawaran'];
				$row['bid_status'] = $rb['status_tawaran'];

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
	public function checkout($id)
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
	public function list_invoice()
	{
		if ($this->session->userdata('signed_in')) {
			$this->global['pageTitle'] = 'List Invoice';
			$this->global['contentTitle'] = 'List Invoice';
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
				$rs_items = $this->MProduk->get_data_info($row['item_id']);
				$row['item_name'] = $rs_items[0]['nama_lelang'];
				$row['item_img'] = $rs_items[0]['gambar_produk'];
				$row['item_status'] = $rs_items[0]['status_lelang'];
				$row['bid_price'] = (int) $rb['jumlah_tawaran'];
				$row['bid_type'] = $rb['tipe_tawaran'];
				$row['bid_time'] = $rb['waktu_tawaran'];
				$row['bid_status'] = $rb['status_tawaran'];

				array_push($arr_data, $row);
			}

			$data['records_bid'] = $arr_data;
			$this->digiLayout($data, $this->view_dir . "/status_bid", $this->global);
		} else {
			$this->registrasi();
		}
	}

	public function add_order()
	{
		$no_trans = $this->MOrder->get_key_data("TR");
		$tgl_order = date('Y-m-d H:i:s');
		$bid_id = $this->input->post('id', TRUE);

		$dataInfo = array(
			'notrans_order' => $no_trans, 'tgl_order' => $tgl_order, 'id_tawaran' => (int) $bid_id
		);
		$count = $this->MOrder->check_data_exists(array('notrans_order' => $no_trans));
		if ($count > 0) {
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

		$data['no_trans'] = $no_trans;
		$this->digiLayout($data, $this->view_dir . "/order", $this->global);
	}
}
