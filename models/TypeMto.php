<?php
class TypeMto extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $type_mto;
    public $options = array('id','type_mto');
    public $table_name = 'spr_mto';
    public $table_key = 'id';

    public  function getTypeMtoById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalTypeMto()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getTypeMtoList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'TypeMtoList',$this->table_key,$page);
    }
   
    public  function deleteTypeMtoById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editTypeMtoById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addTypeMto()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
