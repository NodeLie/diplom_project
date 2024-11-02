<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/type-instr/filtration" method="POST">
		<p>Фильтры</p>		
		<p><span>Шифр</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('typeinstr','types_instructions')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_t_instr','types_instructions','types_instructions',Auth::getInstance()->getTableFilter('typeinstr','types_instructions'),'types_instructions',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM spr_t_instr','types_instructions','types_instructions','types_instructions',true,false); ?>
		</p>
		<p><span>Название</span>
	    	<input type='text' id='name' name='name' value="<?php if (Auth::getInstance()->isExsistsTableFilter('typeinstr','name')) { echo Auth::getInstance()->getTableFilter('typeinstr','name'); }?>">	
		</p>
		<p>
			<input type="submit" id='filtration_form_submit' name='filtration_form_submit' value="Применить">
		</p>
		<p>
			<input type="submit"  id='filtration_form_submit' name='filtration_form_reset' value="Очистить">
		</p>    		
    	</form>
	</div>
<div id="add_data_table_form" class="TW_add_data_table_form">
<form method="POST" action="/type-instr/add">
	<p>Новая запись</p><br>
	<p><span>Название</span>
    	<input type='text' id='name' name='name'>		
	</p>
	<p><span>Шифр</span>
    	<input type='text' id='types_instructions' name='types_instructions'>		
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="4"><img src="/web/images/table.png">Типы инструкций</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Название </td>
	<td> Шифр </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($TypeInstrList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['types_instructions'];?></td>

            <td>
                <a href="/type-instr/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="type-instr" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="4"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>