<?php
class ReadDisciplines extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $id_academic_year;
    public $id_employee;
    public $id_disciplines;
    public $options = array('id', 'id_academic_year', 'id_employee', 'id_disciplines');
    public $table_name = 'read_disciplines';
    public $table_key = 'id';

    public  function getReadDisciplinesById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalReadDisciplines()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getReadDisciplinesList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'ReadDisciplinesList',$this->table_key,$page);
    }
   
    public  function deleteReadDisciplinesById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editReadDisciplinesById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addReadDisciplines()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
