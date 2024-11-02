<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/type-mto/edit-exec'>
    <p>
        <span>Название</span><br>
        <input type='text' id='type_mto' name='type_mto' value='<?php echo $TypeMto->type_mto; ?>'>
    </p>
    <br>
    <input type="hidden" name="id" value="<?php echo $TypeMto->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>