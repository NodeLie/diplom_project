<?php


class PkController extends AdminController
{
      private $Pk;

    function __construct()
    {
      parent::__construct();
      $this->Pk = new Pk;
      $this->getView()->setTitle('Профессиональные компетенции');
    }

    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $pkList = $this->Pk->getPkList($page);
       $total = $this->Pk->getTotalPk();
       $pagination = new Pagination($total, $page, Pk::SHOW_BY_DEFAULT, 'page-');
       $this->render('pk/list',array('pkList'=>$pkList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Pk->deletePkById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Pk->addPk();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Pk->getPkById($id);
        $this->render('pk/edit_fill',array('Pk'=>$this->Pk));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Pk->editPkById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('Pk',$this->Pk->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('Pk');
      }
     
      header("Location: ./list/page-1");
    }
}
