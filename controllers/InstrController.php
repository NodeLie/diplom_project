<?php


class InstrController extends AdminController
{
      private $Instr;

    function __construct()
    {
      parent::__construct();
      $this->Instr = new Instr;
      $this->getView()->setTitle('Инструкции');
    }


    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $InstrList = $this->Instr->getInstrList($page);
       $total = $this->Instr->getTotalInstr();
       $pagination = new Pagination($total, $page, Instr::SHOW_BY_DEFAULT, 'page-');
       $this->render('instr/list',array('InstrList'=>$InstrList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Instr->deleteInstrById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Instr->addInstr();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Instr->getInstrById($id);
        $this->render('Instr/edit_fill',array('Instr'=>$this->Instr));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Instr->editInstrById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('Instr',$this->Instr->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('Instr');
      }
     
      header("Location: ./list/page-1");
    }
}
