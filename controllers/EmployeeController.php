<?php


class EmployeeController extends AdminController
{
      private $Employee;

    function __construct()
    {
      parent::__construct();
      $this->Employee = new Employee;
      $this->getView()->setTitle('Преподаватели');
    }

    public function actionList($page = 1)
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $EmployeeList = $this->Employee->getEmployeeList($page);
       $total = $this->Employee->getTotalEmployee();
       $pagination = new Pagination($total, $page, Employee::SHOW_BY_DEFAULT, 'page-');
       $this->render('employee/list',array('EmployeeList'=>$EmployeeList,'pagination'=>$pagination));
    }
    public function actionDelete()
    {
        $this->checkPOST('id');
        $id = $_POST['id'];
        $this->Employee->deleteEmployeeById($id);
    }
    public function actionAdd()
    {
      $this->checkPOST('insert');
      $this->Employee->addEmployee();    
      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }
public function actionEditFill($id)
    {
      if (isset($id)) {
        $this->Employee->getEmployeeById($id);
        $this->render('Employee/edit_fill',array('Employee'=>$this->Employee));
      }
    }
    public function actionEditExec()
    {
      $this->checkPOST('id');
      $id = $_POST['id'];
      $this->Employee->editEmployeeById($id);
      header("Location: ./list/page-1");
    }
    public function actionFiltration()
    {
      if (isset($_POST['filtration_form_submit']))
      {
        Auth::getInstance()->setTableFilter('employee',$this->Employee->options);
      }
      if (isset($_POST['filtration_form_reset']))
      {
        Auth::getInstance()->resetTableAllFilter('employee');
      }
      header("Location: ./list/page-1");
    }
}
