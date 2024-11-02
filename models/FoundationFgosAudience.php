<?php

class FoundationFgosAudience extends Model
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $options = array('id', 'id_audience', 'id_foundation');
    public $table_name = 'f_o_fgos_audience';
    public $table_key = 'id';

    public  function getFoundationFgosAudienceById($id)
    {        
        $this->getTableItemById($this->table_name,$id,$this->table_key);        
    }
    
    public  function getTotalFoundationFgosAudience()
    {
        // Соединение с БД
        return $this->getTotalItemByTable($this->table_name,$this->table_key);
    }
 
public  function getFoundationFgosAudienceList($page = 1)
    {
        return $this->getListItemByTable($this->table_name,'FoundationFgosAudienceList',$this->table_key,$page);
    }
   
    public  function deleteFoundationFgosAudienceById($id)
    {
       $this->deleteTableItemById($this->table_name,$this->table_key,$id);    
    }

    public  function editFoundationFgosAudienceById($id)
    {
        $this->editTableItemById($this->table_name,$this->table_key,$id);
    }

    public function addFoundationFgosAudience()
    {
        $this->addTableItem($this->table_name,$this->table_key);         
    }

}
