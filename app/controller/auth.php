<?php

class Auth extends Controller
{
	function __construct()
	{
		$this->db = new SafeMySQL();
		$this->model = new Model_auth();
		$this->view = new View();
	}

	function action_login()
	{
		if(isset($_POST) && !empty($_POST))
		{
			$login = $_POST['login'];
			$password = md5($_POST['password']);

			$check = $this->model->check_login($login, $password);

			if($check) 
			{
				Session::init();
				Session::set('loggedIn', true);
				Session::set('u_id', $check['id']);
				Session::set('u_name', $check['name']);
				Session::set('adm', $check['admin']);
				header('Location: /tasks/main');
			}
			else
			{
				$data = array(
					'status' => array(
						'error' => 1,
						'name'	=> 'User with such email or password not found')
				);

				$this->view->generate('login.php', 'main.php', $data);
			}
		}
		else
			$this->view->generate('login.php', 'main.php');	
	}

	function action_logout()
	{
		Session::destroy();
		header('Location: /tasks/main');
	}
}