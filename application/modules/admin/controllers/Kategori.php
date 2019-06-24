<?php
/**
 * Class Kategori.php.
 * Desc: Class for every Kategori function purposes
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Kategori extends Back_Controller
{
    private $view_dir = 'admin/kategori/';

    /**
     * This is default constructor of the class
     */
	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
        $this->load->model('admin/Kategori_model','MKategori');
    }

    /**
     * This function is used to load the menu index
     */
	public function index()
	{
        $rs = array();
		$arrWhere = array();
		$arrOrder = array('nama_kategori'=>'ASC');
		$limit = 0;
		
		$this->global['pageTitle'] = 'Kategori';
		$this->global['contentHeader'] = 'Kategori';
		$this->global['contentTitle'] = 'Kategori';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MKategori->get_data($arrWhere, $arrOrder, $limit);
        $data['records'] = $rs;
		$this->digiAdminLayout($data, $this->view_dir.'index', $this->global);
    }
}
