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
		<a class="user_button" href="/user/logout">Выход</a>
		<p> Администратор <?php //echo Auth::getInstance()->getName() ?></p>
    </div>
    <div id="header_main">
		<a class="logo" href="/"></a>
		<p>ФГБОУ ВО "Магнитогорский государственный технический университет им. Г.И. Носова"</p>
		<p>Многопрофильный колледж</p>
		<p>Паспортизация учебных помещений</p>
    </div>
    <div id="header_menu">
		<ul class="topmenu">			
			<li><a href="">Справочники</a>
				<ul class="submenu">
					<li>
						<a href="">Организационная оснащенность</a>
						<ul class="submenu">
							<li><a href="/type-instr/list/page-1">Справочник типов инструкций</a></li>
							<li><a href="/instr/list/page-1">Справочник инструкций</a></li>
							<li><a href="/workplace-teacher/list/page-1">Рабочее место преподавателя</a></li>
						</ul>
					</li>
					<li>
						<a href="">Программно-методическое обеспечение</a>
						<ul class="submenu">
							<li><a href="/disciplines/list/page-1">Справочник дисциплин</a></li>
							<li><a href="/ok/list/page-1"> Общие компетенции </a></li>
							<li><a href="/pk/list/page-1">Профессиональные компетенции</a></li>
							<li><a href="/ppssz/list/page-1">Справочник ППССЗ</a></li>
							<li><a href="/read-disciplines/list/page-1">Справочник читаемых дисциплин</a></li>
						</ul>
					</li>
					<li>
						<a href="">Организационно-эргономический уровень</a>
						<ul class="submenu">
							<li><a href="/type-vent/list/page-1">Справочник типов вентиляции</a></li>
							<li><a href="/ventilation/list/page-1">Воздухообмен</a></li>
							<li><a href="/special-clothing/list/page-1">Спецодежда</a></li>
							<li><a href="/san-pin/list/page-1">Справочник норм СанПин</a></li>
							<li><a href="/indicator-ergonomic/list/page-1">Показатели эргономики</a></li>

						</ul>
					</li>
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
					<li><a href="/employee/list/page-1">Сотрудники</a></li>
					<li><a href="/foundation-fgos-audience/list/page-1">Соответствия аудиторий фонду помещений</a></li>
					<li><a href="/foundation-fgos-instr/list/page-1">Соответствия инструкций фонду помещений</a></li>
				</ul>
			</li>
			<li><a href="/roomlayout">Схема помещения</a></li>
			<li><a href="">Отчёты</a>
				<ul class="submenu">
					<li><a href="">Соответсвие кабинетам ФГОС</a></li>
					<li><a href="/over-ten-years/list/page-1">Оборудование старше 10 лет</a></li>
					<li><a href="">Перспективное планирование</a></li>
					<li><a href="">Контроль аполнения паспортов</a></li>
					<li><a href="">Соответсвие оборудованиям ФГОС</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>