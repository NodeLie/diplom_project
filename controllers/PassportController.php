<?php
class PassportController extends Controller
{
      private $Passport;

    function __construct()
    {
      parent::__construct();
      $this->Passport = new Passport;
      $this->getView()->setTitle('Паспорта');
       if (Auth::getInstance()->compareRules(Auth::PASSPORTIST))
       {
          $this->getView()->setLayoutHeader('passportist');
          $this->getView()->setLayoutFooter('passportist');
       }
    }

    public function actionList($page = 1)
    {
      if (!Auth::getInstance()->compareRules(Auth::TEACHER) && !Auth::getInstance()->compareRules(Auth::PASSPORTIST))
      {
          header('Location: /');          
      }      
      if (!isset($_SESSION['academic_year']))
      {  
        header('Location: /');
        exit();
      }        
        $PassportList = $this->Passport->getPassportList($page,$_SESSION['academic_year']);
        $total = $this->Passport->getTotalPassport();
        $pagination = new Pagination($total, $page, Passport::SHOW_BY_DEFAULT, 'page-');
        $this->render('passport/list',array('PassportList'=>$PassportList,'pagination'=>$pagination));     
    }
    public function actionDelete()
    {
        if (!Auth::getInstance()->compareRules(Auth::TEACHER) && !Auth::getInstance()->compareRules(Auth::PASSPORTIST))
      {
          header('Location: /');          
      } 
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Passport->deletePassportById($id);
    }
    public function actionAdd()
    {
      if (!Auth::getInstance()->compareRules(Auth::TEACHER))
      {
        header('Location: /');
      }
      if (!isset($_SESSION['academic_year']))
      {  
        header('Location: /');
        exit();
      }
      $result = "";
      if (isset($_POST['insert']))
      {
        if (!empty($_SESSION['academic_year']) and !empty($_POST['id_ppssz']) and !empty($_POST['id_foundation']) and !empty($_POST['id_t_cabinet']) and !empty($_POST['id_audience']) and !empty($_POST['discipline']) and !empty($_POST['number_protokol']) and !empty($_POST['date_statement']) and !empty($_POST['date_priem']) and !empty($_POST['id_instr']))
        {       
          $result = $this->Passport->addPassport();
          if ($result)
          {
            $result = "Паспорт добавлен";
          }
          else
          {
            $result = "Произошла ошибка при добавлении паспорта";
          }
        } 
        else
          {
            $result = "Введены не все данные";
          } 
      }         
        $this->render('Passport/add',array('result' => $result));      
    }
public function actionEditFill($id)
    {
      if (!Auth::getInstance()->compareRules(Auth::TEACHER) && !Auth::getInstance()->compareRules(Auth::PASSPORTIST))
      {
          header('Location: /');          
      } 
      if (isset($id))
      {
        $this->Passport->getPassportById($id);
        $this->render('Passport/edit_fill',array('Passport'=>$this->Passport));
      }
    }
    public function actionEditExec()
    {
      if (!Auth::getInstance()->compareRules(Auth::TEACHER) && !Auth::getInstance()->compareRules(Auth::PASSPORTIST))
      {
          header('Location: /');          
      } 
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Passport->editPassportById($id);
      header("Location: ./list/page-1");
    }
    public function actionSetAcademicYear()
    {
      if (isset($_POST['academic_year']))
      {
        $_SESSION['academic_year'] = $_POST['academic_year'];
      }
      header("Location: /");
    }
    public function actionAjaxLoadFoundation()
    {
     $this->checkAjax();
     $this->Passport->LoadFoundation($_POST['id_ppssz'],$_POST['id_t_cabinet']);
    }
    public function actionAjaxLoadAudience()
    {
     $this->checkAjax();
     
     $this->Passport->LoadAudience($_POST['id_foundation']);
    }
    public function actionAjaxLoadDisciplines()
    {
     $this->checkAjax();
     if (isset($_POST['id_foundation'])) {
       $id_foundation = $_POST['id_foundation'];
     }
     $this->Passport->LoadDisciplines($id_foundation);
    }
    public function actionAjaxLoadInstr()
    {
     $this->checkAjax();   
     if (isset($_POST['id_foundation'])) {
        $id_foundation = $_POST['id_foundation'];
       } else return false; 
     $this->Passport->LoadInstr($id_foundation);
    }

    public function actionPrint($id)
    {
      require 'vendor/autoload.php'; 
      if (!Auth::getInstance()->compareRules(Auth::PASSPORTIST)){
          header('Location: /');          
      }          
      $this->Passport->ExportToWord($id);
      header("Location: /passport/list/page-1");
    }
}
