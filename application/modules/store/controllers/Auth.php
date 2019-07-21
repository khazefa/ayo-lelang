<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Auth.php.
 * Desc: 
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Auth extends Front_Controller
{
	private $view_dir = 'store/peserta';

	public function __construct()
	{
		parent::__construct();
		//load session library
		$this->load->library('session');
		$this->load->model('store/Auth_model', 'MAuth');
	}

	/**
	 * Show Login interface
	 */
	public function index()
	{
		//check for login status
		if ($this->session->userdata('signed_in')) {
			redirect('peserta/profil');
			exit;
		} else {
			if ($this->session->userdata('login_remember')) {
				redirect('peserta/profil');
				exit;
			}
			redirect('login');
			exit;
		}
	}

	/**
	 * Show Login Form
	 */
	public function login()
	{
		$this->global['pageTitle'] = 'Login Peserta';
		$this->global['contentTitle'] = 'Login Peserta';
		$this->global['name'] = $this->uName;

		$data = array();
		$this->digiLayout($data, $this->view_dir . "/login", $this->global);
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
		$email = filter_var($input['login_email'], FILTER_SANITIZE_EMAIL);
		$password = filter_var($input['login_password'], FILTER_SANITIZE_STRING);
		$remember = isset($input['login_remember']) ? $input['login_remember'] : false;

		if ($this->session->userdata('login_remember')) {
			redirect('/peserta/profil');
			exit;
		} else {
			if ($email && $password) {
				$result = $this->MAuth->auth_email($email, $password);

				if (count($result) > 0) {
					foreach ($result as $res) {
						$sessionArray = array(
							'uBid' => $res->id_peserta,
							'uKey' => $res->akun_peserta,
							'uEmail' => $res->email_peserta,
							'uName' => $res->nama_peserta,
							'signed_in' => TRUE,
							'remember_me' => $remember ? TRUE : FALSE
						);
					}
					$this->session->set_userdata($sessionArray);
					redirect('/peserta/profil');
					exit;
				} else {
					setFlashData('error_login', 'Email atau Password yang Anda input tidak benar.');
					redirect('login');
					exit;
				}
			} else {
				setFlashData('error_login', 'Harap input Email dan Password Anda.');
				redirect('login');
				exit;
			}
		}
	}

	/**
	 * Sign out
	 */
	public function signout()
	{
		$this->session->sess_destroy();
		redirect('/', true);
		exit;
	}
}
