<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Bid.php.
 * Desc: Extending Front_Controller. Check /core/Front_Controller
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Bid extends Front_Controller
{
	private $view_dir = 'store/bid';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		if ($this->session->userdata('signed_in')) {
			$this->load->model('store/Tawaran_model', 'MBid');
			$this->load->model('store/Produk_model', 'MProduk');
			$this->load->model('store/Pelelang_model', 'MPelelang');
		} else {
			setFlashData('error', 'Anda harus login terlebih dahulu.');
			redirect('login');
			exit;
		}
	}

	/**
	 * Show Front interface
	 */
	public function index()
	{
		$this->list_item();
		exit;
	}

	/**
	 * Submit Bid
	 */
	public function insert_data_bin()
	{
		$item_id = $this->input->post('item_id', TRUE);
		$rs_pelelang = $this->MPelelang->get_data_info2((int) $item_id);
		$peserta_id = (int) $this->uBid;
		$peserta_name = $this->uName;
		$rs_items = $this->MProduk->get_data_info($item_id);
		$bid_price = (int) $rs_items[0]['harga_maksimal'];
		$current_date = date('Y-m-d H:i:s');

		$dataInfo = array(
			'id_peserta' => $peserta_id, 'id_lelang' => $item_id, 'id_pelelang' => $rs_pelelang[0]['id_pelelang'], 'jumlah_tawaran' => $bid_price, 'waktu_tawaran' => $current_date,
			'tipe_tawaran' => 'bin'
		);

		$arrWhere = array('id_peserta' => $peserta_id, 'id_lelang' => $item_id);
		$count = $this->MBid->check_data_exists($arrWhere);

		if ($count > 0) {
			setFlashData('error', 'Anda sudah melakukan Bid untuk produk tersebut.');
			echo json_encode(array('status'=>false));
			// redirect('/');
		} else {
			$result = $this->MBid->insert_data($dataInfo);
			if ($result > 0) {
				setFlashData('success', $peserta_name . ', Bid Anda telah terinput di sistem kami.');
				echo json_encode(array('status' => true));
				// redirect('peserta/status-bid');
			} else {
				setFlashData('error', $peserta_name . ', Bid Anda gagal terinput di sistem kami.');
				echo json_encode(array('status' => false));
				// redirect('/');
			}
		}
	}

	/**
	 * Submit Bid
	 */
	public function insert_data_bid()
	{
		$item_id = $this->input->post('mdl_bid_id', TRUE);
		$rs_pelelang = $this->MProduk->get_data_info((int)$item_id);
		$peserta_id = (int) $this->uBid;
		$peserta_name = $this->uName;
		$bid_price = (int) $this->input->post('mdl_bid_price', TRUE);
		$current_date = date('Y-m-d H:i:s');

		$dataInfo = array(
			'id_peserta' => $peserta_id, 'id_lelang' => $item_id, 'id_pelelang' => $rs_pelelang[0]['id_pelelang'], 'jumlah_tawaran' => $bid_price, 'waktu_tawaran' => $current_date, 
			'tipe_tawaran' => 'bid'
		);

		$arrWhere = array('id_peserta' => $peserta_id, 'id_lelang' => $item_id);
		$count = $this->MBid->check_data_exists($arrWhere);

		if ( $count > 0 ) {
			setFlashData('error', 'Anda sudah melakukan Bid untuk produk tersebut.');
			redirect('/');
		} else {
			$result = $this->MBid->insert_data($dataInfo);
			if ($result > 0) {
				setFlashData('success', $peserta_name . ', Bid Anda telah terinput di sistem kami.');
				redirect('peserta/status-bid');
			} else {
				setFlashData('error', $peserta_name . ', Bid Anda gagal terinput di sistem kami.');
				redirect('/');
			}
		}
	}

	/**
	 * This function is used to delete the data
	 * @return boolean $result : TRUE / FALSE
	 */
	function up_data()
	{
		$id = $this->input->post('mdl_up_bid_id', TRUE);
		$bid_price = (int) $this->input->post('mdl_up_bid_price', TRUE);
		$current_date = date('Y-m-d H:i:s');

		$dataInfo = array(
			'jumlah_tawaran' => $bid_price, 'waktu_tawaran' => $current_date
		);

		$result = $this->MBid->update_data($dataInfo, $id);
		if ($result > 0) {
			setFlashData('success', 'Bid Anda telah sukses diupdate');
		} else {
			setFlashData('error', 'Bid Anda telah gagal diupdate');
		}
		redirect('peserta/status-bid');
	}

	/**
	 * This function is used to delete the data
	 * @return boolean $result : TRUE / FALSE
	 */
	function del_data($fid)
	{
		$result = $this->MBid->delete_data($fid);
		if ($result > 0) {
			setFlashData('success', 'Bid Anda telah dibatalkan');
		} else {
			setFlashData('error', 'Gagal membatalkan Bid Anda');
		}
		redirect('peserta/status-bid');
	}
	
}
