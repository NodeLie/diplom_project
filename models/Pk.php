<?php

class Pk extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $short_name;
    public $description;
    public $id_ppssz;
    public $options = array('id', 'short_name', 'description', 'id_ppssz');
    public $table_name = 'spr_pk';
    public $table_key = 'id';

    public  function getPkById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalPk()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getPkList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'PkList',$this->table_key,$page);
    }
   
    public  function deletePkById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editPkById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addPk()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }
}
