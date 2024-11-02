<?php

class UserController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function actionAjaxLoadFoundation()
	{
		echo $_POST['id_ppssz'];
		$this->checkAjax();
     	Auth::getInstance()->AjaxLoadFoundation($_POST['id_ppssz']);
	}
	public function actionLogout()
	{
		Auth::getInstance()->logout();
		header('Location: /');
	}
}

?>