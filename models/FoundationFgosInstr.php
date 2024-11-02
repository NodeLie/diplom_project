<?php

class FoundationFgosInstr extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $options = array('id', 'id_instr', 'id_foundation');
    public $table_name = 'f_o_fgos_instr';
    public $table_key = 'id';

    public  function getFoundationFgosInstrById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalFoundationFgosInstr()
    {
        // Соединение с БД
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
public  function getFoundationFgosInstrList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'FoundationFgosInstrList',$this->table_key,$page);
    }
   
    public  function deleteFoundationFgosInstrById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editFoundationFgosInstrById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addFoundationFgosInstr($id_foundation,$instr)
    {
         // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД        
        $sql = "INSERT INTO f_o_fgos_instr SET
                id_foundation = :id_foundation,
                id_instr = :id_instr";
        $result = $db->prepare($sql);
        if (is_array($instr))
        {
            foreach ($instr as $item)
            {                
                $result->bindValue('id_foundation',$id_foundation);
                $result->bindValue('id_instr',$item);
                $result->execute();
            }
        }
        else
        {
            $result->bindValue('id_foundation',$id_foundation);
            $result->bindValue('id_instr',$instr);
            $result->execute(); 
        }            
    }

}
