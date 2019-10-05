<?php

class Model_tasks
{	
	function __construct()
	{
		$this->db = new SafeMySQL();
	}

	public function get_data()
	{
		return $this->db->getAll("SELECT * FROM `tasks` ORDER BY `task_id` desc");
	}

	public function get_users()
	{
		return $this->db->getAll("SELECT * FROM ?n", 'user');
	}

	public function get_task($id)
	{
		return $this->db->getAll("SELECT * FROM `tasks` WHERE `task_id` = ?i ", $id);
	}

	public function confirm($id)
	{

		$sql  = "UPDATE `tasks` SET `done` = '1' WHERE `task_id` = ?i ";
		return $this->db->query($sql, $id);
	}

	public function save($data)
	{
		$errors = 0;

		/* Проверка данных */
		if(empty($data['user_name']) || strlen($data['user_name']) < 1)
		{
			Session::add_message('Invalid username', 'danger');
			$errors++;
		}

		if(empty($data['description']) || strlen($data['description']) < 1)
		{
			Session::add_message('Invalid description.', 'danger');
			$errors++;
		}

		if(isset($data['task_id']))
		{
			$task = $this->get_task($data['task_id']);
			if(!$task)
			{
				Session::add_message('Task with such ID not found.', 'danger');
				$errors++;
			}
		}

		if($errors > 0)
		{
			/* Если ошибка не в id - возобновляем страницу с записью */
			if($task[0]['task_id'])
				header("Location: /tasks/add_edit".($task[0]['task_id'] ? '?id='.$task[0]['task_id'] : ''));
			else
				header("Location: /tasks/add_edit");
		}
		else
		{
			$sql  = "INSERT INTO tasks SET ?u ON DUPLICATE KEY UPDATE ?u";
			$this->db->query($sql, $data, $data);

			Session::add_message(($task[0] ? 'Task #'.$task[0]['task_id'].' updated.' : 'New task created successfully.'), 'success');
			header('Location: /tasks/main');
		}
	}
}
