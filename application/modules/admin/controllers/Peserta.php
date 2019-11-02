<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends Back_Controller
{
	private $view_dir = 'admin/peserta/';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		if ($this->accRole === 'auctioner') {
			redirect('/admin/dashboard');
		} else {
			$this->load->model('Peserta_model', 'MPeserta');
		}
	}

	public function index()
	{
		$rs = array();
		$arrWhere = array();
		$arrOrder = array('email_peserta' => 'ASC');
		$limit = 0;

		$this->global['pageTitle'] = 'Peserta';
		$this->global['contentHeader'] = 'Peserta';
		$this->global['contentTitle'] = 'Peserta';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MPeserta->get_data($arrWhere, $arrOrder, $limit);
		$data['records'] = $rs;
		$this->digiAdminLayout($data, $this->view_dir . 'index', $this->global);
	}

	public function add()
	{
		$this->global['pageTitle'] = "Tambah Data";
		$this->global['contentHeader'] = 'Tambah Data';
		$this->global['contentTitle'] = 'Tambah Data';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$data = array();
		$this->digiAdminLayout($data, $this->view_dir . 'create', $this->global);
	}

	public function create()
	{
		$fusername = $this->input->post('fusername', TRUE);
		$fpassword = $this->input->post('fpassword', TRUE);
		$password = sha1($fpassword);
		$fnama = $this->input->post('fnama', TRUE);
		$femail = $this->input->post('femail', TRUE);
		$ftelepon = $this->input->post('ftelepon', TRUE);
		$falamat = $this->input->post('falamat', TRUE);
		$tgl_daftar = date('Y-m-d');

		$dataInfo = array('akun_peserta' => $fusername, 'sandi_peserta' => $password, 'nama_peserta' => $fnama, 'email_peserta' => $femail, 'telepon_peserta' => $ftelepon, 'alamat_peserta' => $falamat, 'tgl_daftar_peserta' => $tgl_daftar);
		$result = $this->MPeserta->insert_data($dataInfo);

		if ($result > 0) {
			setFlashData('success', 'Data telah sukses ditambahkan');
			redirect('admin/peserta');
		} else {
			setFlashData('error', 'Data telah gagal ditambahkan');
			redirect('admin/peserta/add');
		}
	}

	public function edit($fkey = NULL)
	{
		if ($fkey == NULL) {
			redirect('admin');
		}

		$this->global['pageTitle'] = "Edit Data";
		$this->global['contentHeader'] = 'Edit Data';
		$this->global['contentTitle'] = 'Edit Data';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MPeserta->get_data_info($fkey);
		$data['records'] = $rs;
		$this->digiAdminLayout($data, $this->view_dir . 'edit', $this->global);
	}

	public function profil($fkey = NULL)
	{
		if ($fkey == NULL) {
			redirect('admin');
		}

		$this->global['pageTitle'] = "Edit Profil";
		$this->global['contentHeader'] = 'Edit Profil';
		$this->global['contentTitle'] = 'Edit Profil';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MPeserta->get_data_info($fkey);
		$data['records'] = $rs;
		$this->digiAdminLayout($data, $this->view_dir . 'profil', $this->global);
	}

	public function update_profil()
	{
		$fusername = $this->input->post('fusername', TRUE);
		$fpassword = $this->input->post('fpassword', TRUE);
		$fnama = $this->input->post('fnama', TRUE);
		$femail = $this->input->post('femail', TRUE);
		$ftelepon = $this->input->post('ftelepon', TRUE);
		$falamat = $this->input->post('falamat', TRUE);

		if (!empty($fpassword)) {
			$password = sha1($fpassword);
			$dataInfo = array('sandi_peserta' => $password, 'nama_peserta' => $fnama, 'email_peserta' => $femail, 'telepon_peserta' => $ftelepon, 'alamat_peserta' => $falamat);
		} else {
			$dataInfo = array('nama_peserta' => $fnama, 'email_peserta' => $femail, 'telepon_peserta' => $ftelepon, 'alamat_peserta' => $falamat);
		}

		$result = $this->MPeserta->update_data($dataInfo, $fusername);
		if ($result == true) {
			setFlashData('success', 'Data is successfully updated');
			redirect('admin/peserta/profil/' . $fusername);
		} else {
			setFlashData('error', 'Failed to update data');
			redirect('admin/peserta/profil' . $fusername);
		}
	}

	public function update()
	{
		$fusername = $this->input->post('fusername', TRUE);
		$fpassword = $this->input->post('fpassword', TRUE);
		$fnama = $this->input->post('fnama', TRUE);
		$femail = $this->input->post('femail', TRUE);
		$ftelepon = $this->input->post('ftelepon', TRUE);
		$falamat = $this->input->post('falamat', TRUE);
		$fstatus = $this->input->post('fstatus', TRUE);

		if (!empty($fpassword)) {
			$password = sha1($fpassword);
			$dataInfo = array('sandi_peserta' => $password, 'nama_peserta' => $fnama, 'email_peserta' => $femail, 'telepon_peserta' => $ftelepon, 'alamat_peserta' => $falamat, 'status_peserta' => (int)$fstatus);
		} else {
			$dataInfo = array('nama_peserta' => $fnama, 'email_peserta' => $femail, 'telepon_peserta' => $ftelepon, 'alamat_peserta' => $falamat, 'status_peserta' => (int) $fstatus);
		}

		$result = $this->MPeserta->update_data($dataInfo, $fusername);
		if ($result == true) {
			setFlashData('success', 'Data is successfully updated');
			redirect('admin/peserta');
		} else {
			setFlashData('error', 'Failed to update data');
			redirect('admin/peserta');
		}
	}

	/**
	 * This function is used to delete the data
	 * @return boolean $result : TRUE / FALSE
	 */
	function delete($id = NULL)
	{
		$result = $this->MPeserta->delete_data($id);

		if ($result > 0) {
			setFlashData('success', 'Data is successfully deleted');
		} else {
			setFlashData('error', 'Failed to delete data');
		}
		redirect('admin/peserta');
	}

	public function banned($id = NULL)
	{
		$dataInfo = array('status_peserta' => 0);

		$result = $this->MPeserta->update_data($dataInfo, $id);
		if ($result == true) {
			setFlashData('success', 'Account is successfully blocked');
		} else {
			setFlashData('error', 'Account is failed to blocked');
		}
		redirect('admin/peserta');
	}
}
