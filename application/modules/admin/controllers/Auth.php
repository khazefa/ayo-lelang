<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Auth.php.
 * Desc: 
 * @author: Sigit Prayitno
 * @email: cybergitt@gmail.com
 */

class Auth extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show Login interface
	 */
	public function index()
	{
		//check for login status
		if ($this->session->userdata('logged_in')) {
			redirect('/admin/dashboard');
			exit;
		}

		$this->load->view('layouts/admin/signin');
	}

	/**
	 * verify Login
	 *
	 * @param str username
	 * @param str password
	 */
	public function check()
	{
		$sessionArray = array();
		$msg_array = array();
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);

		// Captcha validation passed
		if ($email && $password) {
			//Post Data cURL
			$arr_post = array(
				"username" => $this->security->xss_clean($email),
				"password" => $this->security->xss_clean($password)
			);

			$res = send_curl($arr_post, constant('urlapi') . 'authentication/auth', 'POST', FALSE, TRUE);
			// die(var_dump($res->message));
			//Check Result ( Get status TRUE or FALSE )
			if ($res->status) {
				$sessionArray = array(
					'accBid' => $res->accessId,
					'accKey' => $res->accessUr,
					'accEmail' => $res->accessMail,
					'accName' => $res->accessName,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sessionArray);
				$msg_array = array(
					'status' => TRUE,
					'message' => $res->message
				);
			} else {
				$msg_array = array(
					'status' => FALSE,
					'message' => $res->message
				);
			}
		} else {
			$msg_array = array(
				'status' => FALSE,
				'message' => 'Please input your username and password.'
			);
		}

		return $this->output
			->set_content_type('application/json')
			->set_output(
				json_encode($msg_array)
			);
	}

	function validate_recaptcha($secretKey, $response)
	{
		// Verifying the user's response (https://developers.google.com/recaptcha/docs/verify)
		$verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

		$query_data = [
			'secret' => $secretKey,
			'response' => $response,
			'remoteip' => (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'])
		];

		// Collect and build POST data
		$post_data = http_build_query($query_data, '', '&');

		// Send data on the best possible way
		if (function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec')) {
			// Use cURL to get data 10x faster than using file_get_contents or other methods
			$ch = curl_init($verifyURL);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/x-www-form-urlencoded'));
			$response = curl_exec($ch);
			curl_close($ch);
		} else {
			// If server not have active cURL module, use file_get_contents
			$opts = array(
				'http' =>
				array(
					'method' => 'POST',
					'header' => 'Content-type: application/x-www-form-urlencoded',
					'content' => $post_data
				)
			);
			$context = stream_context_create($opts);
			$response = file_get_contents($verifyURL, false, $context);
		}

		// Verify all reponses and avoid PHP errors
		if ($response) {
			$result = json_decode($response);
			if ($result->success === true) {
				return true;
			} else {
				return $result;
			}
		}

		// Dead end
		return false;
	}

	public function forgot_password()
	{
		$input = $this->input->post(null, true);
		$email = element('email_forgot', $input);
		$encoded_email = urlencode($email); //please always encode email if it used as post parameter

		//Post Data cURL
		$arr_post = array(
			"email" => $this->security->xss_clean($encoded_email)
		);

		$res = send_curl($arr_post, constant('urlapi') . 'authentication/reset-password', 'POST', FALSE, TRUE);
		// die(var_dump($res->message));
		//Check Result ( Get status TRUE or FALSE )
		if ($res->status) { }

		if ($this->MLog->check_email_exist($email)) {
			$encoded_email = urlencode($email);

			$data['username'] = $email;
			$data['email'] = $email;
			$data['activation_id'] = generateRandomString(15);
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['agent'] = getBrowserAgent();
			$data['client_ip'] = $this->input->ip_address();

			//			var_dump($this->config->item('backend') . "reset_pass_confirm/" . $data['activation_id'] . "/" . $encoded_email);exit();
			$save = $this->MLog->reset_password_user($data);

			if ($save) {
				$data1['reset_link'] = $this->config->item('backend') . "reset_pass_confirm/" . $data['activation_id'] . "/" . $encoded_email;
				$userInfo = $this->MLog->get_info_by_email($email);

				if (!empty($userInfo)) {
					$data1["name"] = $userInfo[0]->adminrealname;
					$data1["email"] = $userInfo[0]->adminemail;
					$data1["message"] = "Reset Your Password";
				}

				$sendStatus = resetPasswordEmail($data1);

				if ($sendStatus) {
					$result = array(
						'status' => TRUE,
						'message' => 'Reset password link sent successfully, please check your email.'
					);
				} else {
					$result = array(
						'status' => TRUE,
						'message' => 'Email has been failed, try again.'
					);
				}
			} else {
				$result = array(
					'status' => TRUE,
					'message' => 'It seems an error while sending your details, try again.'
				);
			}
		} else {
			$result = array(
				'status' => FALSE,
				'message' => 'Reset password link sent successfully, please check your email.'
			);
		}

		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
		return $output;
	}

	public function reset_pass_confirm($activation_id, $email)
	{
		$output = null;

		$email = urldecode($email);

		// Check activation id in database
		$is_correct = $this->MLog->check_activation_details($email, $activation_id);

		$data['email'] = $email;
		$data['activation_code'] = $activation_id;

		if ($is_correct == 1) {
			$this->session->set_flashdata('message', 'Email Anda terdaftar di sistem kami.');
			$data['email'] = $email;
			$data['activation_code'] = $activation_id;

			$this->digiView($data, 'layouts/backend/new-password');
		} else {
			//sengaja dibuat message yang sama, ini menghindari user/bot menebak-nebak email pengguna yang aktif di sistem
			$this->session->set_flashdata('message', 'Email Anda terdaftar di sistem kami.');
			redirect('/', true);
		}
	}

	// This function used to act to change the new password
	public function change_new_password()
	{
		$input = $this->input->post(null, true);
		$activation_id = element('activation_code', $input);
		$email = element('email', $input);
		$password = element('password', $input);
		$cpassword = element('password', $input);
		$output = null;

		// Get email and activation code from URL values at index 3-4
		$email = urldecode($email);

		// Check activation id in database
		$is_correct = $this->MLog->check_activation_details($email, $activation_id);

		//Check Result ( Get status TRUE or FALSE )
		if ($is_correct == 1) {
			$this->MLog->create_password($email, $password);
			$this->session->set_flashdata('message', 'Kata sandi Anda telah sukses diganti.');
			redirect('/', true);
		} else {
			$this->session->set_flashdata('message', 'Kata sandi Anda telah gagal diganti.');
			redirect('/', true);
		}
	}

	/**
	 * Sign out
	 */
	public function signout()
	{
		$this->session->sess_destroy();
		redirect('/', true);
	}
}
