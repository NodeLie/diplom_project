<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/ok/edit-exec'>
	<p><span>Название</span>
    <input type='text' id='short_name' name='short_name' value="<?php echo $Ok->short_name; ?>">		
	</p>
 	<p><span>ППССЗ</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_ppssz','id_specialty',array('specialty','name'),$Ok->id_ppssz,'id_ppssz'); ?>
	</p>
	<p><span>Описание</span>
    	<input type='text' id='description' name='description' value="<?php echo $Ok->description; ?>">		
	</p> 
	<br>
    <input type="hidden" name="id" value="<?php echo $Ok->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>