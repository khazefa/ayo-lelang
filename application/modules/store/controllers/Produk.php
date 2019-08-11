<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Produk.php.
 * Desc: Extending Front_Controller. Check /core/Front_Controller
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Produk extends Front_Controller
{
	private $view_dir = 'store/produk';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		$this->load->model('store/Kategori_model', 'MKategori');
		$this->load->model('store/Produk_model', 'MProduk');
		$this->load->model('store/Pelelang_model', 'MPelelang');
		$this->load->model('store/Kota_model', 'MKota');
		$this->load->model('store/Tawaran_model', 'MTawaran');
		$this->load->model('store/Peserta_model', 'MPeserta');
	}

	/**
	 * Show Front interface
	 */
	public function index()
	{
		redirect('/');
		exit;
	}

	/**
	 * This function is used load detail information
	 * @param $fkey : Optional : This is data unique key
	 */
	public function detail($fkey = NULL)
	{
		if ($fkey == NULL) {
			redirect('/');
		}

		$rs_produk = $this->MProduk->get_data_info($fkey);
		$rs_kategori = $this->MKategori->get_data_info2($rs_produk[0]["id_kategori"]);
		$rs_pelelang = $this->MPelelang->get_data_info2($rs_produk[0]["id_pelelang"]);
		$rs_kota = $this->MKota->get_data_info($rs_pelelang[0]["id_kota"]);
		$rs_bid = $this->MTawaran->get_data(array('id_lelang' => $fkey), array('waktu_tawaran' => 'ASC'), 0, 0);

		$this->global['pageTitle'] = 'Lelang ' . $rs_produk[0]["nama_lelang"];
		$this->global['contentTitle'] = 'Lelang ' . $rs_produk[0]["nama_lelang"];
		$this->global['name'] = $this->uName;

		$arr_produk = array();
		foreach ($rs_produk as $rp) {
			$bid_price = $this->MTawaran->get_current_bid_price($rp['id_lelang']);
			$row['id'] = $rp['id_lelang'];
			$row['nama'] = $rp['nama_lelang'];
			$row['gambar'] = $rp['gambar_produk'];
			$row['keterangan'] = $rp['keterangan'];
			$row['harga_awal'] = $bid_price[0]['bid_price'];
			$row['harga_maksimal'] = $rp['harga_maksimal'];
			$row['waktu_mulai'] = $rp['waktu_mulai'];
			$row['waktu_selesai'] = $rp['waktu_selesai'];
			$row['status'] = $rp['status_lelang'];

			array_push($arr_produk, $row);
		}
		$data['rs_produk'] = $arr_produk;
		$data['rs_kategori'] = $rs_kategori;
		$data['rs_pelelang'] = $rs_pelelang;
		$data['rs_kota'] = $rs_kota;

		$arr_bid = array();
		foreach ($rs_bid as $rp) {
			$rs_peserta = $this->MPeserta->get_data_info2((int) $rp['id_peserta']);
			$row['id'] = $rp['id_tawaran'];
			$row['user_id'] = $rp['id_peserta'];
			$row['user'] = $rs_peserta[0]['nama_peserta'];
			$row['item_id'] = $rp['id_lelang'];
			$row['bid_price'] = 'Rp. '.format_rupiah($rp['jumlah_tawaran']);
			// $row['bid_time'] = indonesian_date($rp['waktu_tawaran']);
			$row['bid_time'] = date('d/m/Y H:i:s', strtotime($rp['waktu_tawaran']));
			$row['bid_type'] = strtoupper($rp['tipe_tawaran']);
			$row['bid_status'] = strtoupper($rp['status_tawaran']);

			array_push($arr_bid, $row);
		}
		$data['rs_bid'] = $arr_bid;

		$this->digiLayout($data, $this->view_dir . "/detail", $this->global);
	}
}
