<?php

class OverTenYearsController extends AdminController
{
  private $OverTenYears;

  function __construct()
  {
    parent::__construct();
    $this->OverTenYears = new OverTenYears;
    $this->getView()->setTitle('оборудование старше 10 лет');
  }
  public function actionList($page = 1)
  {
    $OverTenYearsList = $this->OverTenYears->getOverTenYearsList($page);
    $total = $this->OverTenYears->getTotalOverTenYears();
    $pagination = new Pagination($total, $page, OverTenYears::SHOW_BY_DEFAULT, 'page-');
    $this->render('over_ten_years/list',array('OverTenYearsList'=>$OverTenYearsList,'pagination'=>$pagination, 'total'=>$total));
  }
  public function actionExportExcel()
  {
    $this->checkPOST('export_excel_submit');
    $this->OverTenYears->ExportExcel();
  }
  public function actionDelete()
  {
  $this->checkPOST('id');
  $id = $_POST['id'];
  $this->OverTenYears->deleteOverTenYearsById($id);
  }
}
