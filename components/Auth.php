<?php

class Auth
{
	// Группы пользователей и сотрудников

	const TEACHER = 'teacher';
	const ADMIN = 'admin'; // Администратор
	const INVENT = 'invent';
	const PASSPORTIST = 'passportist';

	private $Rules = array('','admin','teacher','invent','passportist');

	static $instance = null;

	private function __clone(){}

	private function __wakeup(){}

	function __destruct()
	{
		self::$instance = null;
	}

	public static function getInstance() 
	{
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Вход
	public function login($auth)
	{
		if (!isset($_SESSION['Auth']))
			$_SESSION['Auth'] = $auth;
	}

	// Выход
	public function logout()
	{
		unset($_SESSION['Auth']);
		unset($_SESSION['table_id']);
		unset($_SESSION['table_mode']);
		unset($_SESSION['table_module']);
		unset($_SESSION['academic_year']);
		unset($_SESSION['locking_academic_year']);
		unset($_SESSION['pagination_page']);
		unset($_SESSION['pagination_item_per_page']);
		unset($_SESSION['table_filter']);
		unset($_SESSION['table_error']);
	}

	// Если гость
	public function isGuest()
	{
		if (isset($_SESSION['Auth']))
			return false;
		else
			return true;
	}

	// Проверка доступа
	public function compareRules($value)
	{
		if (isset($_SESSION['Auth']))
		{
			if ($_SESSION['Auth']['table_name'] == 'employee')
			{
				if ($this->Rules[$_SESSION['Auth']['rules']] == $value)
					return true;
				else
					return false;
			}
		}
	}

	public function getRules()
	{
		if (isset($_SESSION['Auth']))
		{
			if ($_SESSION['Auth']['table_name'] == 'employee')
				return $this->Rules[$_SESSION['Auth']['rules']];
		}
	}

	public function getName()
	{
		if (isset($_SESSION['Auth']))
			return $_SESSION['Auth']['initials'];
	}

	public function getAuth($key)
	{
		if (isset($_SESSION['Auth']))
			return $_SESSION['Auth'][$key];
	}

	public function setAuth($key,$value)
	{
		if (isset($_SESSION['Auth']))
			$_SESSION['Auth'][$key] = $value;
	}

	// Сессия для сохранения фильтров

	public function getTableFilter($table,$key)
	{
		$table = mb_strtolower($table, 'UTF-8');
		if (isset($_SESSION['table_filter'][$table][$key]))
			return $_SESSION['table_filter'][$table][$key];
	}

	public function isExsistsTableFilter($table,$key)
	{
		$table = mb_strtolower($table, 'UTF-8');
		if (isset($_SESSION['table_filter'][$table][$key]))
			return true;
		else
			return false;
	}

	public function setTableFilter($table,$post=array())
	{
		$table = mb_strtolower($table, 'UTF-8');
		foreach ($post as $item)
		{
			if (!empty($_POST[$item]))
			{				
				$_SESSION['table_filter'][$table][$item] = $_POST[$item];					
			}
			else if(isset($_SESSION['table_filter'][$table][$item]))
			{
				$this->resetTableFilter($table,$item);
			}

		}
	}

	public function resetTableFilter($table,$key)
	{
		$table = mb_strtolower($table, 'UTF-8');
		unset($_SESSION['table_filter'][$table][$key]);
	}

	public function resetTableAllFilter($table)
	{
		$table = mb_strtolower($table, 'UTF-8');
		unset($_SESSION['table_filter'][$table]);
	}
	public function AjaxLoadFoundation($id_ppssz)
	{
		$db = DataBase::getInstance()->getDb();
        // Текст запроса к БД
        $sql = "SELECT id_foundation, foundation_offices_fgos.name as office_name, spr_t_cabinet_fgos.name as cabinet_name FROM foundation_offices_fgos INNER JOIN spr_t_cabinet_fgos ON id_t_cabinet = spr_t_cabinet_fgos.id WHERE id_ppssz = :id_ppssz";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindValue(':id_ppssz', $id_ppssz);
        $result->execute();
        $row = $result->fetchall();
        //echo "<select id='".$list_name."'name='".$list_name."'>";
        foreach ($row as $item)
        {
        	echo "<option value='".$item['id_foundation']."'>".$item['cabinet_name']."|".$item['office_name']. "</option>";
        }
       // echo "</select>";
	}
	// Сессия для сохранения ошибок таблицы

	public function isExsistsTableError()
	{
		if (isset($_SESSION['table_error']))
			return true;
		else
			return false;		
	}

	public function getTableError()
	{
		if (isset($_SESSION['table_error']))
		{
			$error = $_SESSION['table_error'];
			unset($_SESSION['table_error']);
			return $error;
		}
	}

	public function setTableError($value)
	{
		$_SESSION['table_error'] = $value;
	}

	public function getTableId()
	{
		if (isset($_SESSION['table_id']))
    		return $_SESSION['table_id'];
	}

	public function setTableId($value)
	{
		$_SESSION['table_id'] = $value;
	}

	// Сессии академического года

	public function getAcademicYear()
    {
    	if (isset($_SESSION['id_academic_year']))
    		return $_SESSION['id_academic_year'];
    }

    public function setAcademicYear($value)
    {
    	$_SESSION['id_academic_year'] = $value;
    }

    public function setAcademicYearLocking($value)
    {
    	$_SESSION['locking_academic_year'] = $value;
    }

    public function getAcademicYearLocking()
    {
     	if (isset($_SESSION['locking_academic_year']))
    		return $_SESSION['locking_academic_year'];   	
    }

    public function compareAcademicYearLocking($value)
    {
    	if (isset($_SESSION['locking_academic_year']))
		{
			if ($this->acadYearGroup[$_SESSION['locking_academic_year']] == $value)
				return true;
			else
				return false;
		}
    }

    // Сессии режимов таблицы

    public function setTableWorksMode($value)
    {
    	$_SESSION['table_mode'] = $value;
    }

    public function getTableWorksMode()
    {
    	if (isset($_SESSION['table_mode']))
    		return $_SESSION['table_mode'];
    }

 	// Сессии модуля таблицы

    public function getTableModule()
    {
    	if (isset($_SESSION['table_module']))
    		return $_SESSION['table_module'];
    }

    public function setTableModule($value)
    {
    	$_SESSION['table_module'] = $value;
    }
}
?>