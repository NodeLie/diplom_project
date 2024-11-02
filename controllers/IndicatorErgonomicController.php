<?php

class IndicatorErgonomicController extends AdminController
{
  private $IndicatorErgonomic;

  function __construct()
  {
    parent::__construct();
    $this->IndicatorErgonomic = new IndicatorErgonomic;
    $this->getView()->setTitle('Эргономические показатели');
  }
    public function actionList($page = 1)
    {
       $IndicatorErgonomicList = $this->IndicatorErgonomic->getIndicatorErgonomicList($page);
       $total = $this->IndicatorErgonomic->getTotalIndicatorErgonomic();
       $pagination = new Pagination($total, $page, IndicatorErgonomic::SHOW_BY_DEFAULT, 'page-');
       $this->render('indicator_ergonomic/list',array('IndicatorErgonomicList'=>$IndicatorErgonomicList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
         $this->checkPOST('id');
        $id = $_POST['id'];
        $this->IndicatorErgonomic->deleteIndicatorErgonomicById($id);
    }
    public function actionAdd()
    {     
      $this->checkPOST('insert');
      $this->IndicatorErgonomic->addIndicatorErgonomic();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
    public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->IndicatorErgonomic->getIndicatorErgonomicById($id);
        $this->render('Indicator_Ergonomic/edit_fill',array('IndicatorErgonomic'=>$this->IndicatorErgonomic));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->IndicatorErgonomic->editIndicatorErgonomicById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('IndicatorErgonomic',$this->IndicatorErgonomic->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('IndicatorErgonomic');
      }
     
      header("Location: ./list/page-1");
    }
}
