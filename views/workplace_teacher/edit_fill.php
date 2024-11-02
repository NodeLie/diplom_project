<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/workplace-teacher/edit-exec'>
 <p><span>Название</span>
    	<input type='text' id='name' name='name' value="<?php echo $WorkplaceTeacher->name;?>">
	</p>
	 <p><span>Количество</span>
    	<input type='text' id='count' name='count' value="<?php echo $WorkplaceTeacher->count;?>">
	</p>
	<p><span>Аудитория</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$WorkplaceTeacher->audience,'audience'); ?>
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $WorkplaceTeacher->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>