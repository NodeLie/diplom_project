<?php

class Model
{
    private $class;

	function __construct()
    {
        $this->class = mb_strtolower(get_class($this), 'UTF-8');
    }

	public function getTableItemById($table_name,$id,$key_table)
	{
		$sql = "SELECT * FROM $table_name WHERE $key_table = :id";
		$db = DataBase::getInstance()->getDb();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id);
        // Выполнение коменды
        $result->execute();
        $row=$result->fetch();
        foreach ($this->options as $option)
        {
        $this->{$option} = $row[$option];
    	}
    }
    public function getTotalItemByTable($table_name,$table_key)
    {
    	$db = DataBase::getInstance()->getDb();
        // Текст запроса к БД
        $sql = "SELECT count($table_key) AS count FROM $table_name";
         if (isset($_SESSION['table_filter'][$this->class]) && $_SESSION['table_filter'][$this->class])
        {
            $filter = $_SESSION['table_filter'][$this->class];
            $i = 0;
            $sql .= ' WHERE';
            foreach ($filter as $item => $value)
            {
                if ($i != count($filter)-1)
                {
                    $sql .= ' '.$item.' = :'.$item.' AND ';     
                    $i++;               
                }
                else $sql .= ' '.$item.' = :'.$item.' ';
            }
        }
        $result = $db->prepare($sql);
        if (isset($_SESSION['table_filter'][$this->class]) && $_SESSION['table_filter'][$this->class])
        {
            foreach ($filter as $item => $value)
            {
                $result->bindValue(":".$item,$value);
            }
        }        
        // Возвращаем значение count - количество
        $result->execute();
        $row = $result->fetch();
        return $row['count'];
    }
    public function getListItemByTable($table_name,$arr_name,$table_key,$page)
    {
    	$limit = $this->class::SHOW_BY_DEFAULT;                
        // Смещение (для запроса)
        $offset = ($page - 1) * $this->class::SHOW_BY_DEFAULT;
        // Соединение с БД
        $db = DataBase::getInstance()->getDb();
        // Текст запроса к БД
        $sql = "SELECT * FROM $table_name";

        if (isset($_SESSION['table_filter'][$this->class]) && $_SESSION['table_filter'][$this->class])
        {
            $filter = $_SESSION['table_filter'][$this->class];
            $i = 0;
            $sql .= ' WHERE';
            foreach ($filter as $item => $value)
            {
                if ($i != count($filter)-1)
                {
                    $sql .= ' '.$item.' = :'.$item.' AND ';     
                    $i++;               
                }
                else $sql .= ' '.$item.' = :'.$item.' ';
            }
        }

        $sql .= " ORDER BY $table_key ASC LIMIT :limit OFFSET :offset";
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        if (isset($_SESSION['table_filter'][$this->class]) && $_SESSION['table_filter'][$this->class])
        {
            foreach ($filter as $item => $value)
            {
                $result->bindValue(":".$item,$value);
            }
        }       
         
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        ${$arr_name} = array();
        $row = $result->fetchall();
        for ($i=0; $i < count($row) ; $i++)
        {        
        	foreach ($row[$i] as $key => $value)
        	{
        		${$arr_name}[$i][$key] = $value;
        	}    
        }
        return ${$arr_name};
    }

    public function  deleteTableItemById ($table_name,$table_key,$id)
    {
    	 // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = "DELETE FROM $table_name WHERE $table_key = :id";
        
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id);
        $result->execute();
    }

    public function editTableItemById($table_name,$table_key,$id)
    {
    	// Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = "UPDATE $table_name SET ";
        $i = 0;
        foreach ($this->options as $option)
        {
        	if ($option != $table_key)
        	{
	        	if ($i < count($this->options)-1)
	        	{
	        		$sql .=' '.$option.' = :'.$option.', ';
	        		$i++;
	        	}
	        	else
	        	{
	        	   	$sql .=' '.$option.' = :'.$option.' ';
	        	}
	        }
	        else $i++;
        	
        }     
        $sql .= "WHERE $table_key = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id);
        foreach ($this->options as $option)
        {
        	if ($option != $table_key)
        	{   
        		$result->bindValue(':'.$option, $_POST[$option]);
        	}
        }
        return $result->execute();
    }
    public function addTableItem($table_name, $table_key)
    {
    	 // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = "INSERT INTO $table_name SET";
        $i = 0;
        foreach ($this->options as $option)
        {
        	if ($option != $table_key)
        	{        	
	        	if ($i < count($this->options)-1)
	        	{                   
	        		$sql .=' '.$option.' = :'.$option.', ';
	        		$i++;
	        	}
	        	else
	        	{                   
	        		$sql .=' '.$option.' = :'.$option.' ';
	        	}
        	}
        	else $i++;     	
        }     

        $result = $db->prepare($sql);
        foreach ($this->options as $option)
        {
        	if ($option != $table_key)
        	{  	
        		$result->bindValue(':'.$option, $_POST[$option]);
        	}
        }
        return $result->execute();
    }
}

?>