<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/po/edit-exec'>
 <p><span>Аудитория</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$Po->audience,'id_audience'); ?>
    </p>
 <p>
    <span>Тип инструмента</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_mto','type_mto','type_mto',$Po->type_mto,'type_mto'); ?>
	</p>
	<p><span>Название</span>
    	<input type='text' id='name' name='name' value="<?php echo $Po->name; ?>">		
	</p>
	<p><span>Инвентарный номер</span>
    	<input type='text' id='inv_number_license' name='inv_number_license'  value="<?php echo $Po->inv_number_license; ?>">	
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $Po->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>