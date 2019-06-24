<?php
/**
 * Class Produk.php.
 * Desc: Class for every Produk function purposes
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Produk extends Back_Controller
{
    private $view_dir = 'admin/produk/';

    /**
     * This is default constructor of the class
     */
	public function __construct()
	{
		parent::__construct();
		$this->isLoggedIn();
        $this->load->model('admin/Produk_model','MProduk');
        $this->load->model('admin/Kategori_model','MKategori');
    }

    /**
     * This function is used to load the menu index
     */
	public function index()
	{
        $rs = array();
		$arrWhere = array();
		$arrOrder = array('nama_produk'=>'ASC');
		$limit = 0;
		
		$this->global['pageTitle'] = 'Produk';
		$this->global['contentHeader'] = 'Produk';
		$this->global['contentTitle'] = 'Produk';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$rs = $this->MProduk->get_data_join_kategori($arrWhere, $arrOrder, $limit);
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

		$arrWhere = array();
		$arrOrder = array('nama_kategori'=>'ASC');
		$limit = 0;
		
		$rs_kategori = $this->MKategori->get_data($arrWhere, $arrOrder, $limit);
        $data['records_kategori'] = $rs_kategori;
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
        $count = $this->MProduk->check_data_exists(array('alias_kategori' => $falias));
        if ($count > 0)
        { 
            setFlashData('error', 'Data sudah ada, harap isi dengan data lainnya');
            redirect('admin/produk/add');
        }
        else
        { 
            $result = $this->MProduk->insert_data($dataInfo);
        
            if($result > 0)
            {
                setFlashData('success', 'Data telah sukses ditambahkan');
                redirect('admin/produk');
            }
            else
            {
                setFlashData('error', 'Data telah gagal ditambahkan');
                redirect('admin/produk/add');
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
			redirect('admin/produk');
        }

        $this->global['pageTitle'] = "Edit Data";
        $this->global['contentHeader'] = 'Edit Data';
        $this->global['contentTitle'] = 'Edit Data';
        $this->global['name'] = $this->accName;
        $this->global['role'] = $this->accRole;

		$rs = $this->MProduk->get_data_info($fkey);
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
        $result = $this->MProduk->update_data($dataInfo, $fid);
        if($result == true)
        {
            setFlashData('success', 'Data is successfully updated');
			redirect('admin/produk');
        }
        else
        {
			setFlashData('error', 'Failed to update data');
			redirect('admin/produk/edit'.$fid);
        }
    }
    
    /**
     * This function is used to delete the data
     * @return boolean $result : TRUE / FALSE
     */
    function delete($fkey = NULL)
    {
        $result = $this->MProduk->delete_data($fkey);

        if($result > 0)
        {
            setFlashData('success', 'Data is successfully deleted');
        }
        else
        {
            setFlashData('error', 'Failed to delete data');
        }
        redirect('admin/produk');
    }
}
