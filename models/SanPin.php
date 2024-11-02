<?php
class SanPin extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $index;
    public $cipher;
    public $unit_measure;
    public $norm_san_pin;
    public $options = array('id', 'indexx', 'cipher', 'unit_measure','norm_san_pin');
    public $table_name = 'spr_san_pin';
    public $table_key = 'id';

    public  function getSanPinById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalSanPin()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getSanPinList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'SanPinList',$this->table_key,$page);
    }
   
    public  function deleteSanPinById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editSanPinById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addSanPin()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
