<?php

class TypeMtoController extends Controller
{
  private $TypeMto;

  function __construct()
  {
    parent::__construct();
    $this->TypeMto = new TypeMto;
    $this->getView()->setTitle('Типы МТО');
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
       $typeMtoList = $this->TypeMto->getTypeMtoList($page);
       $total = $this->TypeMto->getTotalTypeMto();
       $pagination = new Pagination($total, $page, TypeMto::SHOW_BY_DEFAULT, 'page-');
       $this->render('type_mto/list',array('typeMtoList'=>$typeMtoList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
         $this->checkPOST('id');
        $id = $_POST['id'];
        $this->TypeMto->deleteTypeMtoById($id);
    }
    public function actionAdd()
    {     
      $this->checkPOST('insert');
      $this->TypeMto->addTypeMto();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
    public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->TypeMto->getTypeMtoById($id);
        $this->render('type_mto/edit_fill',array('TypeMto'=>$this->TypeMto));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->TypeMto->editTypeMtoById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('TypeMto',$this->TypeMto->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('TypeMto');
      }     
      header("Location: ./list/page-1");
    }
}
