<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/indicator-ergonomic/edit-exec'>
 <p><span>СанПин</span>
    <?php Widgets::dropDownSelectIdList('SELECT * FROM spr_san_pin','indexx','indexx',$IndicatorErgonomic->indexx,'indexx'); ?>	
	</p>
	<p><span>Аудитория</span><br>
	<?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$IndicatorErgonomic->audience,'audience'); ?>
	</p>
	<p><span>Значение индикатора</span>
    	<input type='text' id='indicator_values' name='indicator_values' value="<?php echo $IndicatorErgonomic->indicator_values; ?>">		
	</p>
	<p><span>Дополнительные показатели</span>
    	<input type='text' id='additional_indicators' name='additional_indicators' value="<?php echo $IndicatorErgonomic->additional_indicators; ?>">	
	</p>
	<p><span>Академический год</span>
    <?php Widgets::dropDownSelectIdList('SELECT * FROM academic_year','id','id',$IndicatorErgonomic->academic_year,'academic_year'); ?>	
	</p> 
	<br>
    <input type="hidden" name="id" value="<?php echo $IndicatorErgonomic->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>