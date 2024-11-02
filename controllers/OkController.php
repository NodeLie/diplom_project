<?php

class OkController extends AdminController
{
      private $Ok;

    function __construct()
    {
      parent::__construct();
      $this->Ok = new Ok;
      $this->getView()->setTitle('Общие компетенции');
    }


    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $OkList = $this->Ok->getOkList($page);
       $total = $this->Ok->getTotalOk();
       $pagination = new Pagination($total, $page, Ok::SHOW_BY_DEFAULT, 'page-');
       $this->render('ok/list',array('OkList'=>$OkList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Ok->deleteOkById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Ok->addOk();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Ok->getOkById($id);
        $this->render('Ok/edit_fill',array('Ok'=>$this->Ok));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Ok->editOkById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('Ok',$this->Ok->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('Ok');
      }
     
      header("Location: ./list/page-1");
    }
}
