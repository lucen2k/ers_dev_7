<?php

/**
 * Auth Class
 *
 * @author Lucen harukawa
 */
class Auth
{
	# ログイン時Auth項目
	var $userid;
	var $username;
	var $email;

	# ログイン情報取得用
	var $db;

	function __construct($db, $auth=null)
	{
		# db class
		$this->db = $db;

		# user info
		if (!empty($auth['id'])) {
			$this->userid = $auth['id'];
		}
		if (!empty($auth['name'])) {
			$this->username = $auth['name'];
		}
		if (!empty($auth['email'])) {
			$this->email = $auth['email'];
		}
	}

	# login & get user info
	public function login($param)
	{
		# get user info
		$bind = array(
  			":search" => "%".$param['email']
		);
		$user_info = $this->db->select('users', 'email LIKE :search', $bind);
		if (!empty($user_info[0])) {
			$user_info = $user_info[0];
		} else {
			return false;
		}
		//echo "<pre>"; print_r($param); echo "</pre>";

		# password check
		if ($user_info['password'] == md5($param['password'])) {
			# 渡す情報からパスワードを除く
			unset($user_info['password']);
			return $user_info;
		}

		return false;
	}

	# login check
	public function login_check()
	{
		# ログイン確認して、そうじゃない場合リダイレクト
		if (empty($this->userid)) {
			redirect('admin/login.php');
		}

		return true;
	}

}






