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
		
		$this->global['pageTitle'] = 'Kategori Produk Lelang';
		$this->global['contentHeader'] = 'Kategori Produk Lelang';
		$this->global['contentTitle'] = 'Kategori Produk Lelang';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MKategori->get_data($arrWhere, $arrOrder, $limit);
        $data['records'] = $rs;
		$this->digiAdminLayout($data, $this->view_dir.'index', $this->global);
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
        $this->digiAdminLayout($data, $this->view_dir.'create', $this->global);
    }
    
    /**
     * This function is used to add new data to the system
     */
    function create()
    {
        $fnama = $this->input->post('fnama', TRUE);
        $falias = $this->input->post('falias', TRUE);
        $fdeskripsi = $this->input->post('fdeskripsi', TRUE);

        $dataInfo = array('alias_kategori'=> $falias, 'nama_kategori'=>$fnama, 'deskripsi_kategori'=>$fdeskripsi);
        $count = $this->MKategori->check_data_exists(array('alias_kategori' => $falias));
        if ($count > 0)
        { 
            setFlashData('error', 'Data sudah ada, harap isi dengan data lainnya');
            redirect('admin/kategori/add');
        }
        else
        { 
            $result = $this->MKategori->insert_data($dataInfo);
        
            if($result > 0)
            {
                setFlashData('success', 'Data telah sukses ditambahkan');
                redirect('admin/kategori');
            }
            else
            {
                setFlashData('error', 'Data telah gagal ditambahkan');
                redirect('admin/kategori/add');
            }
        }
    }

    /**
     * This function is used load edit information
     * @param $fkey : Optional : This is data unique key
     */
    function edit($fkey = NULL)
    {
        if($fkey == NULL)
        {
			redirect('admin/kategori');
        }

        $this->global['pageTitle'] = "Edit Data";
        $this->global['contentHeader'] = 'Edit Data';
        $this->global['contentTitle'] = 'Edit Data';
        $this->global['name'] = $this->accName;
        $this->global['role'] = $this->accRole;

		$rs = $this->MKategori->get_data_info($fkey);
        $data['records'] = $rs;
        $this->digiAdminLayout($data, $this->view_dir.'edit', $this->global);
    }
    
    /**
     * This function is used to edit the data information
     */
    function update()
    {
        $fid = $this->input->post('fid', TRUE);
        $fnama = $this->input->post('fnama', TRUE);
        $falias = $this->input->post('falias', TRUE);
        $fdeskripsi = $this->input->post('fdeskripsi', TRUE);

        $dataInfo = array('alias_kategori'=> $falias, 'nama_kategori'=>$fnama, 'deskripsi_kategori'=>$fdeskripsi);
        $result = $this->MKategori->update_data($dataInfo, $fid);
        if($result == true)
        {
            setFlashData('success', 'Data is successfully updated');
			redirect('admin/kategori');
        }
        else
        {
			setFlashData('error', 'Failed to update data');
			redirect('admin/kategori/edit'.$fid);
        }
    }
    
    /**
     * This function is used to delete the data
     * @return boolean $result : TRUE / FALSE
     */
    function delete($fkey = NULL)
    {
        $result = $this->MKategori->delete_data($fkey);

        if($result > 0)
        {
            setFlashData('success', 'Data is successfully deleted');
        }
        else
        {
            setFlashData('error', 'Failed to delete data');
        }
        redirect('admin/kategori');
    }
}
