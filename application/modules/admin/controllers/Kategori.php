<?php
/**
 * Class CKategori.php.
 * Desc: Class for every Kategori function purposes
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class CKategori extends Back_Controller
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
		$this->global['pageTitle'] = 'Kategori';
		$this->global['contentHeader'] = 'Kategori';
		$this->global['contentTitle'] = 'Kategori';
		$this->global ['name'] = $this->accName;
		$this->global ['role'] = $this->accRole;

        $data['url_list'] = base_url($this->cname.'/list/json');
		$this->digiAdminLayout($data, $this->view_dir.'index', $this->global);
    }
}
