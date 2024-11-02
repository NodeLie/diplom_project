<?php
class Electrics extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id_electrics;
    public $id_mto;
    public $quantity;
    public $id_audience;
    public $options = array('id_electrics', 'id_mto', 'quantity', 'id_audience');
    public $table_name = 'spr_electrics';
    public $table_key = 'id_electrics';

    public  function getElectricsById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalElectrics()
    {        
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getElectricsList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'ElectricsList',$this->table_key,$page);
    }
   
    public  function deleteElectricsById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editElectricsById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addElectrics()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
