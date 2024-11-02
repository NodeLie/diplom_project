<?php


class TypeVentController extends AdminController
{
  private $TypeVent;

  function __construct()
  {
    parent::__construct();
    $this->TypeVent = new TypeVent;
    $this->getView()->setTitle('Типы вентиляции');
  }
    public function actionList($page = 1)
    {
       $typeVentList = $this->TypeVent->getTypeVentList($page);
       $total = $this->TypeVent->getTotalTypeVent();
       $pagination = new Pagination($total, $page, TypeVent::SHOW_BY_DEFAULT, 'page-');
       $this->render('type_vent/list',array('typeVentList'=>$typeVentList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
         $this->checkPOST('id');
        $id = $_POST['id'];
        $this->TypeVent->deleteTypeVentById($id);
    }
    public function actionAdd()
    {     
      $this->checkPOST('insert');
      $this->TypeVent->addTypeVent();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
    public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->TypeVent->getTypeVentById($id);
        $this->render('type_vent/edit_fill',array('TypeVent'=>$this->TypeVent));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->TypeVent->editTypeVentById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('TypeVent',$this->TypeVent->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('TypeVent');
      }
     
      header("Location: ./list/page-1");
    }
}
