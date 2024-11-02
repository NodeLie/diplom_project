<?php

class OverTenYears
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $employee;

    protected function getWorkExcelList($writer, $result, $fields)
    {
        $workList = array();
        $i = 0; // Счетчик записей
        $ordinal = 0;

        array_unshift($fields,'ordinal');

        while ($row = $result->fetch()) 
        {
            $ordinal++;

            for ($j = 0; $j < count($fields); $j++)
            {
                if ($fields[$j] == 'ordinal')
                    $workList[$i][$j] = $ordinal;
                else
                    $workList[$i][$j] = $row[$fields[$j]];
            }

            $writer->writeSheetRow('Лист 1', $workList[$i], $row_options = array('halign'=>'center','valign'=>'center','border'=>'left,right,top,bottom','border-style'=>'thin','wrap_text'=>true,'font'=>'Times New Roman','font-size'=>'12'));

            $i++;
        }
    }
    public  function getOverTenYearsById($id)
    {
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = 'SELECT * FROM spr_OverTenYears WHERE id_specialty=:id_specialty';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id_specialty', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $row=$result->fetch();
        $this->id_specialty = $id;
        $this->specialty = $row['specialty'];
        $this->name = $row['name'];
        $this->id_level_education = $row['id_level_education'];
        $this->id_department = $row['id_department'];
    }
    
    public  function getTotalOverTenYears()
    {
        // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $result = $db->query('SELECT count(id) AS count FROM spr_tools WHERE year_purchase IS NOT NULL AND YEAR(CURRENT_DATE)-year_purchase >=10 AND year_purchase != 0');
        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
 
public  function getOverTenYearsList($page = 1)
    {
        $limit = OverTenYears::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = 'SELECT * FROM spr_tools WHERE year_purchase IS NOT NULL AND YEAR(CURRENT_DATE)-year_purchase >=10 AND year_purchase != 0 ORDER BY id ASC LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $OverTenYearsList = array();
        while ($row = $result->fetch()) {
            $OverTenYearsList[$i]['id'] = $row['id'];
            $OverTenYearsList[$i]['name'] = $row['name'];
            $OverTenYearsList[$i]['year_purchase'] = $row['year_purchase'];
            $OverTenYearsList[$i]['Owner'] = $row['Owner'];
            $i++;
        }
        return $OverTenYearsList;
    }
    public function ExportExcel()
    {
        $db = DataBase::getInstance()->getDb();
        $this->employee = $_POST['employee'];

        $rows = array(
            array('№', 'Наименование', 'Год'),
            array('','','')
        );
        if ($this->employee == 'Все')
        {
            $result = $db->prepare("SELECT id, name, year_purchase FROM spr_tools                   
                       WHERE year_purchase IS NOT NULL AND YEAR(CURRENT_DATE)-year_purchase >=10 AND year_purchase !=0 ORDER BY year_purchase");
        }
        else
        {
            $result = $db->prepare("SELECT id, name, year_purchase FROM spr_tools                   
                       WHERE Owner = :employee AND year_purchase IS NOT NULL AND YEAR(CURRENT_DATE)-year_purchase >=10 AND year_purchase !=0 ORDER BY year_purchase");
            $result->bindParam(':employee', $this->employee);
        }
        
        $result->execute();

        $writer = new XLSXWriter();
        $writer->sendHeader('Оборудование_старше_10_лет(Владелец-'.$this->employee.').xlsx');
        $writer->setAuthor('User');
        $writer->writeSheetHeader('Лист 1', $header_types = array('string','string','string'), $col_options = array('widths'=>[10,40,20]));

        $writer->writeSheetRow('Лист 1', array('Оборудование старше 10 лет','',''), $row_options = array('halign'=>'center','valign'=>'center','font-style'=> 'bold','font'=>'Times New Roman','font-size'=>'14'));

        foreach ($rows as $row)
            $writer->writeSheetRow('Лист 1', $row, $row_options = array('halign'=>'center','valign'=>'center','border'=>'left,right,top,bottom','border-style'=>'thin','wrap_text'=>true,'font'=>'Times New Roman','font-size'=>'12'));

        $this->getWorkExcelList($writer, $result, array('name', 'year_purchase'));

        $writer->markMergedCell('Лист 1', $start_row=1, $start_col=0, $end_row=1, $end_col=2); //

        $writer->markMergedCell('Лист 1', $start_row=2, $start_col=0, $end_row=3, $end_col=0); // Объединение ячеек №
        $writer->markMergedCell('Лист 1', $start_row=2, $start_col=1, $end_row=3, $end_col=1); // Объединение ячеек Специальность
        $writer->markMergedCell('Лист 1', $start_row=2, $start_col=2, $end_row=3, $end_col=2); // Объединение ячеек Специальность
        $writer->writeToStdOut();
    }
   

}
