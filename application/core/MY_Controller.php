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
	 * Layouting for Frontside
	 */
	public function _renderFrontView($data = [], $view = null, $headerInfo = NULL, $footerInfo = NULL)
	{
		$this->load->view('layouts/frontside/header', $headerInfo);
		if ($view) {
			$this->load->view($view, $data);
		}
		$this->load->view('layouts/frontside/footer', $footerInfo);
	}
	/**
	 * Layouting for Backside
	 */
	public function _renderBackView($data = [], $view = null, $headerInfo = NULL, $footerInfo = NULL)
	{
		$this->load->view('layouts/backside/header', $headerInfo);
		if ($view) {
			$this->load->view($view, $data);
		}
		$this->load->view('layouts/backside/footer', $footerInfo);
	}
	/**
	 * Load a single View
	 */
	public function _renderView($data = [], $base = null, $view = null)
	{
		if ($view) {
			if ($base) {
				$this->load->view($base.'/'.$view, $data);
			} else {
				$this->load->view($view, $data);
			}
		}
	}
}
