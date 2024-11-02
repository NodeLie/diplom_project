<?php


class SanPinController extends AdminController
{
  private $SanPin;

  function __construct()
  {
    parent::__construct();
    $this->SanPin = new SanPin;
    $this->getView()->setTitle('СанПин');
  }
    public function actionList($page = 1)
    {
       $SanPinList = $this->SanPin->getSanPinList($page);
       $total = $this->SanPin->getTotalSanPin();
       $pagination = new Pagination($total, $page, SanPin::SHOW_BY_DEFAULT, 'page-');
       $this->render('sanpin/list',array('SanPinList'=>$SanPinList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
         $this->checkPOST('id');
        $id = $_POST['id'];
        $this->SanPin->deleteSanPinById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->SanPin->addSanPin();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
      return true;
    }
    public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->SanPin->getSanPinById($id);
        $this->render('SanPin/edit_fill',array('SanPin'=>$this->SanPin));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->SanPin->editSanPinById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('SanPin',$this->SanPin->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('SanPin');
      }
     
      header("Location: ./list/page-1");
    }
}
