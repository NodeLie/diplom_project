<?php
class TypeInstr extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $types_instructions;
    public $name;
    public $options = array('id', 'types_instructions', 'name');
    public $table_name = 'spr_t_instr';
    public $table_key = 'id';

    public  function getTypeInstrById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalTypeInstr()
    {
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
    public  function getTypeInstrList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'TypeInstrList',$this->table_key,$page);
    }
   
    public  function deleteTypeInstrById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editTypeInstrById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addTypeInstr()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
