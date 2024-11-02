<?php

class Ok extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $short_name;
    public $description;
    public $id_ppssz;
    public $options = array('id', 'short_name', 'description', 'id_ppssz');
    public $table_name = 'spr_ok';
    public $table_key = 'id';

    public  function getOkById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalOk()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getOkList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'OkList',$this->table_key,$page);
    }
   
    public  function deleteOkById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editOkById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addOk()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
