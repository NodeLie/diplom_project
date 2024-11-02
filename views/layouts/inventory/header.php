<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->title ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/web/css/main.css">
</head>
<body>
<div id="wrapper">
<div id="header">
	<div id="user_menu">
	 <?php if(Auth::getInstance()->isGuest()): // Если гость ?>
		<div id="auth_form">
    		<form action="/site/login" method="POST" id="auth_form_f1">
        		<p class="auth_message"></p>
				<p class="auth_text">Логин</p><br>
            		<input type="text" name="auth_login" id="auth_login" maxlength="25">
            	<p class="auth_text">Пароль</p><br>
            		<input type="password" name="auth_password" id="auth_password" maxlength="25">
        		<input type="submit" id="auth_submit" name="auth_submit" value="Войти">
        		<br>
        		<img src="/web/images/auth_load.gif" id="auth_load">
    		</form>
		</div>
		<a class="user_button" id="auth_button">Вход</a>
		<p>Гость</p>
	<?php else: ?>
		<a class="user_button" href="/user/logout">Выход</a>
		<p><?php echo Auth::getInstance()->getName() ?></p>
	<?php endif ?>
    </div>
    <div id="header_main">
		<a class="logo" href="/"></a>
		<p>ФГБОУ ВО "Магнитогорский государственный технический университет им. Г.И. Носова"</p>
		<p>Многопрофильный колледж</p>
		<p>Паспортизация учебных помещений</p>
    </div>
    <div id="header_menu">
		<ul class="topmenu">			
			<li>
				<a href="">Материально-техническое оснащение</a>
				<ul class="submenu">
					<!--<li><a href="/mto/list/page-1">Справочник МТО</a></li>-->
					<li><a href="/type-mto/list/page-1">Справочник видов МТО</a></li>
					<!--<li><a href="/po/list/page-1">Справочник ПО</a></li>-->
					<li><a href="/tools/list/page-1">Справочник инструментов</a></li>
					<!--<li><a href="/electrics/list/page-1">Справочник электрооборудования</a></li>-->
				</ul>
			</li>
	</div>

</div>