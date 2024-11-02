<?php


class RoomlayoutController extends AdminController
{
    private $Roomlayout;

    function __construct()
    {
    parent::__construct();
    $this->Roomlayout = new Roomlayout;
    $this->getView()->setTitle('Схемы помещений');
    }
    public function actionIndex()
    {
            // Подключаем вид
        //$this->getView()->setTitle('Паспорта');
       $this->render('roomlayout/index');
    }
    public function actionGetImage()
    {
    	$this->checkPOST('id');
        $this->Roomlayout->getImageById($_POST['id']);
    }

}
