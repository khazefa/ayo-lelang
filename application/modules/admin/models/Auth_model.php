<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class Auth_model.php.
 * Desc: lorem ipsum
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Auth_model extends CI_Model
{
	protected $pTbl = "akun";
	protected $pKey = "id_akun";
	protected $uKey = "nama_akun";

	/**
	 * This function used to check the login credentials of the user
	 * @param string $username : This is username of the user
	 * @param string $password : This is encrypted password of the user
	 */
	function auth_default($username, $password)
	{
		$this->db->select('a.id_akun, a.nama_akun, a.sandi_akun, a.nama_lengkap_akun, a.email_akun, a.level_akun, a.status_akun');
		$this->db->from($this->pTbl.' as a');
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
		$this->db->from($this->pTbl . ' as a');
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
		$query = $this->db->get($this->pTbl);

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
		$this->db->from($this->pTbl);
		$this->db->where('email_akun', $email);
		$this->db->where('status_akun', 1);
		$query = $this->db->get();

		return $query->result();
	}
}
