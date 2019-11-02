<?php

/**
 * Class Saldo_model.php.
 * Desc: Saldo Model
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Saldo_model extends CI_Model
{
	protected $tbl_saldo = 'saldo_pelelang';
	protected $tbl_pelelang = 'pelelang';
	protected $primKey = 'id_saldo';
	protected $indexKey = 'id_pelelang';
	protected $order = array('id_akun_bank' => 'asc'); // default order

	function __construct()
	{
		parent::__construct();
	}

	// This function used to get count data by this table
	function count_all()
	{
		$this->db->from($this->tbl_saldo);
		// $this->db->where('is_deleted', 0);
		return $this->db->count_all_results();
	}

	// This function used to get list data by this table only, not join table
	function get_data($arrWhere = array(), $arrOrder = array(), $limit = 0)
	{
		$rs = array();
		//Flush Param
		$this->db->flush_cache();

		$this->db->select('*');
		$this->db->from($this->tbl_saldo);

		if (empty($arrWhere)) {
			// $rs = array();
			//Limit
			if ($limit > 0) {
				$this->db->limit($limit);
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
				$this->db->limit($limit);
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
		$this->db->from($this->tbl_saldo);

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
		$this->db->from($this->tbl_saldo);
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
		$this->db->insert($this->tbl_saldo, $dataInfo);

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
		$this->db->update($this->tbl_saldo, $dataInfo);

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
		$this->db->delete($this->tbl_saldo);

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
		$this->db->from($this->tbl_saldo);
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

	function get_total_saldo($arrWhere = array())
	{
		$rs = array();
		//Flush Param
		$this->db->flush_cache();

		$this->db->select('SUM(s.jumlah_saldo) AS total, p.id_pelelang');
		$this->db->from($this->tbl_saldo . ' as s');
		$this->db->join($this->tbl_pelelang . ' as p', 's.id_pelelang = p.id_pelelang', 'both');

		if (empty($arrWhere)) {
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

			$query = $this->db->get();
			$rs = $query->result_array();
		}

		return $rs;
	}
}
