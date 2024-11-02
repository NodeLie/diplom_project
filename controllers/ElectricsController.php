<?php

class ElectricsController extends AdminController
{
      private $Electrics;

    function __construct()
    {
      parent::__construct();
      $this->Electrics = new Electrics;
      $this->getView()->setTitle('Электрооборудование');
    }

    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $ElectricsList = $this->Electrics->getElectricsList($page);
       $total = $this->Electrics->getTotalElectrics();
       $pagination = new Pagination($total, $page, Electrics::SHOW_BY_DEFAULT, 'page-');
       $this->render('electrics/list',array('electricsList'=>$ElectricsList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Electrics->deleteElectricsById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Electrics->addElectrics();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Electrics->getElectricsById($id);
        $this->render('electrics/edit_fill',array('Electrics'=>$this->Electrics));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Electrics->editElectricsById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('electrics',$this->Electrics->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('electrics');
      }
     
      header("Location: ./list/page-1");
    }
}
