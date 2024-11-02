<?php

class Perspect extends Model
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
    public $options = array('id', 'id_passport', 'name','qty', 'description');
    public $table_name = 'passport_perspect';
    public $table_key = 'id';

    public  function getPerspectById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalPerspect()
    {
        // Соединение с БД
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
public  function getPerspectList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'PerspectList',$this->table_key,$page);
    }
   
    public function deletePerspectById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editPerspectById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addPerspect()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
