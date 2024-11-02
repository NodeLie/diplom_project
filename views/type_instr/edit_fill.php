<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/type-instr/edit-exec'>
	<p><span>Название</span>
    	<input type='text' id='name' name='name' value="<?php echo $TypeInstr->name; ?>">		
	</p>
	<p><span>Инициалы</span>
    	<input type='text' id='types_instructions' name='types_instructions' value="<?php echo $TypeInstr->types_instructions; ?>">		
	</p>
	<br>
    <input type="hidden" name="id" value="<?php echo $TypeInstr->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>