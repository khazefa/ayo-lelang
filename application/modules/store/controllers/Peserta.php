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
	}

	/**
	 * Show Front interface
	 */
	public function index()
	{
		if ( $this->session->userdata('signed_in') ) {
			$this->profile();
		} else {
			$this->registrasi();
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
		$this->digiLayout($data, $this->view_dir . "/daftar", $this->global);
	}

	/**
	 * Show Profile Page
	 */
	public function profile()
	{
		if ($this->session->userdata('signed_in')) {
			$this->global['pageTitle'] = 'Profil Peserta';
			$this->global['contentTitle'] = 'Profil Peserta';
			$this->global['name'] = $this->uName;

			$data = array();
			$this->digiLayout($data, $this->view_dir . "/daftar", $this->global);
		} else {
			$this->registrasi();
		}
	}
}
