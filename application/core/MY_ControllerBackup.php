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
	public function digiLayout($data = [], $view = null)
	{
		if (ENVIRONMENT === 'production') {
			$this->load->view('layouts/frontend/header-min', $data);
			if ($view) {
				$this->load->view($view . '-min');
			}
			$this->load->view('layouts/frontend/footer-min');
		} else {
			$this->load->view('layouts/frontend/header', $data);
			if ($view) {
				$this->load->view($view);
			}
			$this->load->view('layouts/frontend/footer');
		}
	}
	/**
	 * Layouting for Backend
	 */
	public function digiAdminLayout($data = [], $view = null)
	{
		if (ENVIRONMENT === 'production') {
			$this->load->view('layouts/backend/header-min', $data);
			if ($view) {
				$this->load->view($view . '-min');
			}
			$this->load->view('layouts/backend/footer-min');
		} else {
			$this->load->view('layouts/backend/header', $data);
			if ($view) {
				$this->load->view($view);
			}
			$this->load->view('layouts/backend/footer');
		}
	}
	/**
	 * Load a single View
	 */
	public function digiView($data = [], $view = null)
	{
		if ($view) {
			if (ENVIRONMENT === 'production') {
				$this->load->view($view . '-min', $data);
			} else {
				$this->load->view($view, $data);
			}
		}
	}
}
