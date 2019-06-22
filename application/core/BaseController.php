<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Sigit Prayitno
 * @version : 1.0
 * @since : Mei 2017
 */
class BaseController extends CI_Controller {
    protected $global = array ();

    /**
    * This is default constructor of the class
    */
    public function __construct()
    {
        parent::__construct();
		$this->refreshCache();
		//load session library
		$this->load->library('session');
    }
	
    /**
    * Takes mixed data and optionally a status code, then creates the response
    *
    * @access public
    * @param array|NULL $data
    *        	Data to output to the user
    *        	running the script; otherwise, exit
    */
    public function response($data = NULL) {
        $this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
        exit ();
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
}
