<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Front_Controller.php.
 * Desc: Pre-Logged-in stuff
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Front_Controller extends MY_Controller
{
	protected $uBid = '';
	protected $uKey = '';
	protected $uEmail = '';
	protected $uName = '';

	protected $global = array();

	public function __construct()
	{
		parent::__construct();
		//check cache validation
		$this->refreshCache();
		//check for Session
		//load session library
		$this->load->library('session');
	}
	/**
	 * On browser back button hit
	 */
	private function refreshCache()
	{
		// any valid date in the past
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		// always modified right now
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		// HTTP/1.1
		header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
		// HTTP/1.0
		header("Pragma: no-cache");
	}

	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn()
	{
		$isSessionFilled = $this->session->userdata('signed_in');

		if (!isset($isSessionFilled) || $isSessionFilled != TRUE) {
			//
		} else {
			$this->uBid = $this->session->userdata('uBid');
			$this->uKey = $this->session->userdata('uKey');
			$this->uName = $this->session->userdata('uName');
			$this->uEmail = $this->session->userdata('uEmail');

			$this->global['name'] = $this->uName;
			$this->global['categories'] = array();
		}
	}
}
