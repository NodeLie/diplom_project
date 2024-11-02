<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/san-pin/edit-exec'>
    <p>
        <span>Название</span><br>
        <input type='text' id='indexx' name='indexx' value='<?php echo $SanPin->indexx; ?>'>
    </p>
    <p>
        <span>Шифр</span><br>
        <input type='text' id='cipher' name='cipher' value='<?php echo $SanPin->cipher; ?>'>
    </p>
    <p><span>Единица измерения</span>
        <input type='text' id='unit_measure' name='unit_measure' value='<?php echo $SanPin->unit_measure; ?>'>       
    </p>
    <p><span>Нормы СанПин</span>
        <input type='text' id='norm_san_pin' name='norm_san_pin' value='<?php echo $SanPin->norm_san_pin; ?>'>       
    </p>
    <br>
    <input type="hidden" name="id" value="<?php echo $SanPin->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>