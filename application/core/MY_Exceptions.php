<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class MY_Exceptions.php.
 * Desc: Extending the default errors to always give JSON errors.
 * Doesnt matter where the call comes from XHR ajax or regular call
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class MY_Exceptions extends CI_Exceptions
{
	protected $CI;
	public function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
	}
	
	/**
	 * 404 Page Not Found Handler
	 *
	 * @param   string  the page
	 * @param   bool    log error yes/no
	 * @return  string
	 */
	public function show_404($page = '', $log_error = true)
	{
		// By default we log this, but allow a dev to skip it
		if ($log_error) {
			log_message('error', '404 Page Not Found --> '.$page);
		}
		$this->_digiLayout([], 'errors/html/error_404');
		echo $this->CI->output->get_output();
		exit;
	}
	//create your own here
}
