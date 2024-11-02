<?php

class Tools extends Model
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
    public $options = array('id', 'name', 'year_purchase', 'invent', 'Count', 'type_mto', 'audience', 'Owner');
    public $table_name = 'spr_tools';
    public $table_key = 'id';

    public  function getToolsById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalTools()
    {
        // Соединение с БД
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
public  function getToolsList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'ToolsList',$this->table_key,$page);
    }
   
    public  function deleteToolsById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editToolsById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addTools()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
