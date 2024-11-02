<?php
class Po extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $name;
    public $inv_number_license;
    public $type_mto;
    public $audience;
    public $options = array('id', 'name', 'inv_number_license', 'type_mto','audience');
    public $table_name = 'spr_po';
    public $table_key = 'id';

    public  function getPoById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalPo()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getPoList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'PoList',$this->table_key,$page);
    }
   
    public  function deletePoById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editPoById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addPo()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
