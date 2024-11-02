<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/electrics/edit-exec'>
 <p><span>Аудитория</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$Electrics->id_audience,'id_audience'); ?>
    </p>
 <p>
    <span>Тип инструмента</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_mto','type_mto','type_mto',$Electrics->type_mto,'id_mto'); ?>
	</p>
	<p><span>Величина</span>
    	<input type='text' id='name' name='name' value="<?php echo $Electrics->quantity; ?>">
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $Electrics->id_electrics; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>