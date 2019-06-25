<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class Auth_model.php.
 * Desc: lorem ipsum
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Auth_model extends CI_Model
{
	protected $tbl_akun = 'akun';
	protected $primKey_akun = 'id_akun';
	protected $indexKey_akun = 'nama_akun';

	protected $tbl_pelelang = 'pelelang';
	protected $primKey_pelelang = 'id_pelelang';
	protected $indexKey_pelelang = 'akun_pelelang';

	/**
	 * This function used to check the login credentials of the user
	 * @param string $username : This is username of the user
	 * @param string $password : This is encrypted password of the user
	 */
	function auth_default($username, $password)
	{
		$this->db->select('a.id_akun, a.nama_akun, a.sandi_akun, a.nama_lengkap_akun, a.email_akun, a.level_akun, a.status_akun');
		$this->db->from($this->tbl_akun.' as a');
		$this->db->where('a.nama_akun', $username);
		$this->db->where('a.status_akun', 1);
		$query = $this->db->get();

		$user = $query->result();

		if(!empty($user)){
			if(sha1($password) == $user[0]->sandi_akun){
				return $user;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	/**
	 * This function used to check the login credentials of the user
	 * @param string $email : This is email of the user
	 * @param string $password : This is encrypted password of the user
	 */
	function auth_email($email, $password)
	{
		$this->db->select('a.id_akun, a.nama_akun, a.sandi_akun, a.nama_lengkap_akun, a.email_akun, a.level_akun, a.status_akun');
		$this->db->from($this->tbl_akun . ' as a');
		$this->db->where( 'a.email_akun', $email);
		$this->db->where('a.status_akun', 1);
		$query = $this->db->get();

		$user = $query->result();

		if(!empty($user)){
			if(sha1($password) === $user[0]->sandi_akun){
				return $user;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	/**
	 * This function used to check email exists or not
	 * @param {string} $email : This is users email id
	 * @return {boolean} $result : TRUE/FALSE
	 */
	function check_email_exist($email)
	{
		$this->db->select('email_akun');
		$this->db->where('email_akun', $email);
		$this->db->where('status_akun', 1);
		$query = $this->db->get($this->tbl_akun);

		if ($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * This function is used to get information by email-id
	 * @param string $email : Email id of user
	 * @return object $result : Information of user
	 */
	function get_info_by_email($email)
	{
		$this->db->select('nama_akun, email_akun, nama_lengkap_akun');
		$this->db->from($this->tbl_akun);
		$this->db->where('email_akun', $email);
		$this->db->where('status_akun', 1);
		$query = $this->db->get();

		return $query->result_array();
	}

	/** START PELELANG */

	/**
	 * This function used to check the login credentials of the user
	 * @param string $username : This is username of the user
	 * @param string $password : This is encrypted password of the user
	 */
	function auth_default_p($username, $password)
	{
		$this->db->select( 'a.id_pelelang, a.akun_pelelang, a.sandi_pelelang, a.nama_pelelang, a.email_pelelang, a.status_pelelang');
		$this->db->from($this->tbl_pelelang . ' as a');
		$this->db->where('a.akun_pelelang', $username);
		$this->db->where('a.status_pelelang', 1);
		$query = $this->db->get();

		$user = $query->result();

		if (!empty($user)) {
			if (sha1($password) == $user[0]->sandi_pelelang) {
				return $user;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	/**
	 * This function used to check the login credentials of the user
	 * @param string $email : This is email of the user
	 * @param string $password : This is encrypted password of the user
	 */
	function auth_email_p($email, $password)
	{
		$this->db->select('a.id_pelelang, a.akun_pelelang, a.sandi_pelelang, a.nama_pelelang, a.email_pelelang, a.status_pelelang');
		$this->db->from($this->tbl_pelelang . ' as a');
		$this->db->where('a.email_pelelang', $email);
		$this->db->where('a.status_pelelang', 1);
		$query = $this->db->get();

		$user = $query->result();

		if (!empty($user)) {
			if (sha1($password) === $user[0]->sandi_pelelang) {
				return $user;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	/**
	 * This function used to check email exists or not
	 * @param {string} $email : This is users email id
	 * @return {boolean} $result : TRUE/FALSE
	 */
	function check_email_exist_p($email)
	{
		$this->db->select('email_pelelang');
		$this->db->where('email_pelelang', $email);
		$this->db->where('status_pelelang', 1);
		$query = $this->db->get($this->tbl_pelelang);

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * This function is used to get information by email-id
	 * @param string $email : Email id of user
	 * @return object $result : Information of user
	 */
	function get_info_by_email_p($email)
	{
		$this->db->select('akun_pelelang, email_pelelang, nama_pelelang');
		$this->db->from($this->tbl_pelelang);
		$this->db->where('email_pelelang', $email);
		$this->db->where('status_pelelang', 1);
		$query = $this->db->get();

		return $query->result_array();
	}

	/** END PELELANG */
}
