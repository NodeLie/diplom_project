<?php
class Employee extends Model
{
    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $surname;
    public $name;
    public $patronymic;
    public $id_pk_pkc;
    public $id_type_employee;
    public $id_department;
    public $id_posts;
    public $login;
    public $password;
    public $rules;
    public $options = array('id', 'name', 'surname', 'patronymic', 'id_pk_pkc', 'id_type_employee', 'id_department','id_posts','login','password','rules');
    public $table_name = 'employee';
    public $table_key = 'id';

    public  function getEmployeeById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalEmployee()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getEmployeeList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'EmployeeList',$this->table_key,$page);
    }
   
    public  function deleteEmployeeById($id)
    {   
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editEmployeeById($id)
    {
        // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = "UPDATE employee SET ";
        $i = 0;
        foreach ($this->options as $option)
        {
            if ($option != $this->table_key)
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
        $sql .= "WHERE ". $this->table_key." = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id);
        foreach ($this->options as $option)
        {
            if ($option != $this->table_key && $option != 'password')
            {   
                $result->bindValue(':'.$option, $_POST[$option]);
            }
        }
        $result->bindValue(':password',md5($_POST['password']));
        return $result->execute();
    }

    public function addEmployee()
    {
        // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = "INSERT INTO employee SET";
        $i = 0;
        foreach ($this->options as $option)
        {
            if ($option != $this->table_key)
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
            if ($option != $this->table_key && $option != 'password')
            {   
                $result->bindValue(':'.$option, $_POST[$option]);
            }
        }
        $result->bindValue(':password', md5($_POST['password']));
        return $result->execute();      
    }

}
