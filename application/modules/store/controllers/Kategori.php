<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Kategori.php.
 * Desc: Extending Front_Controller. Check /core/Front_Controller
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Kategori extends Front_Controller
{
	private $view_dir = 'store/produk';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		//load libary pagination
		$this->load->library('pagination');
		$this->load->model('store/Kategori_model', 'MKategori');
		$this->load->model('store/Produk_model', 'MProduk');
	}

	/**
	 * Show Front interface
	 */
	public function index($cat = "hp")
	{
		$rs_kategori = array();
		$rs_produk = array();
		$arrWhere = array();

		$rs_kategori = $this->MKategori->get_data_info($cat);

		$this->global['pageTitle'] = empty($cat) ? 'Lelang Barang Online' : 'Lelang ' . $rs_kategori[0]["nama_kategori"];
		$this->global['contentTitle'] = empty($cat) ? 'Lelang Barang Online' : 'Lelang ' . $rs_kategori[0]["nama_kategori"];
		$this->global['name'] = $this->uName;

		if ($cat != "") $arrWhere['id_kategori'] = $rs_kategori[0]["id_kategori"];
		$per_page = 4;
		$total = $this->MProduk->count_all_by($arrWhere); //total row;

		//konfigurasi pagination
		$config = array();
		$config['base_url'] = site_url('kategori/'.$cat); //site url
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);
		// $config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;

		// Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);

		if ($this->uri->segment(3) > 0) {
			$offset = ($this->uri->segment(3) + 0) * $config['per_page'] - $config['per_page'];
		} else {
			$offset = $this->uri->segment(3);
		}

		$rs_produk = $this->MProduk->get_data($arrWhere, array('waktu_selesai' => 'ASC'), $per_page, $offset);
		$data['rs_produk'] = $rs_produk;
		$data['pagination'] = $this->pagination->create_links();

		$this->digiLayout($data, $this->view_dir."/kategori", $this->global);
	}
}
