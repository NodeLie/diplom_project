<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/ok/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>ППССЗ</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('Ok','id_ppssz')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_ppssz ORDER BY specialty','id_specialty',array('specialty','name'),Auth::getInstance()->getTableFilter('Ok','id_ppssz'),'id_ppssz',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM spr_ppssz ORDER BY specialty','id_specialty',array('specialty','name'),'id_ppssz',true,false); ?>
		</p>
		<p><span>Шифр</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('Ok','short_name')){
				Widgets::dropDownSelectIdList('SELECT DISTINCT short_name FROM spr_ok','short_name','short_name',Auth::getInstance()->getTableFilter('Ok','short_name'),'short_name',true,false);
			}
			else Widgets::dropDownList('SELECT DISTINCT short_name FROM spr_ok','short_name','short_name','short_name',true,false); ?>
		</p>
		<p>
			<input type="submit"  name='filtration_form_submit' value="Применить">
		</p>
		<p>
			<input type="submit"   name='filtration_form_reset' value="Очистить">
		</p>    		
    	</form>
	</div>
<div id="add_data_table_form" class="TW_add_data_table_form">
<form method="POST" action="/ok/add">
	<p>Новая запись</p><br>
	<p><span>ППССЗ</span><br>
<?php Widgets::dropDownList('SELECT * FROM spr_ppssz','id_specialty',array('specialty','name'),'id_ppssz'); ?>
	</p>
	<p><span>Шифр</span>
    	<input required type='text' id='short_name' name='short_name'>		
	</p>	
	<p><span>Описание</span>
		<textarea required name="description" rows="5" cols="25">
			
		</textarea>	
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
	</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="5"><img src="/web/images/table.png">Общие компетенции</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> ППССЗ </td>
	<td> Шифр </td>
	<td> Описание </td>	
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($OkList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_ppssz', array('specialty','name'), 'id_specialty', $item['id_ppssz']);?></td>
			<td><?php echo $item['short_name'];?></td>
			<td><?php echo $item['description'];?></td>			
            <td>
                <a href="/ok/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="ok" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="5"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>