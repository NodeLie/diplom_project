<?php

class FoundationFgosInstrController extends AdminController
{
  private $FoundationFgosInstr; 

  function __construct()
  {
    parent::__construct();
    $this->FoundationFgosInstr = new FoundationFgosInstr;
    $this->getView()->setTitle('Соотвествие инструкций фондам помещений');
  }

  public function actionList($page = 1)
  {
    // Подключаем вид
    //$this->getView()->setTitle('Паспорта');
    $FoundationFgosInstrList = $this->FoundationFgosInstr->getFoundationFgosInstrList($page);
    $total = $this->FoundationFgosInstr->getTotalFoundationFgosInstr();
    $pagination = new Pagination($total, $page, FoundationFgosInstr::SHOW_BY_DEFAULT, 'page-');
    $this->render('Foundation_Fgos_Instr/list',array('FoundationFgosInstrList'=>$FoundationFgosInstrList,'pagination'=>$pagination));
  }

  public function actionDelete()
  {
    $this->checkPOST('id');
    $id = $_POST['id'];
    $this->FoundationFgosInstr->deleteFoundationFgosInstrById($id);
  }

  public function actionAdd()
  {
    if (isset($_POST['insert']))
    {   
      $id_foundation = $_POST['id_foundation'];
      $instr = $_POST['id_instr'];     
      $this->FoundationFgosInstr->addFoundationFgosInstr($id_foundation,$instr);    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: /foundation-fgos-instr/list/page-1");
    } else $this->render('Foundation_Fgos_Instr/add');
  }

  public function actionEditFill($id)
  {
    if (isset($id))
    {
      $this->FoundationFgosInstr->getFoundationFgosInstrById($id);
      $this->render('Foundation_Fgos_Instr/edit_fill',array('FoundationFgosInstr'=>$this->FoundationFgosInstr));
    }
  }

  public function actionEditExec()
  {
    $this->checkPOST('id');
    $id = $_POST['id'];
    $this->FoundationFgosInstr->editFoundationFgosInstrById($id);
    header("Location: ./list/page-1");
  }

  public function actionFiltration()
  {
    if (isset($_POST['filtration_form_submit']))
    {
      Auth::getInstance()->setTableFilter('FoundationFgosInstr',$this->FoundationFgosInstr->options);
    }
    if (isset($_POST['filtration_form_reset']))
    {
      Auth::getInstance()->resetTableAllFilter('FoundationFgosInstr');
    }
    header("Location: ./list/page-1");
  }
}
