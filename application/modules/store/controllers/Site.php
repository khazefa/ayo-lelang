<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Site.php.
 * Desc: Extending Front_Controller. Check /core/Front_Controller
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Site extends Front_Controller
{
	private $view_dir = 'store/home';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		$this->load->model('store/Kategori_model', 'MKategori');
	}

	/**
	 * Show Front interface
	 */
	public function index()
	{
		$this->global['pageTitle'] = 'Lelang Barang Online';
		$this->global['contentTitle'] = 'Lelang Barang Online';
		$this->global['name'] = $this->uName;

		$rs = array();
		$arrWhere = array();
		$arrOrder = array('nama_kategori' => 'ASC');
		$limit = 0;

		$rs = $this->MKategori->get_data($arrWhere, $arrOrder, $limit);
		$data['records_kategori'] = $rs;
		$this->global['categories'] = $rs;
		$this->digiLayout($data, $this->view_dir, $this->global);
	}
	/**
	 * Show Front Cara Lelang
	 */
	public function cara_lelang()
	{
		$this->global['pageTitle'] = 'Tata Cara Lelang - ' . SITE_NAME;
		$this->global['contentTitle'] = 'Tata Cara Lelang - ' . SITE_NAME;
		$this->global['name'] = $this->uName;

		$data = array();
		$this->digiLayout($data, 'store/pages/cara-lelang', $this->global);
	}
}
