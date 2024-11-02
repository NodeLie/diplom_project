<?php

class VentilationController extends AdminController
{
  private $Ventilation;

  function __construct()
  {
    parent::__construct();
    $this->Ventilation = new Ventilation;
    $this->getView()->setTitle('Воздухообмен');
  }
  public function actionList($page = 1)
  {
    $VentilationList = $this->Ventilation->getVentilationList($page);
    $total = $this->Ventilation->getTotalVentilation();
    $pagination = new Pagination($total, $page, Ventilation::SHOW_BY_DEFAULT, 'page-');
    $this->render('ventilation/list',array('VentilationList'=>$VentilationList,'pagination'=>$pagination));
  }
  public function actionDelete()
  {
    $this->checkPOST('id');
    $id = $_POST['id'];
    $this->Ventilation->deleteVentilationById($id);
  }
  public function actionAdd()
  {     
    $this->checkPOST('insert');
    $this->Ventilation->addVentilation();    
    $referrer = $_SERVER['HTTP_REFERER'];
    header("Location: $referrer");
  }
  public function actionEditFill($id)
  {
    if (isset($id))
    {
      $this->Ventilation->getVentilationById($id);
      $this->render('Ventilation/edit_fill',array('Ventilation'=>$this->Ventilation));
    }
  }
  public function actionEditExec()
  {
    $this->checkPOST('id');
    $id = $_POST['id'];
    $this->Ventilation->editVentilationById($id);
    header("Location: ./list/page-1");
  }
  public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('Ventilation',$this->Ventilation->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('Ventilation');
      }
     
      header("Location: ./list/page-1");
    }
}
