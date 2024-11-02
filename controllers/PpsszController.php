<?php


class PpsszController extends AdminController
{
      private $Ppssz;

    function __construct()
    {
      parent::__construct();
      $this->Ppssz = new Ppssz;
      $this->getView()->setTitle('ППССЗ');
    }

    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $ppsszList = $this->Ppssz->getPpsszList($page);
       $total = $this->Ppssz->getTotalPpssz();
       $pagination = new Pagination($total, $page, Ppssz::SHOW_BY_DEFAULT, 'page-');
       $this->render('ppssz/list',array('ppsszList'=>$ppsszList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Ppssz->deletePpsszById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Ppssz->addPpssz();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Ppssz->getPpsszById($id);
        $this->render('ppssz/edit_fill',array('Ppssz'=>$this->Ppssz));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id_specialty');
      $id = $_POST['id_specialty'];
      $this->Ppssz->editPpsszById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('Ppssz',$this->Ppssz->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('Ppssz');
      }
     
      header("Location: ./list/page-1");
    }
}
