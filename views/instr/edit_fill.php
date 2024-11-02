<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/instr/edit-exec'>
 <p><span>Название</span>
    	<input type='text' id='name' name='name' value="<?php echo $Instr->name;  ?>">		
	</p>
	<!--<p><span>Аудитория</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$Instr->audience,'audience',true); ?>
	</p>-->
	<p><span>Тип инструкции</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_t_instr','types_instructions','types_instructions',$Instr->types_instructions,'types_instructions'); ?>
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $Instr->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>