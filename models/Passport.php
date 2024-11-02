<?php


class Passport
{

    // Количество отображаемых элементов по умолчанию
    const SHOW_BY_DEFAULT = 50;
    public $id;
    public $id_audience;
    public $id_foundation;
    public $id_ppssz;
    public $id_t_cabinet;
    public $discipline;
    public $number_jobs;
    public $number_special_jobs;
    public $number_protokol;
    public $journal_date;
    public $temp_summer;
    public $temp_winter;
    public $fact_shum;
    public $fact_light_estestvennaya;
    public $fact_light_iskustvennaya;
    public $date_priem;
    public $date;
    public $didactMat;
    public $instr;
    public $tools;
    public $workplace_teacher;
    public $perspect;
    public $wear;
    public $dopWork;
    public  function getPassportById($id)
    {
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = 'SELECT * FROM passport WHERE id=:id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $row=$result->fetch();
        $this->id = $id;
        $this->id_audience = $row['id_audience'];
        $this->id_foundation = $row['id_foundation'];
        $this->discipline = $row['discipline'];
        $this->number_jobs = $row['number_jobs'];
        $this->number_special_jobs = $row['number_special_jobs'];
        $this->number_protokol = $row['number_protokol'];
        $this->journal_date = $row['journal_date'];
        $this->temp_summer = $row['temp_summer'];
        $this->temp_winter = $row['temp_winter'];
        $this->fact_shum = $row['fact_shum'];
        $this->fact_light_iskustvennaya = $row['fact_light_iskustvennaya'];
        $this->fact_light_estestvennaya = $row['fact_light_estestvennaya'];
        $this->date_priem = $row['date_priem'];
        $this->date = $row['date'];

        $sql = 'SELECT * FROM foundation_offices_fgos WHERE id_foundation = :id_foundation';
        $result = $db->prepare($sql);
        $result->bindParam(':id_foundation', $this->id_foundation, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();        
        $row=$result->fetch();
        $this->id_ppssz = $row['id_ppssz'];
        $this->id_t_cabinet = $row['id_t_cabinet'];

        $sql = 'SELECT * FROM passport_didact_mat WHERE id_passport=:id_passport';
        $result = $db->prepare($sql);
        $result->bindParam(':id_passport', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $this->didactMat=$result->fetchall();

        $sql = 'SELECT * FROM passport_dop_work WHERE id_passport=:id_passport';
        $result = $db->prepare($sql);
        $result->bindParam(':id_passport', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $this->dopWork=$result->fetchall();

        $sql = 'SELECT * FROM passport_instr INNER JOIN spr_instr ON id_instr = spr_instr.id WHERE id_passport=:id_passport';
        $result = $db->prepare($sql);
        $result->bindParam(':id_passport', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $this->instr=$result->fetchall();

        $sql = "SELECT * FROM spr_tools WHERE audience=:id_audience AND type_mto !='Мебель'";
        $result = $db->prepare($sql);
        $result->bindParam(':id_audience', $this->id_audience, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $this->tools=$result->fetchall();

        $sql = "SELECT * FROM spr_tools WHERE audience=:id_audience AND type_mto = 'Мебель'";
        $result = $db->prepare($sql);
        $result->bindParam(':id_audience', $this->id_audience, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $this->workplace_teacher=$result->fetchall();

        $sql = "SELECT * FROM passport_perspect WHERE id_passport=:id_passport";
        $result = $db->prepare($sql);
        $result->bindParam(':id_passport', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $this->perspect=$result->fetchall();

        $sql = "SELECT * FROM passport_wear WHERE id_passport=:id_passport";
        $result = $db->prepare($sql);
        $result->bindParam(':id_passport', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $this->wear=$result->fetchall();
    }
    
    public  function getTotalPassport()
    {
        // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql =('SELECT count(passport.id) as count FROM passport INNER JOIN audience_employee ON passport.id_audience = audience_employee.id_audience WHERE id_employee = :id_employee');
        // Возвращаем значение count - количество
        $result = $db->prepare($sql);
        $result->bindValue(':id_employee',$_SESSION['Auth']['id']);
        $result->execute();
        $row = $result->fetch();
        return $row['count'];
    }
 
public  function getPassportList($page = 1,$academic_year)
    {
        $limit = Passport::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = 'SELECT *,passport.id as passport_id FROM passport INNER JOIN audience_employee ON passport.id_audience = audience_employee.id_audience WHERE academic_year = :academic_year'; 
        if ($_SESSION['Auth']['rules'] != 4)
        {
            $sql.= ' AND id_employee = :id_employee ';
        }       
        $sql.= ' ORDER BY date DESC LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        if ($_SESSION['Auth']['rules'] != 4)
        {
            $result->bindValue(':id_employee',$_SESSION['Auth']['id']);
        }
        $result->bindValue(':academic_year',$academic_year);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $PassportList = array();
        while ($row = $result->fetch()) {
            $PassportList[$i]['passport_id'] = $row['passport_id'];
            $PassportList[$i]['id_audience'] = $row['id_audience'];
            $PassportList[$i]['id_foundation'] = $row['id_foundation'];
            $PassportList[$i]['discipline'] = $row['discipline'];
            $i++;
        }
        return $PassportList;
    }
   
    public  function deletePassportById($id)
    {
        // Соединение с БД
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = 'DELETE FROM passport WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id);
        $result->execute();
    
    }
    
    public  function editPassportById($id)
    {
        // Соединение с БД
        $db = DataBase::getInstance()->getDb();
        // Текст запроса к БД
        $sql = 'UPDATE passport
            SET 
                id_foundation = :id_foundation,
                id_audience = :id_audience,            
                discipline = :discipline,
                journal_date = :journal_date,              
                number_protokol = :number_protokol,             
                date_priem = :date_priem';            
         if (!empty($_POST['number_jobs']))
        {
            $sql.=",number_jobs = :number_jobs";
        } 
        if (!empty($_POST['number_special_jobs']))
        {
            $sql.=",number_special_jobs = :number_special_jobs";
        }
        if (!empty($_POST['journal_date']))
        {
            $sql.=",journal_date = :journal_date";
        }
        if (!empty($_POST['temp_winter']))
        {  
            $sql.=",temp_winter = :temp_winter";
        }
        if (!empty($_POST['temp_summer']))
        {
            $sql.=",temp_summer = :temp_summer";
        }
        if (!empty($_POST['fact_shum']))
        {
            $sql.=",fact_shum = :fact_shum";
        }
        if (!empty($_POST['fact_light_estestvennaya']))
        { 
            $sql.=",fact_light_estestvennaya = :fact_light_estestvennaya";
        }
        if (!empty($_POST['fact_light_iskustvennaya']))
        { 
            $sql.=",fact_light_iskustvennaya = :fact_light_iskustvennaya";
        }
        $sql.=' WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id);
        $result->bindValue(':id_foundation', $_POST['id_foundation']);
        $result->bindValue(':id_audience', $_POST['audience']);
        $result->bindValue(':discipline', $_POST['discipline']);
        $result->bindValue(':date_priem', $_POST['date_priem']);    
        $result->bindValue(':journal_date', $_POST['date_statement']); 
        
        if (!empty($_POST['number_jobs']))
        {
            $result->bindValue(':number_jobs', $_POST['number_jobs']);
        } 
        if (!empty($_POST['number_special_jobs']))
        {
            $result->bindValue(':number_special_jobs', $_POST['number_special_jobs']);
        } 
        $result->bindValue(':number_protokol', $_POST['number_protokol']);  
        if (!empty($_POST['journal_date']))
        {
            $result->bindValue(':journal_date', $_POST['journal_date']);
        }
        if (!empty($_POST['temp_winter']))
        {  
            $result->bindValue(':temp_winter', $_POST['temp_winter']);
        }
        if (!empty($_POST['temp_summer']))
        {
            $result->bindValue(':temp_summer', $_POST['temp_summer']);
        }
        if (!empty($_POST['fact_shum']))
        {
            $result->bindValue(':fact_shum', $_POST['fact_shum']); 
        }
        if (!empty($_POST['fact_light_estestvennaya']))
        { 
            $result->bindValue(':fact_light_estestvennaya', $_POST['fact_light_estestvennaya']); 
        }
        if (!empty($_POST['fact_light_iskustvennaya']))
        { 
            $result->bindValue(':fact_light_iskustvennaya', $_POST['fact_light_iskustvennaya']);
        }       
        $result->execute();

        if (isset($_POST['workplace_teacher']))
        {        
            $sql = "UPDATE spr_tools SET
                invent = :invent,
                Count = :Count
                WHERE id = :id AND type_mto = 'Мебель'";
            $result = $db->prepare($sql);       
            foreach ($_POST['workplace_teacher'] as $item)
            {                
                $result->bindValue(':id',$item['id']);
                $result->bindValue(':Count',$item['Count']);
                $result->bindValue(':invent',$item['invent']);
                $result->execute();
            }            
        }

        if (isset($_POST['name_wear']))
        {        
            $sql = "INSERT INTO passport_wear SET
                id_passport = :id_passport,
                name = :name,
                gty = :gty";
            $result = $db->prepare($sql);
            $result->bindValue(':id_passport', $id);
            for ($i=0; $i < count($_POST['name_wear']) ; $i++)
            {
                if (!empty($_POST['name_wear'][$i])||!empty($_POST['gty_wear'][$i]))
                {
                    $result->bindValue(':name', $_POST['name_wear'][$i]);
                    $result->bindValue(':gty', $_POST['gty_wear'][$i]);
                    $result->execute();
                }
                
            }
        }
        if (isset($_POST['name_perspect']))
        {        
            $sql = "INSERT INTO passport_perspect SET
                id_passport = :id_passport,
                name = :name,
                qty = :qty,
                description = :description";
            $result = $db->prepare($sql);
            $result->bindValue(':id_passport', $id);
            for ($i=0; $i < count($_POST['name_perspect']) ; $i++)
            {
                if (!empty($_POST['name_perspect'][$i])||!empty($_POST['qty_perspect'][$i])||!empty($_POST['description_perspect'][$i]))
                {
                    $result->bindValue(':name', $_POST['name_perspect'][$i]);
                    $result->bindValue(':qty', $_POST['qty_perspect'][$i]);
                    $result->bindValue(':description', $_POST['description_perspect'][$i]);
                    $result->execute();
                }
                
            }
        }
        if (isset($_POST['name_dop_work']))
        {        
            $sql = "INSERT INTO passport_dop_work SET
                id_passport = :id_passport,
                name = :name,
                description = :description";
            $result = $db->prepare($sql);
            $result->bindValue(':id_passport', $id);
            for ($i=0; $i < count($_POST['name_dop_work']) ; $i++)
            {
                if (!empty($_POST['name_dop_work'][$i])||!empty($_POST['description_dop_work'][$i]))
                {
                    $result->bindValue(':name', $_POST['name_dop_work'][$i]);
                    $result->bindValue(':description', $_POST['description_dop_work'][$i]);
                    $result->execute();
                }
                
            }
        }
    }

       public function addPassport()
    {
        // Соединение с БД
        $db = DataBase::getInstance()->getDb();
        // Текст запроса к БД
        $sql = 'INSERT INTO passport SET
                id_foundation = :id_foundation,
                id_audience = :id_audience, 
                discipline = :discipline,
                number_protokol = :number_protokol,
                journal_date = :journal_date,
                date_priem = :date_priem,
                academic_year = :academic_year,
                date = CURRENT_DATE()
        ';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindValue(':id_foundation', $_POST['id_foundation']);
        $result->bindValue(':id_audience', $_POST['id_audience']);
        $result->bindValue(':discipline', $_POST['discipline']); 
        $result->bindValue(':number_protokol', $_POST['number_protokol']);    
        $result->bindValue(':date_priem', $_POST['date_priem']);  
        $result->bindValue(':journal_date', $_POST['date_statement']);  
        $result->bindValue(':academic_year', $_SESSION['academic_year']); 
        if ($result->execute())
        {
            $id_passport = $db->lastInsertId();
        }
        else
        { 
            return false;
        }
        if (isset($_POST['name_need_dop_work']))
        {        
            $sql = "INSERT INTO passport_dop_work SET
                id_passport = :id_passport,
                name = :name,
                description = :description";
            $result = $db->prepare($sql);
            $result->bindValue(':id_passport', $id_passport);
            for ($i=0; $i < count($_POST['name_need_dop_work']) ; $i++)
            {
                if (!empty($_POST['name_need_dop_work'][$i])||!empty($_POST['note_need_dop_work'][$i]))
                {
                    $result->bindValue(':name', $_POST['name_need_dop_work'][$i]);
                    $result->bindValue(':description', $_POST['note_need_dop_work'][$i]);
                    $result->execute();
                }
                
            }
        }
        if (isset($_POST['name_need_mto']))
        {  
            $sql = "INSERT INTO passport_perspect SET
                id_passport = :id_passport,
                name = :name,
                qty = :qty,
                description = :description";
            $result = $db->prepare($sql);
            $result->bindValue(':id_passport', $id_passport);
            for ($i=0; $i < count($_POST['name_need_mto']) ; $i++)
            {
                if (!empty($_POST['name_need_mto'][$i]) || !empty($_POST['qty_need_mto'][$i]) || !empty($_POST['th_need_mto'][$i]))
                {
                    $result->bindValue(':name', $_POST['name_need_mto'][$i]);
                    $result->bindValue(':qty', $_POST['qty_need_mto'][$i]);
                    $result->bindValue(':description', $_POST['th_need_mto'][$i]);
                    $result->execute();
                }
                
            }
        }
        if (isset($_POST['id_instr']))
        {
             $sql = "INSERT INTO passport_instr SET
                id_passport = :id_passport,
                id_instr = :id_instr";
            $result = $db->prepare($sql);
            $result->bindValue(':id_passport', $id_passport);
            for ($i=0; $i < count($_POST['id_instr']); $i++)
            { 
                $result->bindValue(':id_instr', $_POST['id_instr'][$i]);
                $result->execute();
            }
        }
    return true; 
    }
    public function LoadFoundation($id_ppssz,$id_t_cabinet)
    {
        $db = DataBase::getInstance()->getDb();
        // Текст запроса к БД
        $sql = "SELECT * FROM foundation_offices_fgos WHERE id_ppssz = :id_ppssz AND id_t_cabinet = :id_t_cabinet";        
        $result = $db->prepare($sql);
        $result->bindValue(':id_ppssz', $id_ppssz);
        $result->bindValue(':id_t_cabinet', $id_t_cabinet);        
        $result->execute();
        $row = $result->fetchall();
        if (count($row)>0)
        {
            foreach ($row as $item)
            {  
                if (isset($Passport->id_foundation))
                {                                
                    if ($item['id_foundation'] == $Passport->id_foundation)
                    {
                        echo "<option value='".$item['id_foundation']."' selected>".$item['name']."</option>"; 
                    } 
                    else echo "<option value='".$item['id_foundation']."'>".$item['name']."</option>";
                } else echo "<option value='".$item['id_foundation']."'>".$item['name']."</option>";        
            }
        }
       // echo "</select>";
    }
    public function LoadAudience($id_foundation)
    {
        $db = DataBase::getInstance()->getDb();
        $sql = "SELECT audience.id as audience, number FROM f_o_fgos_audience INNER JOIN (audience  INNER JOIN audience_employee ON audience.id = audience_employee.id_audience) ON f_o_fgos_audience.id_audience = audience.id WHERE id_foundation = :id_foundation AND id_employee = :id_employee";
        $result = $db->prepare($sql);
        $result->bindValue(':id_foundation', $id_foundation);
        $result->bindValue(':id_employee', $_SESSION['Auth']['id']);
        $result->execute();
        $row = $result->fetchall();   
        if (count($row)>0)
        {
            foreach ($row as $item)
            {
                echo "<option value='".$item['audience']."'>".$item['number']."</option>";
            }
        }
    }
    public function LoadDisciplines($id_foundation)
    {
        $db = DataBase::getInstance()->getDb();
        $sql = "SELECT id, index_discipline, name, year_fgos FROM disciplines WHERE id_foundation = :id_foundation";
        $result = $db->prepare($sql);
        $result->bindValue(':id_foundation', $id_foundation);        
        $result->execute();
        $row = $result->fetchall();
        if (count($row)>0)
        {
            foreach ($row as $item)
            {
                echo "<option value='".$item['id']."'>".$item['index_discipline']." ".$item['name']." ".$item['year_fgos']."</option>";
            }
        }        
    }
    public function LoadInstr($id_foundation)
    {
        $db = DataBase::getInstance()->getDb();
        $sql = "SELECT id_instr,types_instructions,name FROM f_o_fgos_instr INNER JOIN spr_instr ON spr_instr.id = id_instr WHERE id_foundation = :id_foundation";
        $result = $db->prepare($sql);
        $result->bindValue(':id_foundation', $id_foundation);
        $result->execute();
        $row = $result->fetchall();
        echo "<span>Инструкции</span>";
        echo "<select multiple id ='id_instr' name='id_instr[]'>";
        if (count($row)>0)
        {
            foreach ($row as $item)
            {
                echo "<option value='".$item['id_instr']."'>".$item['types_instructions']." | ".$item['name']."</option>";
            }
        }
        echo "</select>";        
    }
    public function ExportToWord($id_passport)
    {        
        $db = DataBase::getInstance()->getDb();

        $sql = "SELECT id_audience, journal_date, number_protokol, discipline, id_t_cabinet, temp_summer, temp_winter, fact_shum, fact_light_estestvennaya, fact_light_iskustvennaya, path_tables, path_electric, id_specialty, passport.number_jobs as passport_number_jobs, passport.number_special_jobs as passport_number_special_jobs, space, address, date, date_priem, responsible, short_name, spr_department.name as department_name, id_department, specialty, spr_ppssz.name as ppssz_name, number, foundation_offices_fgos.name as fgos_name, spr_t_cabinet_fgos.name as fgos_t_name  FROM spr_department INNER JOIN (audience INNER JOIN (passport INNER JOIN (spr_ppssz INNER JOIN (foundation_offices_fgos INNER JOIN spr_t_cabinet_fgos ON id_t_cabinet=spr_t_cabinet_fgos.id) ON id_specialty = id_ppssz) ON foundation_offices_fgos.id_foundation = passport.id_foundation) ON id_audience = audience.id) ON spr_department.id = id_department WHERE passport.id = :id";

        $result = $db->prepare($sql);
        $result->bindValue(':id', $id_passport);
        $result->execute();

        while ($item = $result->fetch())
        {
        $row = array('temp_summer'=>$item['temp_summer'],
        'temp_winter'=>$item['temp_winter'],
        'fact_light_estestvennaya'=>$item['fact_light_estestvennaya'],
        'fact_shum'=>$item['fact_shum'],
        'fact_light_iskustvennaya'=>$item['fact_light_iskustvennaya'],
        'id_specialty'=>$item['id_specialty'],
        'passport_number_jobs'=>$item['passport_number_jobs'],
        'passport_number_special_jobs'=>$item['passport_number_special_jobs'],
        'space'=>$item['space'],
        'path_tables'=>$item['path_tables'],
        'path_electric'=>$item['path_electric'],
        'address'=>$item['address'],
        'date'=>$item['date'],
        'date_priem'=>$item['date_priem'],
        'responsible'=>$item['responsible'],
        'short_name'=>$item['short_name'],
        'fgos_name'=>$item['fgos_name'],
        'fgos_t_name'=>$item['fgos_t_name'],
        'department_name'=>$item['department_name'],
        'id_department'=>$item['id_department'],
        'specialty'=>$item['specialty'],
        'ppssz_name'=>$item['ppssz_name'],
        'number'=>$item['number'],
        'id_t_cabinet'=>$item['id_t_cabinet'],
        'discipline'=>$item['discipline'],
        'number_protokol'=>$item['number_protokol'],
        'id_audience'=>$item['id_audience'],
        'journal_date'=>$item['journal_date']
        );
        }       

        $PHPWord = new \PhpOffice\PhpWord\PhpWord();

        $styleFont = array('bold' => false, 'size' => 10, 'name' => 'Times new roman');
        // New portrait section
        $section = $PHPWord->createSection(array('pageNumberingStart' => 1));
        $settings = $section->getSettings();
        $settings->setMarginLeft(850);
        $settings->setMarginBottom(850);
        $settings->setMarginRight(567);
        $settings->setMarginTop(850);
        $settings->setPageSizeH(11905.511811024);
        $settings->setPageSizeW(8503.937007874);


        $PHPWord->addFontStyle('rStyle', array('bold' => false, 'size' => 10, 'name' => 'Times new roman'));
        $PHPWord->addParagraphStyle('pStyle', array('align' => 'center', 'spaceBefore' => '0', 'spaceAfter' => '0'));

        $footer = $section->createFooter();
        $footer->addPreserveText('{PAGE}', array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'center'));

        // Add text elements
        $section->addText("Министерство образования и науки Российской Федерации", 'rStyle', 'pStyle');
        $section->addText("Федеральное государственное бюджетное образовательное учреждение", 'rStyle', 'pStyle');
        $section->addText("высшего образования", 'rStyle', 'pStyle');
        $section->addText("«Магнитогорский государственный технический университет", 'rStyle', 'pStyle');
        $section->addText("им. Г.И.Носова»", 'rStyle', 'pStyle');
        $section->addText("Многопрофильный колледж", 'rStyle', 'pStyle');
        $section->addTextBreak(2);

        $table = $section->addTable();
        $table->addRow();
        $table->addCell(3500);
        $cell = $table->addCell(3500);
        $cell->addText("Утверждено:", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
        $cell->addText("Директор", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
        $year = date("Y");

        $cell->addText("__________/С.А.Махновский", 'rStyle', array('spaceBefore' => '50', 'spaceAfter' => '50'));
        $cell->addText("\"__ \"_________$year г.", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
        $section->addTextBreak(2);
        $section->addText("ПАСПОРТ", array('bold' => true, 'size' => 12, 'name' => 'Times new roman'), 'pStyle');
        $section->addText($row['fgos_t_name']." ".$row['fgos_name']." ".$row['number'], array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), 'pStyle');
        $section->addTextBreak(2);
        $section->addText("Специальность $row[specialty] $row[ppssz_name]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $section->addText("Отделение №$row[id_department] $row[department_name]", 'rStyle');
        $section->addTextBreak(3);
        $date = date('Y');
        $section->addText("Магнитогорск, $date", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'center'));
        $section->addPageBreak();

        $table = $section->addTable();
        $table->addRow();
        $cell = $table->addCell(3500);
        $cell->addText("Согласовано:", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));

        if ($row['id_t_cabinet'] == 6 or $row['id_t_cabinet'] == 3) {
            $cell->addText("Заместитель директора по УПР", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
            $year = date("Y");
            $cell->addText("_____________/О.Н.Загора", 'rStyle', array('spaceBefore' => '50', 'spaceAfter' => '50'));
            $cell->addText("\"__ \"_________$year г.", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
        } else {
            $cell->addText("Заместитель директора по УМР", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
            $year = date("Y");
            $cell->addText("_____________/Ю.В.Федосеева", 'rStyle', array('spaceBefore' => '50', 'spaceAfter' => '50'));
            $cell->addText("\"__ \"_________$year г.", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '50'));
        }

        $section->addTextBreak();
        $section->addText("Заведующий УЛК", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
        $section->addText("_____________/О.А.Турбина", 'rStyle', array('spaceBefore' => '50', 'spaceAfter' => '50'));
        $section->addText("\"__ \"_________$year г.", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
        $section->addTextBreak();
        $section->addText("Заведующий отделением", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
        $section->addText("_____________/$row[short_name]", 'rStyle', array('spaceBefore' => '50', 'spaceAfter' => '50'));
        $section->addText("\"__ \"_________$year г.", 'rStyle', array('spaceBefore' => '0', 'spaceAfter' => '0'));
        $section->addTextBreak();
        $section->addText("Ответственный: _____________/$row[responsible]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));

        /*if($FIO_zapolnyaushego != '' AND $FIO_zapolnyaushego != 'Админ Администратор '){

            $section->addTextBreak();
        $section->addText("Заполняющий: _____________/$FIO_zapolnyaushego", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
            $section->addPageBreak();
        }else{
            $section->addPageBreak();
        }*/
        $section->addPageBreak();
        $section->addText("1. Общие сведения", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $section->addText("Расположение: $row[address], $row[number]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
        $passport_date = strtotime($row['date']);
        $passport_date = date('d-m-Y', $passport_date);
        $section->addText("Дата выдачи паспорта: $passport_date", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $section->addText("Характеристика: ", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
        $section->addText("Площадь: $row[space] кв.м", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
        $section->addText("Количество учебных мест: $row[passport_number_jobs]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
        $section->addText("Количество рабочих мест: $row[passport_number_special_jobs]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
        $section->addPageBreak();
        $section->addText("2. Программно-методическое обеспечение", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

        $section->addText("2.1. Компетенции", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $section->addText("Профессиональные компетенции:", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $result = $db->query("SELECT * FROM disciplines_pk INNER JOIN spr_pk ON id_pk = spr_pk.id WHERE id_disciplines=".$row['discipline']." ORDER BY short_name"); 
        $discipline_pk=$result->fetchall();
            foreach ($discipline_pk as $item)
            {
                $section->addText(" $item[short_name] $item[description]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));                
            }

        $section->addTextBreak(1);
        $section->addText("Общие компетенции:", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $result = $db->query("SELECT * FROM spr_ok WHERE id_ppssz='$row[id_specialty]' ORDER BY short_name");
        
        while ($spr_ok = $result->fetch())
        {
            $section->addText("$spr_ok[short_name] $spr_ok[description]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
        }
        $section->addPageBreak();
        /*$sql_spr_pk = "SELECT * FROM spr_pk WHERE id_ppssz='$data[spr_ppssz]'";
        $result_spr_pk = mysql_query($sql_spr_pk);
        while ($data_spr_pk = mysql_fetch_array($result_spr_pk)) {
            $section->addText("$data_spr_pk[short_name] $data_spr_pk[description]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
        }
        $section->addPageBreak();*/
        $section->addText("2.2. Программы профессиональных модулей, дисциплин и практик", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $table_disciplines = $section->addTable(array('cantSplit' => 'true'));
        $table_disciplines->addRow(100, array('borderTopColor' => '000000', 'borderSize' => '5'));
        $table_disciplines->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("№ п/п", 'rStyle', array('align' => 'center'));
        $table_disciplines->addCell(7800, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Наименование", 'rStyle', array('align' => 'center'));
        $table_disciplines->addCell(2300, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("№ протокола и дата утверждения", 'rStyle', array('align' => 'center'));

       // $sql_passport_disciplines = "SELECT * FROM passport_disciplines WHERE id_passport='$data[id]'";
        //$result_passport_disciplines = mysql_query($sql_passport_disciplines);

            $result = $db->query("SELECT * FROM disciplines WHERE id='$row[discipline]'");
            $discipline = $result->fetch();
            $i=1;
            $table_disciplines->addRow(100, array('borderTopColor' => '000000', 'borderSize' => '5'));
            $table_disciplines->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText($i, 'rStyle');
            $table_disciplines->addCell(7800, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText($discipline['index_discipline'] . " " . $discipline['name'], 'rStyle');
            $table_disciplines->addCell(2300, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText($row['number_protokol'], 'rStyle');
        
        $result = $db->query("SELECT * FROM passport_didact_mat WHERE id_passport='$id_passport'");
        $data_passport_didact_mat = $result->fetchall();

        if (!empty($data_passport_didact_mat)) {
            $section->addText("2.3. Перечень дидактических материалов", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

            $table_disciplines = $section->addTable();

            $table_disciplines->addRow(100);
            $table_disciplines->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("№ п/п", 'rStyle', array('align' => 'center'));
            $table_disciplines->addCell(7800, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Наименование", 'rStyle', array('align' => 'center'));
            $table_disciplines->addCell(2300, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Количество", 'rStyle', array('align' => 'center'));

            $i = 1;
            foreach ($data_passport_didact_mat as $item) {
                $table_disciplines->addRow(100, array('borderTopColor' => '000000', 'borderSize' => '5'));
                $table_disciplines->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText($i, 'rStyle');
                $table_disciplines->addCell(7800, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText($item['didact_mat'], 'rStyle');
                $table_disciplines->addCell(2300, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText($item['didact_mat_gty'], 'rStyle');
                $i++;
            }
        }

        $section->addPageBreak();
        $section->addText("3. Организационная оснащенность", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $result = $db->query("SELECT * FROM passport_instr INNER JOIN spr_instr ON id_instr = spr_instr.id WHERE id_passport=$id_passport");
        $passport_instr = $result->fetchall();
       
            $section->addText("3.1. Инструкции по ТБ, ОТ, ПБ и ОТ при проведении лабораторно/практических работ:", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));


            $i = 1;
            foreach ($passport_instr as $item)
            {                
                $section->addText("$i" . ". " . "$item[name]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left', 'spaceAfter' => '0'));
                $i++;
            }
            $section->addTextBreak(1); 

        if ($row['journal_date'] != "") {
            $journal_date = date("d-m-Y", strtotime($row['journal_date']));
            $section->addText("3.2. Журнал регистрации инструктажей на рабочем месте", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
            $section->addText("Журнал ТБ и ОТ ведется с $journal_date", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'));
        }

        $section->addPageBreak();
        $section->addText("4. Материально-техническое оснащение", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));


        $table = $section->addTable(array('borderTopColor' => '000000', 'borderSize' => '5', 'tblHeader' => true));

        $table->addRow(null, array('tblHeader' => true));
        $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("№ п/п", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Наименование", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Инвентаризационный номер", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Количество", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Год", 'rStyle', array('align' => 'center', 'spacing' => 0));

        $result = $db->query("SELECT * FROM spr_tools WHERE audience='$row[id_audience]' AND type_mto='ПК'");
        $mto = $result->fetchall();
        if (!empty($mto))
        {
            $table->addRow();
            $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'));
            $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Персональные компьютеры:", 'rStyle');

            $i = 1;
            foreach ($mto as $item) 
            {
                $table->addRow();
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$i", 'rStyle');
                $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[name]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[invent]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[Count]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[year_purchase]", 'rStyle');
                $i++;
            }
        }      
        $result = $db->query("SELECT * FROM spr_tools WHERE audience='$row[id_audience]' AND type_mto='ПО'");
        $mto = $result->fetchall();
        if (!empty($mto))
        {
            $table->addRow();
            $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'));
            $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Программные средства:", 'rStyle');

            $i = 1;
            foreach ($mto as $item) 
            {
                $table->addRow();
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$i", 'rStyle');
                $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[name]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[invent]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[Count]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[year_purchase]", 'rStyle');
                $i++;
            }
        }        
        $result = $db->query("SELECT * FROM spr_tools WHERE audience='$row[id_audience]' AND (type_mto='Инструменты' OR type_mto='Электрооборудование')");
        $mto = $result->fetchall();
        if (!empty($mto))
        {
            $table->addRow();
            $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'));
            $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Оборудование и инструменты:", 'rStyle');

            $i = 1;
            foreach ($mto as $item) 
            {
                $table->addRow();
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$i", 'rStyle');
                $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[name]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[invent]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[Count]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[year_purchase]", 'rStyle');
                $i++;
            }
        }
        $result = $db->query("SELECT * FROM spr_tools WHERE audience='$row[id_audience]' AND (type_mto='Стенд' OR type_mto='Плакат')");
        $mto = $result->fetchall();
        if (!empty($mto))
        {
            $table->addRow();
            $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'));
            $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Дидактические средства: электронные плакаты, макеты и прочее", 'rStyle');

            $i = 1;
            foreach ($mto as $item) 
            {
                $table->addRow();
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$i", 'rStyle');
                $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[name]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[invent]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[Count]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[year_purchase]", 'rStyle');
                $i++;
            }
        }
        $result = $db->query("SELECT * FROM spr_tools WHERE audience='$row[id_audience]' AND type_mto='Мебель'");
        $mto = $result->fetchall();
        if (!empty($mto))
        {
            $table->addRow();
            $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'));
            $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Имущество:", 'rStyle');

            $i = 1;
            foreach ($mto as $item) 
            {
                $table->addRow();
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$i", 'rStyle');
                $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[name]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[invent]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[Count]", 'rStyle');
                $table->addCell(500, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[year_purchase]", 'rStyle');
                $i++;
            }
        }        

        $result = $db->query("SELECT * FROM passport_dop_work WHERE id_passport=$id_passport");
        $passport_dop_work = $result->fetchall();

        $result = $db->query("SELECT * FROM passport_perspect WHERE id_passport=$id_passport");
        $passport_perspect = $result->fetchall();
        if (!empty($passport_dop_work) or !empty($passport_perspect)) {

            $section->addPageBreak();
            $section->addText("5. Перспективы развития", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

            if (!empty($passport_perspect)) {

                $section->addText("5.1. Требуемое материально-техническое оснащение", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));


                $table = $section->addTable();
                $table->addRow();
                $table->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("№ п/п", 'rStyle', array('align' => 'center', 'spacing' => 0));
                $table->addCell(4000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Оборудование, инструменты, программное обеспечение (+ссылка на объект в Интернете)", 'rStyle', array('align' => 'center', 'spacing' => 0));
                $table->addCell(3000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Технические характеристики", 'rStyle', array('align' => 'center', 'spacing' => 0));
                $table->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Количество", 'rStyle', array('align' => 'center', 'spacing' => 0));


                $i = 1;
                foreach ($passport_perspect as $item) {
                    $table->addRow();

                    $table->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$i", 'rStyle');
                    $table->addCell(4000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[name]", 'rStyle');
                    $table->addCell(4000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[description]", 'rStyle');
                    $table->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[qty]", 'rStyle');

                    $i++;
                }
            }

            if (!empty($passport_dop_work)) {
                $section->addText("5.2. Виды деятельности", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

                $table = $section->addTable();
                $table->addRow();
                $table->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("№ п/п", 'rStyle', array('align' => 'center', 'spacing' => 0));
                $table->addCell(5000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Вид деятельности", 'rStyle', array('align' => 'center', 'spacing' => 0));
                $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Примечание", 'rStyle', array('align' => 'center', 'spacing' => 0));

                $i = 1;
                foreach ($passport_perspect as $item) {
                    $table->addRow();

                    $table->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$i", 'rStyle');
                    $table->addCell(5000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[name]", 'rStyle');
                    $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[description]", 'rStyle');

                    $i++;
                }
            }
        }

        $section->addPageBreak();
        if($row['path_tables'] != '')
        {
        $section->addText("6. План размещения оборудования", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $section->addImage('web/images/'.$row['path_tables'],
            array(
                'width' => 415,
                'height' => 226
            ));
        }
        if($row['path_electric'] != '') {
            $section->addText("7. Схема подключения электрооборудования", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

            $section->addImage('web/images/'.$row['path_electric'],
                array(
                    'width' => 415,
                    'height' => 226
                ));
            $section->addPageBreak();
        }



        $section->addText("8. Организационно-эргономический уровень рабочих мест", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $section->addText("8.1. Соответствие площади технологическим нормам", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

        $table = $section->addTable();
        $table->addRow();

        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Площадь помещения, кв.м", 'rStyle', array('align' => 'center', 'spacing' => 0));
        if ($row['id_t_cabinet'] != 3) {
            $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Количество учебных мест", 'rStyle', array('align' => 'center', 'spacing' => 0));
            $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Площадь одного учебного места, кв. м", 'rStyle', array('align' => 'center', 'spacing' => 0));
        } else {
            $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Количество рабочих мест", 'rStyle', array('align' => 'center', 'spacing' => 0));
            $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Площадь одного рабочего места, кв. м", 'rStyle', array('align' => 'center', 'spacing' => 0));
        }
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Площадь места преподавателя, кв. м", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Нормативный показатель площади, кв. м", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Вывод", 'rStyle', array('align' => 'center', 'spacing' => 0));

        $norma = 3.4;
        if (!empty($row['passport_number_jobs']))
        {
            $ploshad = round($row['space'] / $row['passport_number_jobs'], 2);
            
            if ($ploshad >= $norma) {
                $result_ploshad = "Соответствует";
            } else {
                $result_ploshad = "Не соответствует";
            }        
        }
        else
        {
            $ploshad = 0;
            $result_ploshad = "Не соответствует";
        }

        $table->addRow();
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$row[space]", 'rStyle');
        if ($row['id_t_cabinet'] != 3) {
            $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$row[passport_number_jobs]", 'rStyle');
        } else {
            $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$row[passport_number_special_jobs]", 'rStyle');
        }
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$ploshad", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("4.5", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$norma", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$result_ploshad", 'rStyle');
        $section->addTextBreak();

        $section->addText("8.2. Температурный режим", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Допустимая температура, град.С (СанПиН 2.4.2.1178-02)", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Фактическая температура в летний период, град.С", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Фактическая температура в зимний период, град.С", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Вывод", 'rStyle', array('align' => 'center', 'spacing' => 0));
        if ($row['id_t_cabinet'] >= 3) {
                $mintemp = 16;
                $maxtemp = 20;
            } else {
                $mintemp = 18;
                $maxtemp = 22;
            }
        if ($row['temp_summer'] < $mintemp or $data['temp_winter'] < $mintemp or $data['temp_summer'] > $maxtemp or $data[temp_winter] > $maxtemp) {
            $result_temp = "Не соответствует";
        } else {
            $result_temp = "Соответствует";
        }
        $table->addRow();
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$mintemp-$maxtemp", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$row[temp_summer]", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$row[temp_winter]", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$result_temp", 'rStyle');
        $section->addTextBreak();

        $section->addText("8.3. Уровень шума", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Допустимый уровень шума, ДБ (СанПиН 2.4.3.1186-03)", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Фактический уровень шума, ДБ", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Вывод", 'rStyle', array('align' => 'center', 'spacing' => 0));

        $norma_shum = 80;
        if (!empty($row['fact_shum']))
        {       
            if ($row['fact_shum'] > $norma_shum) {
                $result_shum = "Не соответствует";
            } else {
                $result_shum = "Соответствует";
            } 
        }
        else
        {
            $row['fact_shum'] = 'нет значения';
            $result_shum = "Не соответствует";
        }
        $table->addRow();
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$norma_shum", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$row[fact_shum]", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$result_shum", 'rStyle');

        $section->addPageBreak();

        $section->addText("8.4. Уровень освещенности", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));

        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Вид освещенности
        (СанПиН 2.4.3.1186-03)", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Норма освещенности
        (СанПиН 2.4.3.1186-03)", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Фактическая освещенность", 'rStyle', array('align' => 'center', 'spacing' => 0));
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Вывод", 'rStyle', array('align' => 'center', 'spacing' => 0));

        if ($row['id_t_cabinet'] >= 3)
        {
            $norma_estestvennaya = 1;
        }
        else 
        {
            $norma_estestvennaya = 1.5;
        }

         if ($row['id_t_cabinet'] >= 3) {

                    $norma_iskustvennaya = 300;
                } else {
                    $norma_iskustvennaya = 500;
                }

        if (!empty($row['fact_light_estestvennaya']) or !empty($row['fact_light_iskustvennaya'])) {
                
            if ($row['fact_light_estestvennaya'] < $norma_estestvennaya) {
                $result_light_est = "Не соответствует";
            } else {
                $result_light_est = "Соответствует";
            }
            if ($row['fact_light_iskustvennaya'] < $norma_iskustvennaya) {
                $result_light_isk = "Не соответствует";
            } else {
                $result_light_isk = "Соответствует";
            }
        }
        else
        {
            $row['fact_light_estestvennaya'] = 0;
            $row['fact_light_iskustvennaya'] = 0;
            $result_light_est = "Не соответствует";
            $result_light_isk = "Не соответствует";
        }  
        $table->addRow();
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Естественная, КЕО(%)", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$norma_estestvennaya", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$row[fact_light_estestvennaya]", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$result_light_est", 'rStyle');

        $table->addRow();
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Искусственная, люкс", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$norma_iskustvennaya", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$row[fact_light_iskustvennaya]", 'rStyle');
        $table->addCell(2000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$result_light_isk", 'rStyle');
        $section->addTextBreak();

        $result =$db->query("SELECT * FROM passport_wear WHERE id_passport=$id_passport");
        $passport_wear = $result->fetchall();

        if (!empty($result)) {
            $section->addText("8.5. Обеспечение спец. одеждой и индивидуальными защитными средствами", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
            
                $table = $section->addTable();
                $table->addRow();
                $table->addCell(6000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Наименование спец. одежды и индивидуальных защитных средств", 'rStyle', array('align' => 'center', 'spacing' => 0));
                $table->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("Обеспеченность (%, шт.)", 'rStyle', array('align' => 'center', 'spacing' => 0));

                $i = 1;
                foreach ($passport_wear as $item) {
                    $table->addRow();

                    $table->addCell(6000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[name]", 'rStyle');
                    $table->addCell(1000, array('borderTopColor' => '000000', 'borderSize' => '5'))->addText("$item[gty]", 'rStyle');

                    $i++;
                }            
            $section->addTextBreak();
        }


        $section->addText("9. Дата приемки", array('bold' => true, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));
        $section->addText("акт от $row[date_priem]", array('bold' => false, 'size' => 10, 'name' => 'Times new roman'), array('align' => 'left'));



        // Save File
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007');
        $today = date("YmdHis");
        $filename = $row['number'] . '_' . $row['specialty'].'_'.$row['fgos_t_name'].'_'.$today;
        $objWriter->save('passports/' . $this->str2url($filename) . '.docx','Word2007',true);
        

        
    }
    public function rus2translit($string)
        {
            $converter = array(
                'а' => 'a', 'б' => 'b', 'в' => 'v',
                'г' => 'g', 'д' => 'd', 'е' => 'e',
                'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
                'и' => 'i', 'й' => 'y', 'к' => 'k',
                'л' => 'l', 'м' => 'm', 'н' => 'n',
                'о' => 'o', 'п' => 'p', 'р' => 'r',
                'с' => 's', 'т' => 't', 'у' => 'u',
                'ф' => 'f', 'х' => 'h', 'ц' => 'c',
                'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
                'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
                'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

                'А' => 'A', 'Б' => 'B', 'В' => 'V',
                'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
                'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
                'И' => 'I', 'Й' => 'Y', 'К' => 'K',
                'Л' => 'L', 'М' => 'M', 'Н' => 'N',
                'О' => 'O', 'П' => 'P', 'Р' => 'R',
                'С' => 'S', 'Т' => 'T', 'У' => 'U',
                'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
                'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
                'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
                'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            );
            return strtr($string, $converter);
        }
    public function str2url($str)
        {
            // переводим в транслит
            $str = $this->rus2translit($str);
            // в нижний регистр
            $str = strtolower($str);
            // заменям все ненужное нам на "-"
            $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
            // удаляем начальные и конечные '-'
            $str = trim($str, "-");
            return $str;
        }
}
