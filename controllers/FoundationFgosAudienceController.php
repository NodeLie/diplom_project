<?php

class FoundationFgosAudienceController extends AdminController
{
  private $FoundationFgosAudience; 

  function __construct()
  {
    parent::__construct();
    $this->FoundationFgosAudience = new FoundationFgosAudience;
    $this->getView()->setTitle('Соотвествие аудиторий фондам помещений');
  }

  public function actionList($page = 1)
  {
    // Подключаем вид
    //$this->getView()->setTitle('Паспорта');
    $FoundationFgosAudienceList = $this->FoundationFgosAudience->getFoundationFgosAudienceList($page);
    $total = $this->FoundationFgosAudience->getTotalFoundationFgosAudience();
    $pagination = new Pagination($total, $page, FoundationFgosAudience::SHOW_BY_DEFAULT, 'page-');
    $this->render('foundation_fgos_audience/list',array('FoundationFgosAudienceList'=>$FoundationFgosAudienceList,'pagination'=>$pagination));
  }

  public function actionDelete()
  {
    $this->checkPOST('id');
    $id = $_POST['id'];
    $this->FoundationFgosAudience->deleteFoundationFgosAudienceById($id);
  }

  public function actionAdd()
  {
    $this->checkPOST('insert');
    $this->FoundationFgosAudience->addFoundationFgosAudience();    
    $referrer = $_SERVER['HTTP_REFERER'];
    header("Location: $referrer");
  }

  public function actionEditFill($id)
  {
    if (isset($id))
    {
      $this->FoundationFgosAudience->getFoundationFgosAudienceById($id);
      $this->render('foundation_fgos_audience/edit_fill',array('FoundationFgosAudience'=>$this->FoundationFgosAudience));
    }
  }

  public function actionEditExec()
  {
    $this->checkPOST('id');
    $id = $_POST['id'];
    $this->FoundationFgosAudience->editFoundationFgosAudienceById($id);
    header("Location: ./list/page-1");
  }

  public function actionFiltration()
  {
    if (isset($_POST['filtration_form_submit']))
    {
      Auth::getInstance()->setTableFilter('FoundationFgosAudience',$this->FoundationFgosAudience->options);
    }
    if (isset($_POST['filtration_form_reset']))
    {
      Auth::getInstance()->resetTableAllFilter('FoundationFgosAudience');
    }
    header("Location: ./list/page-1");
  }
}
