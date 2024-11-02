<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/type-vent/edit-exec'>
    <p>
        <span>Название</span><br>
        <input type='text' id='type_ventilation' name='type_ventilation' value='<?php echo $TypeVent->type_ventilation; ?>'>
    </p>
    <br>
    <input type="hidden" name="id" value="<?php echo $TypeVent->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>