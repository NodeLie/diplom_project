<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/ventilation/edit-exec'>
 <p><span>Аудитория</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$Ventilation->audience,'audience'); ?>
    </p>
	<p><span>type_fan</span>
    	<input type='text' id='type_fan' name='type_fan' value="<?php echo $Ventilation->type_fan; ?>">		
	</p>
	<p><span>Скорость обмена</span>
    	<input type='text' id='speed_exchange' name='speed_exchange' value="<?php echo $Ventilation->speed_exchange; ?>">		
	</p>
	<p><span>Комнатный шум</span>
    	<input type='text' id='room_volume' name='room_volume'  value="<?php echo $Ventilation->room_volume; ?>">	
	</p>
	<p><span>Количество</span>
    	<input type='text' id='count' name='count' value="<?php echo $Ventilation->count; ?>">		
	</p>
	<p><span>Тип вентиляции</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM spr_t_vent','type_ventilation','type_ventilation',$Ventilation->type_ventilation,'type_ventilation'); ?>
    </p>  
	<br>
    <input type="hidden" name="id" value="<?php echo $Ventilation->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>