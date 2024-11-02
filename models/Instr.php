<?php
class Instr extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $types_instructions;
    public $name;
    public $audience;
    public $options = array('id', 'types_instructions','name');
    public $table_name = 'spr_instr';
    public $table_key = 'id';

    public  function getInstrById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalInstr()
    {
        // Соединение с БД
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getInstrList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'InstrList',$this->table_key,$page);
    }
   
    public  function deleteInstrById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editInstrById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addInstr()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
