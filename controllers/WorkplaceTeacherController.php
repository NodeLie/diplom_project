<?php

/**
 * Контроллер ProductController
 * Товар
 */
class WorkplaceTeacherController extends AdminController
{
      private $WorkplaceTeacher;

    function __construct()
    {
      parent::__construct();
      $this->WorkplaceTeacher = new WorkplaceTeacher;
      $this->getView()->setTitle('Рабочее место преподавателя');
    }


    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $WorkplaceTeacherList = $this->WorkplaceTeacher->getWorkplaceTeacherList($page);
       $total = $this->WorkplaceTeacher->getTotalWorkplaceTeacher();
       $pagination = new Pagination($total, $page, WorkplaceTeacher::SHOW_BY_DEFAULT, 'page-');
       $this->render('workplace_teacher/list',array('WorkplaceTeacherList'=>$WorkplaceTeacherList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->WorkplaceTeacher->deleteWorkplaceTeacherById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->WorkplaceTeacher->addWorkplaceTeacher();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id))
      {
        $this->WorkplaceTeacher->getWorkplaceTeacherById($id);
        $this->render('workplace_teacher/edit_fill',array('WorkplaceTeacher'=>$this->WorkplaceTeacher));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->WorkplaceTeacher->editWorkplaceTeacherById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('WorkplaceTeacher',$this->WorkplaceTeacher->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('WorkplaceTeacher');
      }
     
      header("Location: ./list/page-1");
    }
}
