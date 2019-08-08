<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class Pelelang_model.php.
 * Desc: lorem ipsum
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Pelelang_model extends CI_Model
{
	protected $tbl_pelelang = "pelelang";
	protected $primKey = "id_pelelang";
	protected $indexKey = 'akun_pelelang';

	function __construct()
	{
		parent::__construct();
	}

	// This function used to get count data by this table
	function count_all()
	{
		$this->db->from($this->tbl_pelelang);
		// $this->db->where('is_deleted', 0);
		return $this->db->count_all_results();
	}

	// This function used to get list data by this table only, not join table
	function get_data($arrWhere = array(), $arrOrder = array(), $limit = 0)
	{
		$rs = array();
		//Flush Param
		$this->db->flush_cache();

		$this->db->select('id_pelelang, nama_pelelang, akun_pelelang, email_pelelang, telepon_pelelang, status_pelelang, alamat_pelelang, tgl_daftar_pelelang');
		$this->db->from($this->tbl_pelelang);

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

	/**
	 * This function used to get data information by id
	 * @param number $id : This is id
	 * @return array $result : This is data information
	 */
	function get_data_info($id)
	{
		$this->db->select('id_pelelang, nama_pelelang, akun_pelelang, email_pelelang, telepon_pelelang, status_pelelang, alamat_pelelang, id_kota, tgl_daftar_pelelang');
		$this->db->from($this->tbl_pelelang);
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
		$this->db->insert($this->tbl_pelelang, $dataInfo);

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
		$this->db->update($this->tbl_pelelang, $dataInfo);

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
		$this->db->delete($this->tbl_pelelang);

		return $this->db->affected_rows();
	}
}
