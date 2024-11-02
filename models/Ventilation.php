<?php

class Ventilation extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $type_ventilation;
    public $type_fan;
    public $count;
    public $speed_exchange;
    public $room_volume;
    public $audience;
    public $options = array('id', 'type_ventilation', 'type_fan', 'count','speed_exchange','room_volume','audience');
    public $table_name = 'ventilation';
    public $table_key = 'id';

    public  function getVentilationById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalVentilation()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getVentilationList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'VentilationList',$this->table_key,$page);
    }
   
    public  function deleteVentilationById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editVentilationById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addVentilation()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
