<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Peserta.php.
 * Desc: Extending Front_Controller. Check /core/Front_Controller
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Peserta extends Front_Controller
{
	private $view_dir = 'store/peserta';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		$this->load->model('store/Peserta_model', 'MPeserta');
	}

	/**
	 * Show Front interface
	 */
	public function index()
	{
		if ( $this->session->userdata('signed_in') ) {
			$this->profile();
			exit;
		} else {
			$this->registrasi();
			exit;
		}
	}

	/**
	 * Show Registration Form
	 */
	public function registrasi()
	{
		$this->global['pageTitle'] = 'Registrasi Peserta';
		$this->global['contentTitle'] = 'Registrasi Peserta';
		$this->global['name'] = $this->uName;

		$data = array();
		$this->digiLayout($data, $this->view_dir . "/daftar", $this->global);
	}

	/**
	 * Submit Registration Form
	 */
	public function insert_data()
	{
		$reg_nama = $this->input->post('reg_nama', TRUE);
		$reg_email = $this->input->post('reg_email', TRUE);
		$reg_username = $this->input->post('reg_username', TRUE);
		$reg_password = $this->input->post('reg_password', TRUE);
		$password = sha1($reg_password);
		$reg_address = $this->input->post('reg_address', TRUE);
		$reg_phone = $this->input->post('reg_phone', TRUE);
		$current_date = date('Y-m-d H:i:s');

		$dataInfo = array(
			'nama_peserta' => $reg_nama, 'akun_peserta' => $reg_username, 'sandi_peserta' => $password,
			'email_peserta' => $reg_email, 'telepon_peserta' => $reg_phone, 'alamat_peserta' => $reg_address, 'tgl_daftar_peserta' => $current_date, 'status_peserta' => 1
		);
		$count = $this->MPeserta->check_data_exists(array('email_peserta' => $reg_email));
		if ($count > 0) {
			setFlashData('error', 'Alamat Email '. $reg_email .' yang Anda input sudah ada, harap input alamat email yang lain.');
			redirect('peserta/registrasi');
		} else {
			$result = $this->MPeserta->insert_data($dataInfo);

			if ($result > 0) {
				setFlashData('success', $reg_nama. ', Anda telah terdaftar di sistem kami.');
				redirect('peserta/registrasi');
			} else {
				setFlashData('error', $reg_nama. ', Anda gagal terdaftar di sistem kami.');
				redirect('peserta/registrasi');
			}
		}
	}

	/**
	 * Show Profile Page
	 */
	public function profil()
	{
		if ($this->session->userdata('signed_in')) {
			$this->global['pageTitle'] = 'Profil Peserta';
			$this->global['contentTitle'] = 'Profil Peserta';
			$this->global['name'] = $this->uName;

			$username = $this->uKey;
			$rs_peserta = $this->MPeserta->get_data_info($username);

			$data['records_peserta'] = $rs_peserta;
			$this->digiLayout($data, $this->view_dir . "/profil", $this->global);
		} else {
			$this->registrasi();
		}
	}

	/**
	 * Modify Users
	 */
	public function modify_data()
	{
		$reg_nama = $this->input->post('reg_nama', TRUE);
		$reg_email = $this->input->post('reg_email', TRUE);
		$reg_username = $this->input->post('reg_username', TRUE);
		$reg_password = $this->input->post('reg_password', TRUE);
		$reg_address = $this->input->post('reg_address', TRUE);
		$reg_phone = $this->input->post('reg_phone', TRUE);

		if (!empty($reg_password)) {
			$password = sha1($reg_password);
			$dataInfo = array(
				'nama_peserta' => $reg_nama, 'sandi_peserta' => $password,
				'email_peserta' => $reg_email, 'telepon_peserta' => $reg_phone, 'alamat_peserta' => $reg_address
			);
		} else {
			$dataInfo = array(
				'nama_peserta' => $reg_nama,
				'email_peserta' => $reg_email, 'telepon_peserta' => $reg_phone, 'alamat_peserta' => $reg_address
			);
		}

		$result = $this->MPeserta->update_data($dataInfo, $reg_username);

		if ($result > 0) {
			setFlashData('success', 'Informasi Akun Anda telah sukses diubah');
			redirect('peserta/profil');
		} else {
			setFlashData('error', 'Informasi Akun Anda gagal diubah');
			redirect('peserta/profil');
		}
	}
}
