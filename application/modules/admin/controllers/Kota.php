<?php
/**
 * Class Kota.php.
 * Desc: Class for every Kota function purposes
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Kota extends Back_Controller
{
	private $view_dir = 'admin/kota/';

	/**
	 * This is default constructor of the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		if ($this->accRole === 'admin') {
			$this->load->model('admin/Kota_model', 'MKota');
		} else {
			redirect('admin');
		}
	}

	/**
	 * This function is used to load the menu index
	 */
	public function index()
	{
		$rs = array();
		$arrWhere = array();
		$arrOrder = array('nama_kota' => 'ASC');
		$limit = 0;

		$this->global['pageTitle'] = 'Kota';
		$this->global['contentHeader'] = 'Kota';
		$this->global['contentTitle'] = 'Kota';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MKota->get_data($arrWhere, $arrOrder, $limit);
		$data['records'] = $rs;
		$this->digiAdminLayout($data, $this->view_dir . 'index', $this->global);
	}

	/**
	 * This function is used to load the add new form
	 */
	function add()
	{
		$this->global['pageTitle'] = "Tambah Data";
		$this->global['contentHeader'] = 'Tambah Data';
		$this->global['contentTitle'] = 'Tambah Data';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$data = array();
		$this->digiAdminLayout($data, $this->view_dir . 'create', $this->global);
	}

	/**
	 * This function is used to add new data to the system
	 */
	function create()
	{
		$fnama = $this->input->post('fnama', TRUE);

		$dataInfo = array('nama_kota' => $fnama);
		$result = $this->MKota->insert_data($dataInfo);

		if ($result > 0) {
			setFlashData('success', 'Data telah sukses ditambahkan');
			redirect('admin/kota');
		} else {
			setFlashData('error', 'Data telah gagal ditambahkan');
			redirect('admin/kota/add');
		}
	}

	/**
	 * This function is used load edit information
	 * @param $fkey : Optional : This is data unique key
	 */
	function edit($fkey = NULL)
	{
		if ($fkey == NULL) {
			redirect('admin/kota');
		}

		$this->global['pageTitle'] = "Edit Data";
		$this->global['contentHeader'] = 'Edit Data';
		$this->global['contentTitle'] = 'Edit Data';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MKota->get_data_info($fkey);
		$data['records'] = $rs;
		$this->digiAdminLayout($data, $this->view_dir . 'edit', $this->global);
	}

	/**
	 * This function is used to edit the data information
	 */
	function update()
	{
		$fid = $this->input->post('fid', TRUE);
		$fnama = $this->input->post('fnama', TRUE);

		$dataInfo = array('nama_kota' => $fnama);
		$result = $this->MKota->update_data($dataInfo, $fid);
		if ($result == true) {
			setFlashData('success', 'Data is successfully updated');
			redirect('admin/kota');
		} else {
			setFlashData('error', 'Failed to update data');
			redirect('admin/kota/edit' . $fid);
		}
	}

	/**
	 * This function is used to delete the data
	 * @return boolean $result : TRUE / FALSE
	 */
	function delete($fkey = NULL)
	{
		$result = $this->MKota->delete_data($fkey);

		if ($result > 0) {
			setFlashData('success', 'Data is successfully deleted');
		} else {
			setFlashData('error', 'Failed to delete data');
		}
		redirect('admin/kota');
	}
}
