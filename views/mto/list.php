<div class="join_block_left_form">
<div id="add_data_table_form" class="TW_add_data_table_form">
<form method="POST" action="/mto/add">
	<p>Новая запись</p><br>
	<p><span>Название</span>
    	<input type='text' id='name' name='name'>		
	</p>
	<p><span>Аудитория</span><br>
<?php Widgets::dropDownList('SELECT * FROM audience','id','number','id_audience'); ?>
	</p>
	<p>
    <span>Тип инструмента</span><br>
    	<?php Widgets::dropDownList('SELECT * FROM spr_mto','type_mto','type_mto','type_mto'); ?>
	</p>
	<p><span>Заказчик</span>
    	<input type='text' id='Owner' name='Owner'>		
	</p>
	<p><span>Инвентарный номер</span>
    	<input type='text' id='invent' name='invent'>	
	</p>
	<p><span>Количество</span>
    	<input type='text' id='Count' name='Count' value='0' maxlength='4'>		
	</p>
	<p><span>Дата покупки</span> 
    	<input type='text' id='year_purchase' name='year_purchase' maxlength='4'>		
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="9"><img src="/web/images/table.png">Материально-техническое оснащение</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Название </td>
	<td> Дата покупки </td>
	<td> Инвентарный номер </td>
	<td> Количество </td>
	<td> Тип инструмента </td>
	<td> Аудитория </td>
	<td> Заказчик </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($mtoList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['year_purchase'];?></td>
			<td><?php echo $item['invent'];?></td>
			<td><?php echo $item['Count'];?></td>
			<td><?php echo $item['type_mto'];?></td>
			<td><?php echo $item['audience'];?></td>
			<td><?php echo $item['Owner'];?></td>
            <td>
                <a href="/mto/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="mto" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="9"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>