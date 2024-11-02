<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/ventilation/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>Аудитория</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('ventilation','audience')){
				Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',Auth::getInstance()->getTableFilter('ventilation','audience'),'audience',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM audience','id','number','audience',true,false); ?>
		</p>
		<p>
	    <span>Тип вентиляции</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('ventilation','type_ventilation')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_t_vent','type_ventilation','type_ventilation',Auth::getInstance()->getTableFilter('ventilation','type_ventilation'),'type_ventilation',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM spr_t_vent','type_ventilation','type_ventilation','type_ventilation',true,false); ?>
		</p>
		<p><span>тип вентилятора</span>
	    	<input type='text' id='type_fan' name='type_fan' value="<?php if (Auth::getInstance()->isExsistsTableFilter('ventilation','type_fan')) { echo Auth::getInstance()->getTableFilter('ventilation','type_fan'); }?>">		
		</p>
		<p><span>Количество</span>
	    	<input type='text' id='count' name='count' value="<?php if (Auth::getInstance()->isExsistsTableFilter('ventilation','count')) { echo Auth::getInstance()->getTableFilter('ventilation','count'); }?>">	
		</p>
		<p><span>Скорость обмена</span> 
	    	<input type='text' id='speed_exchange' name='speed_exchange' value="<?php if (Auth::getInstance()->isExsistsTableFilter('ventilation','speed_exchange')) { echo Auth::getInstance()->getTableFilter('ventilation','speed_exchange'); }?>">		
		</p>
		<p><span>Комнатный шум</span> 
	    	<input type='text' id='room_volume' name='room_volume' value="<?php if (Auth::getInstance()->isExsistsTableFilter('ventilation','room_volume')) { echo Auth::getInstance()->getTableFilter('ventilation','room_volume'); }?>">		
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
<form method="POST" action="/ventilation/add">
	<p>Новая запись</p><br>
	<p><span>Аудитория</span><br>
<?php Widgets::dropDownList('SELECT * FROM audience','id','number','audience'); ?>
	</p>
	<p>
    <span>Тип вентиляции</span><br>
    	<?php Widgets::dropDownList('SELECT * FROM spr_t_vent','type_ventilation','type_ventilation','type_ventilation'); ?>
	</p>
	<p><span>тип вентилятора</span>
    	<input required type='text' id='type_fan' name='type_fan'>		
	</p>
	<p><span> Количество </span>
    	<input required type='text' id='count' name='count'>	
	</p>
	<p><span>Скорость обмена</span>
    	<input required type='text' id='speed_exchange' name='speed_exchange'>		
	</p>
	<p><span>Комнатный шум</span> 
    	<input required type='text' id='room_volume' name='room_volume'>		
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
	</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="8"><img src="/web/images/table.png">ВоздухоОбмен</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Тип вентиляции </td>
	<td> тип вентилятора </td>
	<td> Скорость обмена </td>
	<td> Количество </td>
	<td> Комнатный шум </td>
	<td> Аудитория </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($VentilationList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['type_ventilation'];?></td>
			<td><?php echo $item['type_fan'];?></td>
			<td><?php echo $item['speed_exchange'];?></td>
			<td><?php echo $item['count'];?></td>
			<td><?php echo $item['room_volume'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM audience', 'number', 'id', $item['audience']);?></td>
            <td>
                <a href="/ventilation/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="ventilation" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="8"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>