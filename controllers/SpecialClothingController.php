<?php


class SpecialClothingController extends AdminController
{
  private $SpecialClothing;

  function __construct()
  {
    parent::__construct();
    $this->SpecialClothing = new SpecialClothing;
    $this->getView()->setTitle('СпецОдежда');
  }
    public function actionList($page = 1)
    {
       $SpecialClothingList = $this->SpecialClothing->getSpecialClothingList($page);
       $total = $this->SpecialClothing->getTotalSpecialClothing();
       $pagination = new Pagination($total, $page, SpecialClothing::SHOW_BY_DEFAULT, 'page-');
       $this->render('special_clothing/list',array('SpecialClothingList'=>$SpecialClothingList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
         $this->checkPOST('id');
        $id = $_POST['id'];
        $this->SpecialClothing->deleteSpecialClothingById($id);
    }
    public function actionAdd()
    {     
      $this->checkPOST('insert');
      $this->SpecialClothing->addSpecialClothing();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
    public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->SpecialClothing->getSpecialClothingById($id);
        $this->render('special_clothing/edit_fill',array('SpecialClothing'=>$this->SpecialClothing));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->SpecialClothing->editSpecialClothingById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('SpecialClothing',$this->SpecialClothing->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('SpecialClothing');
      }
     
      header("Location: ./list/page-1");
    }
}
