<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/ppssz/edit-exec'>
    <p><span>Уровень обучения</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_level_education','id','level',$Ppssz->id_level_education,'id_level_education'); ?>
	</p>
		<p><span>Отделение</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_department','id','name',$Ppssz->id_department,'id_department'); ?>
	</p>
	<p><span>Код специальности</span>
    	<input type='text' id='specialty' name='specialty' value="<?php echo $Ppssz->specialty; ?>">		
	</p>
	<p><span>Название</span>
    	<input type='text' id='name' name='name' value="<?php echo $Ppssz->name; ?>">		
	</p>
	<br>
    <input type="hidden" name="id_specialty" value="<?php echo $Ppssz->id_specialty; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>