<?php


class ReadDisciplinesController extends AdminController
{
      private $ReadDisciplines;

    function __construct()
    {
      parent::__construct();
      $this->ReadDisciplines = new ReadDisciplines;
      $this->getView()->setTitle('Читаемые дисциплины');
    }

    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $ReadDisciplinesList = $this->ReadDisciplines->getReadDisciplinesList($page);
       $total = $this->ReadDisciplines->getTotalReadDisciplines();
       $pagination = new Pagination($total, $page, ReadDisciplines::SHOW_BY_DEFAULT, 'page-');
       $this->render('read_disciplines/list',array('ReadDisciplinesList'=>$ReadDisciplinesList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->ReadDisciplines->deleteReadDisciplinesById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->ReadDisciplines->addReadDisciplines();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->ReadDisciplines->getReadDisciplinesById($id);
        $this->render('Read_Disciplines/edit_fill',array('ReadDisciplines'=>$this->ReadDisciplines));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->ReadDisciplines->editReadDisciplinesById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('ReadDisciplines',$this->ReadDisciplines->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('ReadDisciplines');
      }
     
      header("Location: ./list/page-1");
    }
}
