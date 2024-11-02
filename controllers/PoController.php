<?php


class PoController extends AdminController
{
      private $Po;

    function __construct()
    {
      parent::__construct();
      $this->Po = new Po;
      $this->getView()->setTitle('Справочник ПО');
    }

    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $poList = $this->Po->getPoList($page);
       $total = $this->Po->getTotalPo();
       $pagination = new Pagination($total, $page, Po::SHOW_BY_DEFAULT, 'page-');
       $this->render('po/list',array('poList'=>$poList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Po->deletePoById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Po->addPo();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Po->getPoById($id);
        $this->render('Po/edit_fill',array('Po'=>$this->Po));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Po->editPoById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('Po',$this->Po->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('Po');
      }
     
      header("Location: ./list/page-1");
    }
}
