<?php
class Ppssz extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id_specialty;
    public $specialty;
    public $name;
    public $id_level_education;
    public $id_department;
    public $options = array('id_specialty', 'specialty', 'name', 'id_level_education','id_department');
    public $table_name = 'spr_ppssz';
    public $table_key = 'id_specialty';

    public  function getPpsszById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalPpssz()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getPpsszList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'PpsszList','specialty',$page);
    }
   
    public  function deletePpsszById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editPpsszById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addPpssz()
    {
         // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = "INSERT INTO spr_ppssz SET";
        $i = 0;
        foreach ($this->options as $option)
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

        $result = $db->prepare($sql);
        foreach ($this->options as $option)
        {            
                $result->bindValue(':'.$option, $_POST[$option]);            
        }
        return $result->execute();       
    }

}
