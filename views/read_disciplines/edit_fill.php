<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/read-disciplines/edit-exec'>
<p><span>Академический год</span><br>
	<?php Widgets::dropDownSelectIdList('SELECT * FROM academic_year','id','id',$ReadDisciplines->id_academic_year,'id_academic_year'); ?>
	</p>
	<p><span>Преподаватель</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM employee','id',array('surname','name','patronymic'),$ReadDisciplines->id_employee,'id_employee'); ?>
	</p>
	<p>
    <span>Дисциплина</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM disciplines','id','name',$ReadDisciplines->id_disciplines,'id_disciplines'); ?>
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $ReadDisciplines->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>