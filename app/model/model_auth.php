<?php

class Model_auth
{

	function __construct()
	{
		$this->db = new SafeMySQL();
	}
	
	public function is_logged()
	{
		if(isset($_SESSION['loggedIn']))
			return true;
		else
			return false;
	}

	public function is_admin()
	{
		if(isset($_SESSION) && $_SESSION['adm'] == 1)
			return true;
		else
			return false;
	}

	public function check_login($login, $password)
	{
		$check = $this->db->getAll("SELECT * FROM ?n WHERE `name` = ?s AND `password` = ?s ", 'user', $login, $password);

		if($check)
			return $check[0];
		else
			return false;
	}

}