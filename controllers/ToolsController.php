<?php


class ToolsController extends Controller
{
      private $Tools;
      

    function __construct()
    {
      parent::__construct();
      $this->Tools = new Tools;
      $this->getView()->setTitle('Инструменты');

      if (Auth::getInstance()->compareRules(Auth::INVENT)) // Если пользователь не администратор
      {
        $this->getView()->setLayoutHeader('inventory');
        $this->getView()->setLayoutFooter('inventory');
      } 
      else if (Auth::getInstance()->compareRules(Auth::ADMIN))
      {
        $this->getView()->setLayoutHeader('admin');
        $this->getView()->setLayoutFooter('admin');
      }
      else
      {
        header('Location: /');
        exit;
      }
    }


    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $toolsList = $this->Tools->getToolsList($page);
       $total = $this->Tools->getTotalTools();
       $pagination = new Pagination($total, $page, Tools::SHOW_BY_DEFAULT, 'page-');
       $this->render('tools/list',array('toolsList'=>$toolsList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Tools->deleteToolsById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Tools->addTools();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
    public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Tools->getToolsById($id);
        $this->render('tools/edit_fill',array('Tools'=>$this->Tools));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Tools->editToolsById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('Tools',$this->Tools->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('Tools');
      }
     
      header("Location: ./list/page-1");
    }
}
