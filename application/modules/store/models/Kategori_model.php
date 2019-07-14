<?php
/**
 * Class Kategori_model.php.
 * Desc: Kategori Model
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Kategori_model extends CI_Model
{
    protected $tbl_kategori = 'kategori';
    protected $primKey = 'id_kategori';
    protected $indexKey = 'alias_kategori';
    protected $order = array('nama_kategori' => 'asc'); // default order

    function __construct()
    {
        parent::__construct();
    }

    // This function used to get count data by this table
    function count_all()
    {
        $this->db->from($this->tbl_kategori);
        // $this->db->where('is_deleted', 0);
        return $this->db->count_all_results();
    }

    // This function used to get list data by this table only, not join table
    function get_data($arrWhere = array(), $arrOrder = array(), $limit = 0){
        $rs = array();
        //Flush Param
        $this->db->flush_cache();
        
        $this->db->select('*');
        $this->db->from($this->tbl_kategori);

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
        $this->db->from($this->tbl_kategori);

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
    function get_data_info($key)
    {
        $this->db->select('*');
        $this->db->from($this->tbl_kategori);
        $this->db->where($this->indexKey, $key);
        $query = $this->db->get();
        
        return $query->result_array();
	}

	/**
	 * This function used to get data information by id
	 * @param number $id : This is id
	 * @return array $result : This is data information
	 */
	function get_data_info2($id)
	{
		$this->db->select('*');
		$this->db->from($this->tbl_kategori);
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
        $this->db->insert($this->tbl_kategori, $dataInfo);
        
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
        $this->db->update($this->tbl_kategori, $dataInfo);
        
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
        $this->db->delete($this->tbl_kategori);
        
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
         $this->db->from($this->tbl_kategori);
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
