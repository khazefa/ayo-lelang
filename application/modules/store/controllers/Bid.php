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
		} else {
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
	public function insert_data()
	{
		$item_id = $this->input->post('mdl_bid_id', TRUE);
		$peserta_id = (int) $this->uBid;
		$peserta_name = $this->uName;
		$bid_price = (int) $this->input->post('mdl_bid_price', TRUE);
		$current_date = date('Y-m-d H:i:s');

		$dataInfo = array(
			'id_peserta' => $peserta_id, 'id_lelang' => $item_id, 'jumlah_tawaran' => $bid_price, 'waktu_tawaran' => $current_date
		);

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
