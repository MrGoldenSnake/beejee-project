<?php
include 'auth.php';

class Tasks extends Controller
{
	function __construct()
	{
		$this->model = new Model_tasks();
		$this->view = new View();
	}
	
	function action_main()
	{	
		$tasks = $this->model->get_data();

		/* экранируем недоступимые теги */
		// foreach ($tasks as $task)
		// 	foreach ($task as $k => $v)
		// 		$task[$k] = htmlentities(strip_tags($v),ENT_QUOTES);

		$data = array(
			'tasks' => $tasks
		);
		$this->view->generate('task_list.php', 'main.php', $data);
	}

	function action_add_edit()
	{
		if(isset($_GET['id']) && is_numeric($_GET['id']) && $_SESSION['adm']) 
		{
			$task = $this->model->get_task($_GET['id']);

			if(!$task[0])
				header('Location: /tasks/add_edit');

			$data = array(
				'task' => $task[0],
				'users' => $users,
			);
		}
		else
		{
			$data = array(
				'users' => $users
			);
		}

		$this->view->generate('add_edit.php', 'main.php', $data);
	}

	function action_confirm()
	{
		if(isset($_GET['id']) && is_numeric($_GET['id']) && $_SESSION['adm'])
		{
			$this->model->confirm($_GET['id']);
		}
	}

	function action_save()
	{
    	$data = array(
			'user_name' => $_POST['user_name'],
			'user_email' => $_POST['user_email'],
			'description' => $_POST['description']
		);

		if(isset($_POST['task_id']))
		{
			$data['task_id'] = $_POST['task_id'];

			/* отметка отредактировано только если изменен текст описания задачи */
			$task = $this->model->get_task($_POST['task_id']);
			if($task[0]['description'] != $data['description'])
				$data['edited'] = 1;
		}

		if(isset($task[0]['task_id']) && !$_SESSION['adm'])
		{
			Session::add_message('You do not have permissions to do that.', 'danger');
			header('Location: /');
		}
		else
		{
			$this->model->save($data);
		}
		
		exit();
	}
}
