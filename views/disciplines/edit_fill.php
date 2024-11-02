<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/disciplines/edit-exec'>
<p><span>Название</span>
    	<input type='text' id='name' name='name' value="<?php echo $Disciplines->name; ?>">		
	</p>
	<p><span>Индекс дисциплины</span>
    	<input type='text' id='index_discipline' name='index_discipline' value="<?php echo $Disciplines->index_discipline; ?>">		
	</p>
	<p><span>ППССЗ</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_ppssz','id_specialty',array('specialty','name'),$Disciplines->ppsz,'ppsz'); ?>
	</p>
	<p><span>Год ФГОС</span>
    	<input type='text' id='year_fgos' name='year_fgos' value="<?php echo $Disciplines->year_fgos; ?>">		
	</p>
	
	<p><span>Шифр</span><br>
<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_ciphers_disciplines','id_сiphers_dis','description',$Disciplines->id_ciphers,'id_ciphers'); ?>
	</p>
	<p>
    <span>Фонд офисов ФГОС</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM foundation_offices_fgos','id_foundation','name',$Disciplines->id_foundation,'id_foundation'); ?>
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $Disciplines->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>