<?php
class SpecialClothing extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $name;
    public $actual_availability;
    public $audience;
    public $options = array('id', 'name', 'actual_availability', 'audience');
    public $table_name = 'special_clothing';
    public $table_key = 'id';

    public  function getSpecialClothingById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalSpecialClothing()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getSpecialClothingList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'SpecialClothingList',$this->table_key,$page);
    }
   
    public  function deleteSpecialClothingById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editSpecialClothingById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addSpecialClothing()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
