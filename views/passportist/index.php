
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
Для ответственных за инвентаризацию
<?}?>