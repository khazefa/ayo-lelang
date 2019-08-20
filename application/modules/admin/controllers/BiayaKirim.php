<?php
/**
 * Class BiayaKirim.php.
 * Desc: Class for every BiayaKirim function purposes
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class BiayaKirim extends Back_Controller
{
	private $view_dir = 'admin/biaya-kirim/';

	/**
	 * This is default constructor of the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
		if ($this->accRole === 'admin') {
			$this->load->model('admin/Ongkir_model', 'MOngkir');
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
		$arrOrder = array('id_biaya_kirim' => 'ASC');
		$limit = 0;

		$this->global['pageTitle'] = 'Biaya Kirim';
		$this->global['contentHeader'] = 'Biaya Kirim';
		$this->global['contentTitle'] = 'Biaya Kirim';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MOngkir->get_data_join_kota($arrWhere, $arrOrder, $limit);
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

		$arrWhere = array();
		$arrOrder = array('nama_kota' => 'ASC');
		$limit = 0;

		$rs_kota = $this->MKota->get_data($arrWhere, $arrOrder, $limit);
		$data['records_kota'] = $rs_kota;
		$this->digiAdminLayout($data, $this->view_dir . 'create', $this->global);
	}

	/**
	 * This function is used to add new data to the system
	 */
	function create()
	{
		$fkota = $this->input->post('fkota', TRUE);
		$fharga = $this->input->post('fharga', TRUE);

		$dataInfo = array('id_kota' => $fkota, 'jumlah_biaya_kirim' => $fharga);
		$result = $this->MOngkir->insert_data($dataInfo);

		if ($result > 0) {
			setFlashData('success', 'Data telah sukses ditambahkan');
			redirect('admin/biaya-kirim');
		} else {
			setFlashData('error', 'Data telah gagal ditambahkan');
			redirect('admin/biaya-kirim/add');
		}
	}

	/**
	 * This function is used load edit information
	 * @param $fkey : Optional : This is data unique key
	 */
	function edit($fkey = NULL)
	{
		if ($fkey == NULL) {
			redirect('admin/biaya-kirim');
		}

		$this->global['pageTitle'] = "Edit Data";
		$this->global['contentHeader'] = 'Edit Data';
		$this->global['contentTitle'] = 'Edit Data';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MOngkir->get_data_info($fkey);
		$data['records'] = $rs;

		$arrWhere = array();
		$arrOrder = array('nama_kota' => 'ASC');
		$limit = 0;

		$rs_kota = $this->MKota->get_data($arrWhere, $arrOrder, $limit);
		$data['records_kota'] = $rs_kota;
		$this->digiAdminLayout($data, $this->view_dir . 'edit', $this->global);
	}

	/**
	 * This function is used to edit the data information
	 */
	function update()
	{
		$fid = $this->input->post('fid', TRUE);
		$fkota = $this->input->post('fkota', TRUE);
		$fharga = $this->input->post('fharga', TRUE);

		$dataInfo = array('id_kota' => $fkota, 'jumlah_biaya_kirim' => $fharga);
		$result = $this->MOngkir->update_data($dataInfo, $fid);
		if ($result == true) {
			setFlashData('success', 'Data is successfully updated');
			redirect('admin/biaya-kirim');
		} else {
			setFlashData('error', 'Failed to update data');
			redirect('admin/biaya-kirim/edit' . $fid);
		}
	}

	/**
	 * This function is used to delete the data
	 * @return boolean $result : TRUE / FALSE
	 */
	function delete($fkey = NULL)
	{
		$result = $this->MOngkir->delete_data($fkey);

		if ($result > 0) {
			setFlashData('success', 'Data is successfully deleted');
		} else {
			setFlashData('error', 'Failed to delete data');
		}
		redirect('admin/biaya-kirim');
	}
}
