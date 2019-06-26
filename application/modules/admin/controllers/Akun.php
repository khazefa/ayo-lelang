<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends Back_Controller
{
	private $view_dir = 'admin/akun/';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		$this->load->model('Akun_model', 'MAkun');
	}

	public function index()
	{
		$rs = array();
		$arrWhere = array();
		$arrOrder = array('email_akun' => 'ASC');
		$limit = 0;

		$this->global['pageTitle'] = 'Akun';
		$this->global['contentHeader'] = 'Akun';
		$this->global['contentTitle'] = 'Akun';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MAkun->get_data($arrWhere, $arrOrder, $limit);
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

	public function insert()
	{
		$fusername = $this->input->post('fusername', TRUE);
		$fpassword = $this->input->post('fpassword', TRUE);
		$password = sha1($fpassword);
		$fnama = $this->input->post('fnama', TRUE);
		$femail = $this->input->post('femail', TRUE);

		$dataInfo = array('nama_akun' => $fusername, 'sandi_akun' => $password, 'nama_lengkap_akun' => $fnama, 'email_akun' => $femail);
		$result = $this->MAkun->insert_data($dataInfo);

		if ($result > 0) {
			setFlashData('success', 'Data telah sukses ditambahkan');
			redirect('admin/akun');
		} else {
			setFlashData('error', 'Data telah gagal ditambahkan');
			redirect('admin/akun/add');
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

		$rs = $this->MAkun->get_data_info($fkey);
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

		$rs = $this->MAkun->get_data_info($fkey);
		$data['records'] = $rs;
		$this->digiAdminLayout($data, $this->view_dir . 'profil', $this->global);
	}

	public function update_profil()
	{
		$fusername = $this->input->post('fusername', TRUE);
		$fpassword = $this->input->post('fpassword', TRUE);
		$fnama = $this->input->post('fnama', TRUE);
		$femail = $this->input->post('femail', TRUE);

		if (!empty($fpassword)) {
			$password = sha1($fpassword);
			$dataInfo = array('sandi_akun' => $password, 'nama_lengkap_akun' => $fnama, 'email_akun' => $femail);
		} else {
			$dataInfo = array('nama_lengkap_akun' => $fnama, 'email_akun' => $femail);
		}

		$result = $this->MAkun->update_data($dataInfo, $fusername);
		if ($result == true) {
			setFlashData('success', 'Data is successfully updated');
			redirect('admin/akun/profil/' . $fusername);
		} else {
			setFlashData('error', 'Failed to update data');
			redirect('admin/akun/profil' . $fusername);
		}
	}

	public function update()
	{
		$fusername = $this->input->post('fusername', TRUE);
		$fpassword = $this->input->post('fpassword', TRUE);
		$fnama = $this->input->post('fnama', TRUE);
		$femail = $this->input->post('femail', TRUE);

		if ( !empty($fpassword) ) {
			$password = sha1($fpassword);
			$dataInfo = array('sandi_akun' => $password, 'nama_lengkap_akun' => $fnama, 'email_akun' => $femail);
		} else {
			$dataInfo = array('nama_lengkap_akun' => $fnama, 'email_akun' => $femail);
		}

		$result = $this->MAkun->update_data($dataInfo, $fusername);
		if ($result == true) {
			setFlashData('success', 'Data is successfully updated');
			redirect('admin/akun');
		} else {
			setFlashData('error', 'Failed to update data');
			redirect('admin/akun');
		}
	}

	/**
	 * This function is used to delete the data
	 * @return boolean $result : TRUE / FALSE
	 */
	function delete($id = NULL)
	{
		$result = $this->MAkun->delete_data($id);

		if ($result > 0) {
			setFlashData('success', 'Data is successfully deleted');
		} else {
			setFlashData('error', 'Failed to delete data');
		}
		redirect('akun');
	}
}
