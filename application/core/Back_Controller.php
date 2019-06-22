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
	protected $accType = '';
	protected $accGroup = '';
	protected $accRole = '';

	protected $global = array ();

	public function __construct()
	{
		parent::__construct();
		//load session library
		$this->load->library('session');
		//check cache validation
		$this->refreshCache();
		//check for Session
		if (!$this->session->userdata('logged_in')) {
			redirect('/backside', true);
		}
	}
	/**
	 * On browser back button hit
	 */
	private function refreshCache()
	{
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
	}

	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn() {
		$isSessionFilled = $this->session->userdata ( 'logged_in' );

		if (! isset ( $isSessionFilled ) || $isSessionFilled != TRUE) {
			redirect ( '/backside' );
		} else {
			$this->accBid = $this->session->userdata ( 'accBid' );
			$this->accKey = $this->session->userdata ( 'accKey' );
			$this->accName = $this->session->userdata ( 'accName' );
			$this->accEmail = $this->session->userdata ( 'accEmail' );
			// $this->accGroup = $this->session->userdata ( 'accGroup' );
			// $this->accRole = $this->session->userdata ( 'accRole' );
			// $this->accType = $this->session->userdata ( 'accType' );

			$this->global ['name'] = $this->accName;
			// $this->global ['type'] = $this->accType;
			// $this->global ['group'] = $this->accGroup;
			// $this->global ['role'] = $this->accRole;
		}
	}

	/**
     * This function is used to check the access
     */
    function isCMSAdmin() {
        if ($this->accType === "CMS") {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * This function is used to check the access
     */
    function isWebAdmin() {
        if ($this->accType === "Website") {
            return true;
        } else {
            return false;
        }
    }
}
