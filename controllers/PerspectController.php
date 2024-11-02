<?php


class PerspectController extends Controller
{
      private $Perspect;
      

    function __construct()
    {
      parent::__construct();
      $this->Perspect = new Perspect;
      $this->getView()->setTitle('Инструменты');
    }


    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $PerspectList = $this->Perspect->getPerspectList($page);
       $total = $this->Perspect->getTotalPerspect();
       $pagination = new Pagination($total, $page, Perspect::SHOW_BY_DEFAULT, 'page-');
       $this->render('Perspect/list',array('PerspectList'=>$PerspectList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Perspect->deletePerspectById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Perspect->addPerspect();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
    public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Perspect->getPerspectById($id);
        $this->render('Perspect/edit_fill',array('Perspect'=>$this->Perspect));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Perspect->editPerspectById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('Perspect',$this->Perspect->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('Perspect');
      }
     
      header("Location: ./list/page-1");
    }
}
