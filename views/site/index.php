
	<?if(!isset($_SESSION['academic_year']) and isset($_SESSION['Auth'])){?>
	<div style="margin: auto;" id="filtration_form" class="EW_filtration_form">
		<form action="/passport/set-academic-year" method="POST">
			<p>Академический год</p>
		<p>
			<?php Widgets::dropDownList('SELECT * FROM academic_year','id','id','academic_year',false);  ?>
		</p>
		<input type="submit" name="enter" value="Выбрать">
		</form>
	</div>
	<?} else {?>
	<div class="description">
      <p> В соответствии с ФГОС образовательная организация, реализующая программы подготовки специалистов, должна располагать материально-технической базой, обеспечивающей проведение всех видов лабораторных работ и практических занятий, дисциплинарной, междисциплинарной и модульной подготовки, учебной практики, предусмотренных учебным планом образовательной организации. Материально-техническая база должна соответствовать действующим санитарным и противопожарным нормам. При этом в каждом ФГОС оговорен перечень кабинетов, лабораторий, мастерских и других помещений для организации учебного процесса.
Учебное помещение – это помещение, оснащенное наглядными пособиями, учебным оборудованием, мебелью и техническими средствами обучения, в котором проводится учебная, факультативная и внеклассная работа со студентами в полном соответствии с действующими ФГОС СПО, учебными планами, основными профессиональными образовательными программами и программами подготовки квалифицированных рабочих, служащих.</p>
<p>Обязательная паспортизация помещений аудиторного фонда учебного заведения разрабатывается в соответствии с действующим законодательством РФ:</p>
<p>
	<ul>
		<li>
			типовые положения об образовательном учреждении высшего профессионального образования (высшем учебном заведении), утвержденное постановлением Правительства Российской Федерации от 14 февраля 2008 г. № 71 и среднего профессионального образования (среднем специальном учебном заведении), утвержденное постановлением Правительства РФ от 18 июля 2008 г. № 543 [4,5];
		</li>
		<li>
			Закон РФ 29 декабря 2012 года N 273-Ф3 "Об образовании в Российской Федерации" (с изменениями и дополнениями) [6];
		</li>
		<li>
			Закон РФ 29 декабря 2012 года N 273-Ф3 "Об образовании в Российской Федерации" (с изменениями и дополнениями) [6];
		</ul>
		<li>
			Федеральные государственные образовательные стандарты высшего и среднего профессионального образования;
		</li>
		<li>
			санитарно-эпидемиологические правила и нормативы СанПиН 2.4.2.2821-10 «Санитарно-эпидемиологические требования к условиям и организации обучения в общеобразовательных учреждениях» (с изменениями и дополнениями) [7]; 
		</li>
		<li>
			Устав образовательной организации.
		</li>
	</ul>
</p>
<p>Паспортизация помещений учебного заведения проводится ежегодно в начале учебного года, в настоящий момент результаты данной процедуры учитываются вручную в паспортах в бумажном виде.</p>
<p>Цель паспортизации помещений учебного заведения – проанализировать состояние помещения, его готовность к обеспечению требований стандартов образования, соответствия санитарно-эпидемиологическим требованиям, требованиям пожарной безопасности, определить основные направления работы по приведению помещения в соответствие требованиям учебно-методического, материально-технического обеспечений образовательного процесса по реализуемым программам.</p>
<p>При лицензировании и аккредитации учебного заведения особое внимание уделяется отчетам по использованию аудиторного фонда.</p> 
<p>В каждой образовательной организации создается своя форма паспорта аудитории, где, как правило, фиксируются такие характеристики, как информация о номере кабинета и его функциональном назначении; фамилия ответственного за кабинет; площадь кабинета; перечень имеющейся в нем мебели, оборудования, в том числе, компьютерного, приборов, технических средств, наглядных пособий, таблиц, карт, учебников, методических пособий и т. д. с указанием количества и инвентарных номеров. Не всегда данное представление отражает в полной мере характеристику помещения и соответствие его назначению.</p>
</div>
     <?} ?>