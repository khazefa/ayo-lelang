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
		//load libary pagination
		$this->load->library('pagination');
		$this->load->model('store/Kategori_model', 'MKategori');
		$this->load->model('store/Produk_model', 'MProduk');
	}

	/**
	 * Show Front interface
	 */
	public function index()
	{
		$this->global['pageTitle'] = 'Lelang Barang Online';
		$this->global['contentTitle'] = 'Lelang Barang Online';
		$this->global['name'] = $this->uName;

		$rs_produk = array();
		$arrWhere = array();

		$per_page = 4;
		$total = $this->MProduk->count_all(); //total row;

		//konfigurasi pagination
		$config = array();
		$config['base_url'] = site_url(); //site url
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;  //show record per halaman
		$config["uri_segment"] = 1;  // uri parameter
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

		if ($this->uri->segment(1) > 0) {
			$offset = ($this->uri->segment(1) + 0) * $config['per_page'] - $config['per_page'];
		}
		else {
			$offset = $this->uri->segment(1);
		}

		$rs_produk = $this->MProduk->get_data($arrWhere, array('waktu_selesai' => 'ASC'), $per_page, $offset);
		$data['rs_produk'] = $rs_produk;
		$data['pagination'] = $this->pagination->create_links();

		$this->digiLayout($data, $this->view_dir, $this->global);
	}

	public function list_json( $row_num = 0 )
	{
		$rs_produk = array();
		$arrWhere = array();
		$limit = 4;

		if ($row_num != 0) {
			$row_num = ($row_num - 1) * $limit;
		} else {
			$row_num = $limit;
		}

		//panggil function get_mahasiswa_list yang ada pada model mahasiswa_model. 
		$rs_produk = $this->MProduk->get_data($arrWhere, array('waktu_selesai' => 'ASC'), $limit, $row_num);

		//konfigurasi pagination
		$config['base_url'] = base_url() . 'home/list_json';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->MProduk->count_all(); //total row
		$config['per_page'] = $limit;  //show record per halaman
		// $config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

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
		// $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $rs_produk;
		$data['row'] = $row_num;

		$output = $this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));

		return $output;
	}

	/**
	 * Show Front Cara Lelang
	 */
	public function tata_cara_lelang()
	{
		$this->global['pageTitle'] = 'Tata Cara Lelang - ' . SITE_NAME;
		$this->global['contentTitle'] = 'Tata Cara Lelang - ' . SITE_NAME;
		$this->global['name'] = $this->uName;

		$data = array();
		$this->digiLayout($data, 'store/pages/cara-lelang', $this->global);
	}
}
