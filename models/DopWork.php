<?php

class DopWork extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $name;
    public $year_purchase;
    public $invent;
    public $Count;
    public $type_mto;
    public $audience;
    public $Owner;
    public $options = array('id', 'id_passport', 'name', 'description');
    public $table_name = 'passport_dop_work';
    public $table_key = 'id';

    public  function getDopWorkById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalDopWork()
    {
        // Соединение с БД
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
public  function getDopWorkList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'DopWorkList',$this->table_key,$page);
    }
   
    public  function deleteDopWorkById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editDopWorkById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addDopWork()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
