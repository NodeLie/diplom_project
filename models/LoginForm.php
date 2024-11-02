<?php

class LoginForm
{
	public $login;
	public $password;

	private $errors = array();

	function __construct(){}

	public function getError()
	{
		echo array_shift($this->errors);
	}

	private function findLogin()
	{
		$db = DataBase::getInstance()->getDb();

		$employee = $db->prepare("SELECT * FROM employee WHERE login = :login");
		$employee->bindParam(':login', $this->login);
		$employee->execute();
		if ($employee->rowCount() > 0)
		{
			$row = $employee->fetch();
			$this->password = md5($this->password);
			if ($this->password == $row['password'])
			{
				//$initials = $row['surname']." ".mb_substr($row['name'], 0, 1).".".mb_substr($row['patronymic'], 0, 1).".";
				$initials = $row['login'];
				Auth::getInstance()->login(array('id'=>$row['id'], 'surname'=>$row['surname'], 'name'=>$row['name'], 'patronymic'=>$row['patronymic'], 'id_pk_pkc'=>$row['id_pk_pkc'], 'id_type_employee'=>$row['id_type_employee'], 'id_department'=>$row['id_department'], 'id_posts'=> $row['id_posts'],'login'=>$row['login'],'password'=>$row['password'],'rules'=>$row['rules'], 'initials'=> $initials, 'table_name'=>'employee'));

				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function login()
	{
		$db = DataBase::getInstance()->getDb();

		$this->login = Helper::clean($this->login);
		$this->password = Helper::clean($this->password);

		if (empty($this->login))
			$this->errors[] = "Введите логин!";
		if (empty($this->password))
			$this->errors[] = "Введите пароль!";

		if (empty($this->errors))
		{
			if ($this->findLogin())
			{
				return true;
			}
			else
			{
				$this->errors[] = "Неверный логин или пароль!";
				return false;
			}
		}
		else
		{
			$this->errors[] = "Неверный логин или пароль!";
			return false;
		}
	}
}

?>