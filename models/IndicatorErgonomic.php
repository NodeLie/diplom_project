<?php
class IndicatorErgonomic extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $index;
    public $indicator_values;
    public $additional_indicators;
    public $academic_year;
    public $audience;
    public $options = array('id', 'indexx', 'indicator_values', 'additional_indicators', 'academic_year', 'audience');
    public $table_name = 'indicator_ergonomic';
    public $table_key = 'id';

    public  function getIndicatorErgonomicById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalIndicatorErgonomic()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getIndicatorErgonomicList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'IndicatorErgonomicList',$this->table_key,$page);
    }
   
    public  function deleteIndicatorErgonomicById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editIndicatorErgonomicById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addIndicatorErgonomic()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
