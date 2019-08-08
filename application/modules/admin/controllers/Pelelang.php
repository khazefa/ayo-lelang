<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelelang extends Back_Controller
{
	private $view_dir = 'admin/pelelang/';

	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		$this->load->model('Pelelang_model', 'MPelelang');
		$this->load->model('Kota_model', 'MKota');
	}

	public function index()
	{
		$rs = array();
		$arrWhere = array();
		$arrOrder = array('email_pelelang' => 'ASC');
		$limit = 0;

		$this->global['pageTitle'] = 'Pelelang';
		$this->global['contentHeader'] = 'Pelelang';
		$this->global['contentTitle'] = 'Pelelang';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MPelelang->get_data($arrWhere, $arrOrder, $limit);
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
		$rs_kota = $this->MKota->get_data(array(), array(), 0);
		$data['records_kota'] = $rs_kota;
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
		$fkota = $this->input->post('fkota', TRUE);
		$tgl_daftar = date('Y-m-d');

		$dataInfo = array('akun_pelelang' => $fusername, 'sandi_pelelang' => $password, 'nama_pelelang' => $fnama, 'email_pelelang' => $femail, 'telepon_pelelang' => $ftelepon, 'alamat_pelelang' => $falamat, 'id_kota' => $fkota, 'tgl_daftar_pelelang' => $tgl_daftar);
		$result = $this->MPelelang->insert_data($dataInfo);

		if ($result > 0) {
			setFlashData('success', 'Data telah sukses ditambahkan');
			redirect('admin/pelelang');
		} else {
			setFlashData('error', 'Data telah gagal ditambahkan');
			redirect('admin/pelelang/add');
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

		$rs = $this->MPelelang->get_data_info($fkey);
		$rs_kota = $this->MKota->get_data(array(), array(), 0);
		$data['records'] = $rs;
		$data['records_kota'] = $rs_kota;
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

		$rs = $this->MPelelang->get_data_info($fkey);
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
			$dataInfo = array('sandi_pelelang' => $password, 'nama_pelelang' => $fnama, 'email_pelelang' => $femail, 'telepon_pelelang' => $ftelepon, 'alamat_pelelang' => $falamat);
		} else {
			$dataInfo = array('nama_pelelang' => $fnama, 'email_pelelang' => $femail, 'telepon_pelelang' => $ftelepon, 'alamat_pelelang' => $falamat);
		}

		$result = $this->MPelelang->update_data($dataInfo, $fusername);
		if ($result == true) {
			setFlashData('success', 'Data is successfully updated');
			redirect('admin/pelelang/profil/' . $fusername);
		} else {
			setFlashData('error', 'Failed to update data');
			redirect('admin/pelelang/profil' . $fusername);
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
		$fkota = $this->input->post('fkota', TRUE);

		if (!empty($fpassword)) {
			$password = sha1($fpassword);
			$dataInfo = array('sandi_pelelang' => $password, 'nama_pelelang' => $fnama, 'email_pelelang' => $femail, 'telepon_pelelang' => $ftelepon, 'alamat_pelelang' => $falamat, 'id_kota' => $fkota);
		} else {
			$dataInfo = array('nama_pelelang' => $fnama, 'email_pelelang' => $femail, 'telepon_pelelang' => $ftelepon, 'alamat_pelelang' => $falamat, 'id_kota' => $fkota);
		}

		$result = $this->MPelelang->update_data($dataInfo, $fusername);
		if ($result == true) {
			setFlashData('success', 'Data is successfully updated');
			redirect('admin/pelelang');
		} else {
			setFlashData('error', 'Failed to update data');
			redirect('admin/pelelang');
		}
	}

	/**
	 * This function is used to delete the data
	 * @return boolean $result : TRUE / FALSE
	 */
	function delete($id = NULL)
	{
		$result = $this->MPelelang->delete_data($id);

		if ($result > 0) {
			setFlashData('success', 'Data is successfully deleted');
		} else {
			setFlashData('error', 'Failed to delete data');
		}
		redirect('admin/pelelang');
	}

	public function banned($id = NULL)
	{
		$dataInfo = array('status_pelelang' => 0);

		$result = $this->MPelelang->update_data($dataInfo, $id);
		if ($result == true) {
			setFlashData('success', 'Account is successfully blocked');
		} else {
			setFlashData('error', 'Account is failed to blocked');
		}
		redirect('admin/pelelang');
	}
}
