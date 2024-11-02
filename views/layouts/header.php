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
		<p>Паспортизация</p>
    </div>
    <div id="header_menu">
		<ul class="topmenu">			
			<li><a href="/passport/add">Формирование паспорта</a></li>
			<li><a href="/passport/list/page-1">Редактирование и печать</a></li>
			<li><a href="">Справочники</a>
				<ul class="submenu">
					<li>
						<a href="">Организационная оснащенность</a>
						<ul class="submenu">
							<li><a href="/typeinstr/list/page-1">Справочник видов инструкций</a></li>
							<li><a href="/instr/list/page-1">Справочник инструкций</a></li>
							<li><a href="/workplaceteacher/list/page-1">Рабочее место преподавателя</a></li>
						</ul>
					</li>
					<li>
						<a href="">Программно-методическое обеспечение</a>
						<ul class="submenu">
							<li><a href="/disciplines/list/page-1">Справочник дисциплин</a></li>
							<li><a href="/ok/list/page-1">Справочник ОК</a></li>
							<li><a href="/pk/list/page-1">Справочник ПК</a></li>
							<li><a href="/ppssz/list/page-1">Справочник ППССЗ</a></li>
							<li><a href="/readdisciplines/list/page-1">Справочник читаемых дисциплин</a></li>
						</ul>
					</li>
					<li>
						<a href="">Организационно-эргономический уровень</a>
						<ul class="submenu">
							<li><a href="/typevent/list/page-1">Справочник типов вентиляции</a></li>
							<li><a href="/ventilation/list/page-1">Воздухообмен</a></li>
							<li><a href="/specialclothing/list/page-1">Спецодежда</a></li>
							<li><a href="/sanpin/list/page-1">Справочник норм СанПин</a></li>
							<li><a href="/indicatorergonomic/list/page-1">Показатели эргономики</a></li>

						</ul>
					</li>
					<li>
						<a href="">Материально-техническое оснащение</a>
						<ul class="submenu">
							<li><a href="/mto/list/page-1">Справочник МТО</a></li>
							<li><a href="/typemto/list/page-1">Справочник видов МТО</a></li>
							<li><a href="/po/list/page-1">Справочник ПО</a></li>
							<li><a href="/tools/list/page-1">Справочник инструментов</a></li>
							<li><a href="/electrics/list/page-1">Справочник электрооборудования</a></li>
						</ul>
					</li>
					<li><a href="/employee/list/page-1">Преподаватели</a></li>
				</ul>
			</li>
			<li><a href="/roomlayout">Схема помещения</a></li>
			<li><a href="">Отчёты</a>
				<ul class="submenu">
					<li><a href="">Соответсвие кабинетам ФГОС</a></li>
					<li><a href="/overtenyears/list/page-1">Оборудование старше 10 лет</a></li>
					<li><a href="">Перспективное планирование</a></li>
					<li><a href="">Контроль аполнения паспортов</a></li>
					<li><a href="">Соответсвие оборудованиям ФГОС</a></li>
				</ul>
			</li>
		</ul>
	</div>

</div>