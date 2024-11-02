<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/tools/edit-exec'>
 <p><span>Аудитория</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$Tools->audience,'audience'); ?>
    </p>
 <p>
    <span>Тип инструмента</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_mto','type_mto','type_mto',$Tools->type_mto,'type_mto'); ?>
	</p>
	<p><span>Название</span>
    	<input type='text' id='name' name='name' value="<?php echo $Tools->name; ?>">		
	</p>
	<p><span>Заказчик</span>
    	<input type='text' id='Owner' name='Owner' value="<?php echo $Tools->Owner; ?>">		
	</p>
	<p><span>Инвентарный номер</span>
    	<input type='text' id='invent' name='invent'  value="<?php echo $Tools->invent; ?>">	
	</p>
	<p><span>Количество</span>
    	<input type='text' id='Count' name='Count' value='0' maxlength='4'  value="<?php echo $Tools->Count; ?>">		
	</p>
	<p><span>Дата покупки</span> 
    	<input type='text' id='year_purchase' name='year_purchase' maxlength='4'  value="<?php echo $Tools->year_purchase; ?>">		
	</p>   
	<br>
    <input type="hidden" name="id" value="<?php echo $Tools->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>