<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Site.php.
 * Desc: Extending Back_Controller. Check /core/Back_Controller
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Site extends Back_Controller
{
	private $view_dir = 'admin/dashboard';

	public function __construct()
	{
		parent::__construct();
		//load session library
		$this->load->library('session');
		// $this->load->model('admin/Auth_model', 'MLog');
	}

	/**
	 * Show Dashboard interface
	 */
	public function index()
	{
		$this->global['pageTitle'] = 'Dashboard';
		$this->global['contentHeader'] = 'Dashboard';
		$this->global['contentTitle'] = 'Dashboard';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$data = array();
		$this->digiAdminLayout($data, $this->view_dir, $this->global);
	}
}
