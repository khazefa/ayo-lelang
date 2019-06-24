<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Back_Controller.php.
 * Desc: After-Logged-in stuff
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Back_Controller extends MY_Controller
{
	protected $accBid = '';
	protected $accKey = '';
	protected $accEmail = '';
	protected $accName = '';
	protected $accRole = '';

	protected $global = array ();

	public function __construct()
	{
		parent::__construct();
		//check cache validation
		$this->refreshCache();
		//check for Session
		//load session library
		$this->load->library('session');
		if (!$this->session->userdata('logged_in')) {
			redirect('/admin', true);
		}
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
	function isLoggedIn() {
		$isSessionFilled = $this->session->userdata ( 'logged_in' );

		if (! isset ( $isSessionFilled ) || $isSessionFilled != TRUE) {
			redirect ( '/admin' );
		} else {
			$this->accBid = $this->session->userdata ( 'accBid' );
			$this->accKey = $this->session->userdata ( 'accKey' );
			$this->accName = $this->session->userdata ( 'accName' );
			$this->accEmail = $this->session->userdata ( 'accEmail' );
			$this->accRole = $this->session->userdata ( 'accRole' );

			$this->global ['name'] = $this->accName;
			$this->global ['role'] = $this->accRole;
		}
	}

	/**
     * This function is used to check the access
     */
    function isWebAdmin() {
        if ($this->accRole === "admin") {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * This function is used to check the access
     */
    function isWebStaff() {
        if ($this->accRole === "staff") {
            return true;
        } else {
            return false;
        }
    }
}
