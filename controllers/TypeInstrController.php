<?php

/**
 * Контроллер ProductController
 * Товар
 */
class TypeInstrController extends AdminController
{

    private $TypeInstr;

    function __construct()
    {
      parent::__construct();
      $this->TypeInstr = new TypeInstr;
      $this->getView()->setTitle('Типы инструкций');
    }


    public function actionList($page = 1)
    {
       $TypeInstrList = $this->TypeInstr->getTypeInstrList($page);
       $total = $this->TypeInstr->getTotalTypeInstr();
       $pagination = new Pagination($total, $page, TypeInstr::SHOW_BY_DEFAULT, 'page-');
       $this->render('type_instr/list',array('TypeInstrList'=>$TypeInstrList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->TypeInstr->deleteTypeInstrById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->TypeInstr->addTypeInstr();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id))
      {
        $this->TypeInstr->getTypeInstrById($id);
        $this->render('type_instr/edit_fill',array('TypeInstr'=>$this->TypeInstr));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->TypeInstr->editTypeInstrById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('TypeInstr',$this->TypeInstr->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('TypeInstr');
      }
     
      header("Location: ./list/page-1");
    }
}
