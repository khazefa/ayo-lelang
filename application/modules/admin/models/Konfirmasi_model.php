<?php
/**
 * Class Konfirmasi_model.php.
 * Desc: Tawaran Model
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Konfirmasi_model extends CI_Model
{
    protected $tbl_confirm = 'konfirmasi_bayar';
	protected $tbl_bid = 'tawaran';
    protected $tbl_lelang = 'lelang';
    protected $tbl_peserta = 'peserta';
    protected $primKey = 'id_konfirmasi';
    protected $indexKey = 'notrans_order';
    protected $order = array('tgl_konfirmasi' => 'desc'); // default order

    function __construct()
    {
        parent::__construct();
	}

	// This function used to get count data by this table
	function count_all()
	{
		$this->db->from($this->tbl_confirm);
		return $this->db->count_all_results();
	}

	// This function used to get count data by this table
	function count_all_date($startDate = NULL, $endDate = NULL)
	{
		$this->db->from($this->tbl_confirm);
		$this->db->where("tgl_order BETWEEN '{$startDate}' AND '{$endDate}'");
		return $this->db->count_all_results();
	}

	// This function used to get count data by this table
	function count_all_by($arrWhere = array())
	{
		$total = 0;
		//Flush Param
		$this->db->flush_cache();
		$this->db->from($this->tbl_confirm);

		if (!empty($arrWhere)) {
			foreach ($arrWhere as $strField => $strValue) {
				$this->db->where($strField, $strValue);
			}
			$total = $this->db->count_all_results();
		} else {
			$total = $this->db->count_all_results();
		}

		return $total;
	}

	// This function used to get list data by this table only, not join table
	function get_data($arrWhere = array(), $arrOrder = array(), $limit = 0, $start = 0)
	{
		$rs = array();
		//Flush Param
		$this->db->flush_cache();

		$this->db->select('*');
		$this->db->from($this->tbl_confirm);

		if (empty($arrWhere)) {
			// $rs = array();
			//Limit
			if ($limit > 0) {
				$this->db->limit($limit, $start);
			}

			//Order By
			if (count($arrOrder) > 0) {
				foreach ($arrOrder as $strField => $strValue) {
					$this->db->order_by($strField, $strValue);
				}
			}
			$query = $this->db->get();
			$rs = $query->result_array();
		} else {
			foreach ($arrWhere as $strField => $strValue) {
				if (is_array($strValue)) {
					$this->db->where_in($strField, $strValue);
				} else {
					if (strpos(strtolower($strField), '_date1') !== false) {
						$strField = substr($strField, 0, -6);
						if (!empty($strValue)) {
							$this->db->where("$strField >= '" . $strValue . "' ");
						}
					} elseif (strpos(strtolower($strField), '_date2') !== false) {
						$strField = substr($strField, 0, -6);
						if (!empty($strValue)) {
							$this->db->where("$strField <= '" . $strValue . "' ");
						}
					} else {
						$this->db->where($strField, $strValue);
					}
				}
			}

			//Limit
			if ($limit > 0) {
				$this->db->limit($limit, $start);
			}

			//Order By
			if (count($arrOrder) > 0) {
				foreach ($arrOrder as $strField => $strValue) {
					$this->db->order_by($strField, $strValue);
				}
			}

			$query = $this->db->get();
			$rs = $query->result_array();
		}

		return $rs;
	}

	// This function used to get list data by this table only, not join table, with like parameters
	function get_data_like($arrLike = array(), $arrOrder = array())
	{
		$rs = array();
		//Flush Param
		$this->db->flush_cache();

		$this->db->select('*');
		$this->db->from($this->tbl_confirm);

		if (empty($arrLike)) {
			$rs = array();
		} else {
			foreach ($arrLike as $strField => $strValue) {
				$this->db->like($strField, $strValue);
			}
			$query = $this->db->get();
			$rs = $query->result_array();
		}

		//Order By
		if (count($arrOrder) > 0) {
			foreach ($arrOrder as $strField => $strValue) {
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
		$this->db->from($this->tbl_confirm);
		$this->db->where($this->primKey, $id);
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
		$this->db->from($this->tbl_confirm);
		$this->db->where($this->indexKey, $id);
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
		$this->db->insert($this->tbl_confirm, $dataInfo);

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
		$this->db->update($this->tbl_confirm, $dataInfo);

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
		$this->db->delete($this->tbl_confirm);

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
		$this->db->from($this->tbl_confirm);
		//Criteria
		if (count($arrWhere) > 0) {
			foreach ($arrWhere as $strField => $strValue) {
				if (is_array($strValue)) {
					$this->db->where_in($strField, $strValue);
				} else {
					$this->db->where($strField, $strValue);
				}
			}
		}
		return $this->db->count_all_results();
	}

}
