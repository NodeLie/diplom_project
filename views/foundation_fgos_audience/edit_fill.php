<? $id_ppssz = Widgets::getDataTableById('SELECT * FROM foundation_offices_fgos','id_ppssz','id_foundation',$FoundationFgosAudience->id_foundation,false);?>
<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/foundation-fgos-audience/edit-exec'>
 <p><span>Аудитория</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$FoundationFgosAudience->id_audience,'id_audience'); ?>
    </p>
<p>
    <span>Помещение</span><br>
    	<?php Widgets::dropDownSelectIdList("SELECT *, specialty, foundation_offices_fgos.name as fgos_name FROM foundation_offices_fgos INNER JOIN spr_ppssz ON id_ppssz = id_specialty WHERE id_ppssz =".$id_ppssz,'id_foundation',array('specialty','fgos_name'),$FoundationFgosAudience->id_foundation,'id_foundation'); ?>
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $FoundationFgosAudience->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>