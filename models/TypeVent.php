<?php
class TypeVent extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $type_ventilation;
    public $options = array('id', 'type_ventilation');
    public $table_name = 'spr_t_vent';
    public $table_key = 'id';

    public  function getTypeVentById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalTypeVent()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getTypeVentList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'TypeVentList',$this->table_key,$page);
    }
   
    public  function deleteTypeVentById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editTypeVentById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addTypeVent()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
