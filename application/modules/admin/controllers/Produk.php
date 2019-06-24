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
     * This function is used to upload file
     */
	function upload_files($field_name)
	{
		$filename = "";
		$config['upload_path']          = './uploads/products/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 2048;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($field_name))
		{
			setFlashData('error', 'Gagal upload gambar '. $this->upload->display_errors());
		}
		else
		{
			setFlashData('success', 'Data telah sukses ditambahkan ' . $this->upload->data('file_name'));
			$filename = $this->upload->data('file_name');       // Returns: mypic.jpg
		}
		return $filename;
	}
    
    /**
     * This function is used to add new data to the system
     */
    function create()
    {
        $fnama = $this->input->post('fnama', TRUE);
        $fkategori = $this->input->post('fkategori', TRUE);
        $falias = $this->input->post('falias', TRUE);
        $fdeskripsi = $this->input->post('fdeskripsi', TRUE);
		$fgambar = 'fgambar';
		$message = "";
		
        $count = $this->MProduk->check_data_exists(array('alias_produk' => $falias));
        if ($count > 0)
        { 
            setFlashData('error', 'Data sudah ada, harap isi dengan data lainnya');
            redirect('admin/produk/add');
        }
        else
        { 
			$config['upload_path']          = './uploads/products/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 2048;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload($fgambar))
			{
				setFlashData('error', 'Gagal upload gambar '. $this->upload->display_errors());
				$dataInfo = array('id_kategori'=>$fkategori, 'alias_produk'=> $falias, 'nama_produk'=>$fnama, 'deskripsi_produk'=>$fdeskripsi);
			}
			else
			{
				setFlashData('success', 'Sukses upload gambar ' . $this->upload->data('file_name'));
				$filename = $this->upload->data('file_name');       // Returns: mypic.jpg
				$dataInfo = array('id_kategori'=>$fkategori, 'alias_produk'=> $falias, 'nama_produk'=>$fnama, 'deskripsi_produk'=>$fdeskripsi, 'gambar_produk'=>$this->upload->data('file_name'));
			}

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
