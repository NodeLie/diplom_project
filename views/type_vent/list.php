<div class="join_block_left_form">
<div id="add_data_table_form" class="TW_add_data_table_form">
<form method="POST" action="/type-vent/add">
	<p>Новая запись</p><br>
	<p><span>Название</span>
    	<input required type='text' id='type_ventilation' name='type_ventilation'>		
	</p>	
		<button type='submit' id='insert' name='insert'>Добавить</button>
</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="3"><img src="/web/images/table.png">Типы вентиляции</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Название </td>
	<td> </td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($typeVentList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['type_ventilation'];?></td>
            <td>
                <a href="/type-vent/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="type-vent" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="3"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>