<?php

class Disciplines extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $id_ciphers;
    public $index_discipline;
    public $id_foundation;
    public $name;
    public $ppsz;
    public $year_fgos;
    public $options = array('id', 'id_ciphers', 'ppsz', 'index_discipline', 'name', 'year_fgos', 'id_foundation');
    public $table_name = 'disciplines';
    public $table_key = 'id';

    public  function getDisciplinesById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalDisciplines()
    {
        // Соединение с БД
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getDisciplinesList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'DisciplinesList','name',$page);
    }
   
    public  function deleteDisciplinesById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editDisciplinesById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addDisciplines()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
