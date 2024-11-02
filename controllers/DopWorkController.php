<?php


class DopWorkController extends Controller
{
      private $DopWork;
      

    function __construct()
    {
      parent::__construct();
      $this->DopWork = new DopWork;
      $this->getView()->setTitle('Инструменты');
    }


    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $DopWorkList = $this->DopWork->getDopWorkList($page);
       $total = $this->DopWork->getTotalDopWork();
       $pagination = new Pagination($total, $page, DopWork::SHOW_BY_DEFAULT, 'page-');
       $this->render('DopWork/list',array('DopWorkList'=>$DopWorkList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->DopWork->deleteDopWorkById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->DopWork->addDopWork();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
    public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->DopWork->getDopWorkById($id);
        $this->render('DopWork/edit_fill',array('DopWork'=>$this->DopWork));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->DopWork->editDopWorkById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('DopWork',$this->DopWork->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('DopWork');
      }
     
      header("Location: ./list/page-1");
    }
}
