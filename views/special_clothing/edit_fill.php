<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/special-clothing/edit-exec'>
    <p>
        <span>Название</span><br>
        <input type='text' id='name' name='name' value='<?php echo $SpecialClothing->name; ?>'>
    </p>
    <p>
        <span>actual_availability</span><br>
        <input type='text' id='actual_availability' name='actual_availability' value='<?php echo $SpecialClothing->actual_availability; ?>'>
    </p>
    <p>
        <span>Аудитория</span><br>
        <?php echo Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',$SpecialClothing->audience,'audience') ?>
    </p>
    <br>
    <input type="hidden" name="id" value="<?php echo $SpecialClothing->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>