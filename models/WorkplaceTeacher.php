<?php
class WorkplaceTeacher extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $name;
    public $count;
    public $audience;
    public $options = array('id', 'name', 'count', 'audience');
    public $table_name = 'workplace_teacher';
    public $table_key = 'id';

    public  function getWorkplaceTeacherById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalWorkplaceTeacher()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getWorkplaceTeacherList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'WorkplaceTeacherList',$this->table_key,$page);
    }
   
    public  function deleteWorkplaceTeacherById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editWorkplaceTeacherById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addWorkplaceTeacher()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
