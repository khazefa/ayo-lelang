<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Auth.php.
 * Desc: 
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Auth_model', 'MAuth');
	}

	/**
	 * Show Login interface
	 */
	public function index()
	{
		//check for login status
		if ($this->session->userdata('logged_in')) {
			redirect('/admin/dashboard');
			exit;
		}

		$data['pageTitle'] = 'Login';

		$this->digiView($data, 'layouts/admin/signin');
	}

	/**
	 * verify Login
	 *
	 * @param str email
	 * @param str password
	 */
	public function check()
	{
		$sessionArray = array();
		$input = $this->input->post(null, true);
		$email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
		$password = filter_var($input['password'], FILTER_SANITIZE_STRING);

		if ($email && $password) {
			$result = $this->MAuth->auth_default($email, $password);

			if (count($result) > 0) {
				foreach ($result as $res) {
					$sessionArray = array(
						'accBid' => $res->id_akun,
						'accKey' => $res->nama_akun,
						'accEmail' => $res->email_akun,
						'accName' => $res->nama_lengkap_akun,
						'accRole' => $res->level_akun,
						'logged_in' => TRUE
					);
				}
				$this->session->set_userdata($sessionArray);
				redirect('/admin/dashboard');
			} else {
				setFlashData('error_login', 'Email atau Kata Sandi yang Anda input tidak benar.');
				redirect('/admin');
			}
		} else {
			setFlashData('error_login', 'Harap input Email dan Kata Sandi Anda.');
			redirect('/admin');
		}
	}

	/**
	 * Sign out
	 */
	public function signout()
	{
		$this->session->sess_destroy();
		redirect('/admin', true);
	}
}
