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

		$this->global['pageTitle'] = 'Lelang ' . $rs_produk[0]["nama_lelang"];
		$this->global['contentTitle'] = 'Lelang ' . $rs_produk[0]["nama_lelang"];
		$this->global['name'] = $this->uName;

		$data['rs_produk'] = $rs_produk;
		$data['rs_kategori'] = $rs_kategori;
		$data['rs_pelelang'] = $rs_pelelang;

		$this->digiLayout($data, $this->view_dir . "/detail", $this->global);
	}
}
