<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class MY_Controller.php.
 * Desc: Extending The Controller
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";
class MY_Controller extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Layouting for frontend
	 */
	public function digiLayout($data = [], $view = null, $headerInfo = NULL, $footerInfo = NULL)
	{
		$this->load->view('layouts/frontend/header', $headerInfo);
		if ($view) {
			$this->load->view($view, $data);
		}
		$this->load->view('layouts/frontend/footer', $footerInfo);
	}
	/**
	 * Layouting for Backend
	 */
	public function digiAdminLayout($data = [], $view = null, $headerInfo = NULL, $footerInfo = NULL)
	{
		$this->load->view('layouts/backend/header', $headerInfo);
		if ($view) {
			$this->load->view($view, $data);
		}
		$this->load->view('layouts/backend/footer', $footerInfo);
	}
	/**
	 * Load a single View
	 */
	public function digiView($data = [], $view = null)
	{
		if ($view) {
			$this->load->view($view, $data);
		}
	}
}
