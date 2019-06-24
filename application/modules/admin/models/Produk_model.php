<?php
/**
 * Class Produk_model.php.
 * Desc: Produk Model
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Produk_model extends CI_Model
{
    protected $tbl_produk = 'produk';
    protected $tbl_kategori = 'kategori_produk';
    protected $primKey = 'id_produk';
    protected $indexKey = 'alias_produk';
    protected $order = array('nama_produk' => 'asc'); // default order

    function __construct()
    {
        parent::__construct();
    }

    // This function used to get count data by this table
    function count_all()
    {
        $this->db->from($this->tbl_produk);
        // $this->db->where('is_deleted', 0);
        return $this->db->count_all_results();
    }

    // This function used to get list data by this table only, not join table
    function get_data($arrWhere = array(), $arrOrder = array(), $limit = 0){
        $rs = array();
        //Flush Param
        $this->db->flush_cache();
        
        $this->db->select('*');
        $this->db->from($this->tbl_produk);

        if(empty($arrWhere)){
            // $rs = array();
            //Limit
			if ($limit > 0){
				$this->db->limit($limit);
			}
        
			//Order By
			if (count($arrOrder) > 0){
				foreach ($arrOrder as $strField => $strValue){
					$this->db->order_by($strField, $strValue);
				}
			}
            $query = $this->db->get();
            $rs = $query->result_array();
        }else{
            foreach ($arrWhere as $strField => $strValue){
                if (is_array($strValue)){
                    $this->db->where_in($strField, $strValue);
                }else{
                    if(strpos(strtolower($strField), '_date1') !== false){
                        $strField = substr($strField, 0, -6);
                        if(!empty($strValue)){
                            $this->db->where("$strField >= '".$strValue."' ");
                        }
                    }elseif(strpos(strtolower($strField), '_date2') !== false){
                        $strField = substr($strField, 0, -6);
                        if(!empty($strValue)){
                            $this->db->where("$strField <= '".$strValue."' ");
                        }
                    }else{
                        $this->db->where($strField, $strValue);
                    }
                }
            }
			
			//Limit
			if ($limit > 0){
				$this->db->limit($limit);
			}
        
			//Order By
			if (count($arrOrder) > 0){
				foreach ($arrOrder as $strField => $strValue){
					$this->db->order_by($strField, $strValue);
				}
			}
			
            $query = $this->db->get();
            $rs = $query->result_array();
        }
        
        return $rs;
    }

    // This function used to get list data by this table only, not join table
    function get_data_join_kategori($arrWhere = array(), $arrOrder = array(), $limit = 0){
        $rs = array();
        //Flush Param
        $this->db->flush_cache();
        
		$this->db->select('p.id_produk, p.alias_produk, p.id_kategori, p.nama_produk, p.deskripsi_produk, 
			p.status_produk, k.nama_kategori, k.deskripsi_kategori');
        $this->db->from($this->tbl_produk.' as p');
        $this->db->join($this->tbl_kategori.' as k','p.id_kategori = k.id_kategori', 'both');

        if(empty($arrWhere)){
            // $rs = array();
            //Limit
			if ($limit > 0){
				$this->db->limit($limit);
			}
        
			//Order By
			if (count($arrOrder) > 0){
				foreach ($arrOrder as $strField => $strValue){
					$this->db->order_by($strField, $strValue);
				}
			}
            $query = $this->db->get();
            $rs = $query->result_array();
        }else{
            foreach ($arrWhere as $strField => $strValue){
                if (is_array($strValue)){
                    $this->db->where_in($strField, $strValue);
                }else{
                    if(strpos(strtolower($strField), '_date1') !== false){
                        $strField = substr($strField, 0, -6);
                        if(!empty($strValue)){
                            $this->db->where("$strField >= '".$strValue."' ");
                        }
                    }elseif(strpos(strtolower($strField), '_date2') !== false){
                        $strField = substr($strField, 0, -6);
                        if(!empty($strValue)){
                            $this->db->where("$strField <= '".$strValue."' ");
                        }
                    }else{
                        $this->db->where($strField, $strValue);
                    }
                }
            }
			
			//Limit
			if ($limit > 0){
				$this->db->limit($limit);
			}
        
			//Order By
			if (count($arrOrder) > 0){
				foreach ($arrOrder as $strField => $strValue){
					$this->db->order_by($strField, $strValue);
				}
			}
			
            $query = $this->db->get();
            $rs = $query->result_array();
        }
        
        return $rs;
    }

    // This function used to get list data by this table only, not join table, with like parameters
    function get_data_like($arrLike = array(), $arrOrder = array()){
        $rs = array();
        //Flush Param
        $this->db->flush_cache();
        
        $this->db->select('*');
        $this->db->from($this->tbl_produk);

        if(empty($arrLike)){
            $rs = array();
        }else{
			foreach ($arrLike as $strField => $strValue){
				$this->db->like($strField, $strValue);
			}
            $query = $this->db->get();
            $rs = $query->result_array();
        }
        
        //Order By
        if (count($arrOrder) > 0){
            foreach ($arrOrder as $strField => $strValue){
                $this->db->order_by($strField, $strValue);
            }
        }
        
        return $rs;
    }

    /**
     * This function used to get data information by id
     * @param number $id : This is id
     * @return array $result : This is data information
     */
    function get_data_info($id)
    {
        $this->db->select('*');
        $this->db->from($this->tbl_produk);
        $this->db->where($this->primKey, $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    /**
     * This function is used to add new data to system
     * @return number $insert_id : This is last inserted id
     */
    function insert_data($dataInfo)
    {
        $this->db->trans_start();
        $this->db->insert($this->tbl_produk, $dataInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to update the data information
     * @param array $dataInfo : This is data updated information
     * @param number $id : This is data id
     */
    function update_data($dataInfo, $id)
    {
        $this->db->where($this->indexKey, $id);
        $this->db->update($this->tbl_produk, $dataInfo);
        
        return TRUE;
    }
    
    /**
     * This function is used to delete the data information
     * @param number $id : This is data id
     * @return boolean $result : TRUE / FALSE
     */
    function delete_data($id)
    {
        $this->db->where($this->indexKey, $id);
        $this->db->delete($this->tbl_produk);
        
        return $this->db->affected_rows();
    }

    /**
     * This function is used to check whether field is already exist or not
     * @param {string} $param : This is param
     * @return {mixed} $result : This is searched result
     */
    function check_data_exists($arrWhere = array())
    {
         //Flush Param
         $this->db->flush_cache();
         $this->db->from($this->tbl_produk);
         //Criteria
         if (count($arrWhere) > 0){
             foreach ($arrWhere as $strField => $strValue){
                 if (is_array($strValue)){
                     $this->db->where_in($strField, $strValue);
                 }else{
                     $this->db->where($strField, $strValue);
                 }
             }
         }
         return $this->db->count_all_results();
    }
}
