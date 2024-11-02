<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/mto/editexec'>
 <p><span>Аудитория</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$Mto->audience,'id_audience'); ?>
    </p>
 <p>
    <span>Тип инструмента</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_mto','type_mto','type_mto',$Mto->type_mto,'type_mto'); ?>
	</p>
	<p><span>Название</span>
    	<input type='text' id='name' name='name' value="<?php echo $Mto->name; ?>">		
	</p>
	<p><span>Заказчик</span>
    	<input type='text' id='Owner' name='Owner' value="<?php echo $Mto->Owner; ?>">		
	</p>
	<p><span>Инвентарный номер</span>
    	<input type='text' id='invent' name='invent'  value="<?php echo $Mto->invent; ?>">	
	</p>
	<p><span>Количество</span>
    	<input type='text' id='Count' name='Count' value='0' maxlength='4'  value="<?php echo $Mto->Count; ?>">		
	</p>
	<p><span>Дата покупки</span> 
    	<input type='text' id='year_purchase' name='year_purchase' maxlength='4'  value="<?php echo $Mto->year_purchase; ?>">		
	</p>   
	<br>
    <input type="hidden" name="id" value="<?php echo $Mto->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>