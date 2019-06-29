<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class Auth_model.php.
 * Desc: lorem ipsum
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Auth_model extends CI_Model
{
	protected $tbl_peserta = "peserta";
	protected $primKey = "id_peserta";
	protected $indexKey = 'akun_peserta';

	/**
	 * This function used to check the login credentials of the user
	 * @param string $username : This is username of the user
	 * @param string $password : This is encrypted password of the user
	 */
	function auth_default($username, $password)
	{
		$this->db->select('a.id_peserta, a.akun_peserta, a.sandi_peserta, a.nama_peserta, a.email_peserta, a.status_peserta');
		$this->db->from($this->tbl_peserta.' as a');
		$this->db->where('a.akun_peserta', $username);
		$this->db->where('a.status_peserta', 1);
		$query = $this->db->get();

		$user = $query->result();

		if(!empty($user)){
			if(sha1($password) == $user[0]->sandi_peserta){
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
		$this->db->select('a.id_peserta, a.akun_peserta, a.sandi_peserta, a.nama_peserta, a.email_peserta, a.status_peserta');
		$this->db->from($this->tbl_peserta . ' as a');
		$this->db->where('a.email_peserta', $email);
		$this->db->where('a.status_peserta', 1);
		$query = $this->db->get();

		$user = $query->result();

		if(!empty($user)){
			if(sha1($password) === $user[0]->sandi_peserta){
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
		$this->db->select('email_peserta');
		$this->db->where('email_peserta', $email);
		$this->db->where('status_peserta', 1);
		$query = $this->db->get($this->tbl_peserta);

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
		$this->db->select('akun_peserta, email_peserta, nama_peserta');
		$this->db->from($this->tbl_peserta);
		$this->db->where('email_peserta', $email);
		$this->db->where('status_peserta', 1);
		$query = $this->db->get();

		return $query->result_array();
	}
}
