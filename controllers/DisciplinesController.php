<?php

class DisciplinesController extends AdminController
{
      private $Disciplines;

    function __construct()
    {
      parent::__construct();
      $this->Disciplines = new Disciplines;
      $this->getView()->setTitle('Дисциплины');
    }

    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $DisciplinesList = $this->Disciplines->getDisciplinesList($page);
       $total = $this->Disciplines->getTotalDisciplines();
       $pagination = new Pagination($total, $page, Disciplines::SHOW_BY_DEFAULT, 'page-');
       $this->render('disciplines/list',array('DisciplinesList'=>$DisciplinesList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Disciplines->deleteDisciplinesById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Disciplines->addDisciplines();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id))
      {
        $this->Disciplines->getDisciplinesById($id);
        $this->render('Disciplines/edit_fill',array('Disciplines'=>$this->Disciplines));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Disciplines->editDisciplinesById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('disciplines',$this->Disciplines->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('disciplines');
      }
     
      header("Location: ./list/page-1");
    }
}
