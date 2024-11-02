<div class="join_block_left_form">
	<div id="add_data_table_form" class="TW_add_data_table_form">
	<form method="POST" action="/electrics/add">
		<p>Новая запись</p><br>
		<p><span>Аудитория</span>
	<?php Widgets::dropDownList('SELECT * FROM audience','id','number','id_audience'); ?>
		</p>
		<p>
	    <span>Тип инструмента</span>
	    	<?php Widgets::dropDownList('SELECT * FROM spr_mto','id','type_mto','id_mto'); ?>
		</p>
		<p><span>Величина</span>
	    	<input type='text' id='quantity' name='quantity'>		
		</p>
			<button type='submit' id='insert' name='insert'>Добавить</button>
	</form>
	</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="5"><img src="/web/images/table.png">Электрооборудование</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Тип МТО </td>
	<td>  Аудитория </td>
	<td>  Величина </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($electricsList as $item): ?>
		<tr>
			<td><?php echo $item['id_electrics'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_mto', 'type_mto', 'id', $item['id_mto']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM audience', 'number', 'id', $item['id_audience']);?></td>
			<td><?php echo $item['quantity'];?></td>
            <td>
                <a href="/electrics/editfill/<?php echo $item['id_electrics']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="electrics" data-id="<?php echo $item['id_electrics']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="5"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>