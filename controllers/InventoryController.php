<?php

class InventoryController extends Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::getInstance()->compareRules(Auth::INVENT)) // Если пользователь не администратор
		{
			header('Location: /');
			exit;
		}

		$this->getView()->setLayoutHeader('inventory');
		$this->getView()->setLayoutFooter('inventory');
	}

	public function actionIndex()
	{
		$this->getView()->setTitle('Режим ответственного за инвентаризацию');
		$this->render('inventory/index');
	}
}

?>