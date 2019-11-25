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
		if ( $this->accRole === 'auctioner' ) {
			$this->load->model('admin/Produk_model', 'MProduk');
			$this->load->model('admin/Kategori_model', 'MKategori');
		} else {
			redirect('/admin/dashboard');
		}
    }

    /**
     * This function is used to load the menu index
     */
	public function index()
	{
        $rs = array();
		$arrWhere = array();
		$arrOrder = array('p.nama_lelang'=>'ASC');
		$limit = 0;
		$id_pelelang = (int) $this->session->userdata('accBid');

		// $expiree = $this->MProduk->get_expired_bids();
		
		$this->global['pageTitle'] = 'Produk';
		// $this->global['contentHeader'] = 'Produk '.var_dump($expiree);
		$this->global['contentHeader'] = 'Produk';
		$this->global['contentTitle'] = 'Produk';
		$this->global['name'] = $this->accName;
		$this->global['role'] = $this->accRole;

		$arrWhere = array('p.id_pelelang' => $id_pelelang);
		$rs = $this->MProduk->get_data_join_data($arrWhere, $arrOrder, $limit);
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
        $fberat = $this->input->post('fberat', TRUE);
        $fharga1 = $this->input->post('fharga1', TRUE);
        $fharga2 = $this->input->post('fharga2', TRUE);
        $fwaktu1 = $this->input->post('fwaktu1', TRUE);
        $fwaktu2 = $this->input->post('fwaktu2', TRUE);
        $fketerangan = $this->input->post('fketerangan', TRUE);
		$id_pelelang = (int)$this->session->userdata('accBid');
		$fgambar = 'fgambar';

		$config['upload_path']          = './uploads/products/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 2048;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 1024;

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($fgambar))
		{
			setFlashData('error', 'Gagal upload gambar '. $this->upload->display_errors());
			$dataInfo = array('id_kategori'=>$fkategori, 'id_pelelang'=> $id_pelelang, 'nama_lelang'=>$fnama, 'harga_awal'=>$fharga1, 'harga_maksimal'=>$fharga2, 'waktu_mulai'=>$fwaktu1, 'waktu_selesai'=>$fwaktu2, 'keterangan'=>$fketerangan, 
			'berat_produk'=>(int)$fberat);
		}
		else
		{
			setFlashData('success', 'Sukses upload gambar ' . $this->upload->data('file_name'));
			$filename = $this->upload->data('file_name');       // Returns: mypic.jpg
			$dataInfo = array('id_kategori' => $fkategori, 'id_pelelang' => $id_pelelang, 'nama_lelang' => $fnama, 'harga_awal' => $fharga1, 'harga_maksimal' => $fharga2, 'waktu_mulai' => $fwaktu1, 'waktu_selesai' => $fwaktu2, 'keterangan' => $fketerangan, 'gambar_produk'=> $this->upload->data('file_name'), 
			'berat_produk'=>(int)$fberat);
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

		$arrWhere = array();
		$arrOrder = array('nama_kategori' => 'ASC');
		$limit = 0;

		$rs_kategori = $this->MKategori->get_data($arrWhere, $arrOrder, $limit);
		$data['records_kategori'] = $rs_kategori;
        $this->digiAdminLayout($data, $this->view_dir.'edit', $this->global);
    }
    
    /**
     * This function is used to edit the data information
     */
    function update()
    {
        $fid = $this->input->post('fid', TRUE);
		$fnama = $this->input->post('fnama', TRUE);
		$fkategori = $this->input->post('fkategori', TRUE);
		$fberat = $this->input->post('fberat', TRUE);
		$fharga1 = $this->input->post('fharga1', TRUE);
		$fharga2 = $this->input->post('fharga2', TRUE);
		$fwaktu1 = $this->input->post('fwaktu1', TRUE);
		$fwaktu2 = $this->input->post('fwaktu2', TRUE);
		$fketerangan = $this->input->post('fketerangan', TRUE);
		$id_pelelang = (int)$this->session->userdata('accBid');
		$fgambar = 'fgambar';

		$config['upload_path']          = './uploads/products/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 2048;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 1024;

		if ( $_FILES['fgambar']['size'] == 0 ) {
			$dataInfo = array('id_kategori' => $fkategori, 'id_pelelang' => $id_pelelang, 'nama_lelang' => $fnama, 'harga_awal' => $fharga1, 'harga_maksimal' => $fharga2, 'waktu_mulai' => $fwaktu1, 'waktu_selesai' => $fwaktu2, 'keterangan' => $fketerangan, 
			'berat_produk' => (int)$fberat);
		} else {
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($fgambar)) {
				setFlashData('error', 'Gagal upload gambar ' . $this->upload->display_errors());
				$dataInfo = array('id_kategori' => $fkategori, 'id_pelelang' => $id_pelelang, 'nama_lelang' => $fnama, 'harga_awal' => $fharga1,'harga_maksimal' => $fharga2, 'waktu_mulai' => $fwaktu1, 'waktu_selesai' => $fwaktu2, 'keterangan' => $fketerangan,
				'berat_produk' => (int) $fberat);
			} else {
				setFlashData('success', 'Sukses upload gambar ' . $this->upload->data('file_name'));
				$filename = $this->upload->data('file_name');       // Returns: mypic.jpg
				$dataInfo = array('id_kategori' => $fkategori, 'id_pelelang' => $id_pelelang, 'nama_lelang' => $fnama, 'harga_awal' => $fharga1, 'harga_maksimal' => $fharga2, 'waktu_mulai' => $fwaktu1, 'waktu_selesai' => $fwaktu2, 'keterangan' => $fketerangan, 'gambar_produk' => $this->upload->data('file_name'),
				'berat_produk' => (int) $fberat);
			}
		}

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
