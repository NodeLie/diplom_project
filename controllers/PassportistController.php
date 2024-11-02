<?php

class PassportistController extends Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::getInstance()->compareRules(Auth::PASSPORTIST)) // Если пользователь не администратор
		{
			header('Location: /');
			exit;
		}

		$this->getView()->setLayoutHeader('passportist');
		$this->getView()->setLayoutFooter('passportist');
	}

	public function actionIndex()
	{
		$this->getView()->setTitle('Режим ответственного за печать');
		$this->render('passportist/index');
	}
}

?>