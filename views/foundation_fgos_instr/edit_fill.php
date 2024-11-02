<? $id_ppssz = Widgets::getDataTableById('SELECT * FROM foundation_offices_fgos','id_ppssz','id_foundation',$FoundationFgosInstr->id_foundation,false);?>
<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/foundation-fgos-instr/edit-exec'>
 <p><span>Инструкции</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM spr_instr','id','name',$FoundationFgosInstr->id_instr,'id_audience'); ?>
    </p>
 <p>
    <span>Помещение</span><br>
    	<?php Widgets::dropDownSelectIdList("SELECT *, specialty, foundation_offices_fgos.name as fgos_name FROM foundation_offices_fgos INNER JOIN spr_ppssz ON id_ppssz = id_specialty WHERE id_ppssz =".$id_ppssz,'id_foundation',array('specialty','fgos_name'),$FoundationFgosInstr->id_foundation,'id_foundation'); ?>
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $FoundationFgosInstr->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>