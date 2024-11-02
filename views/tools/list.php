<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/tools/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>Аудитория</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('Tools','audience')){
				Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',Auth::getInstance()->getTableFilter('Tools','audience'),'audience',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM audience','id','number','audience',true,false); ?>
		</p>
		<p>
	    <span>Тип инструмента</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('Tools','type_mto')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_mto','type_mto','type_mto',Auth::getInstance()->getTableFilter('Tools','type_mto'),'type_mto',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM spr_mto','type_mto','type_mto','type_mto',true,false); ?>
		</p>
		<p><span>Ответственный</span>
	    	<input type='text' id='Owner' name='Owner' value="<?php if (Auth::getInstance()->isExsistsTableFilter('Tools','Owner')) { echo Auth::getInstance()->getTableFilter('Tools','Owner'); }?>">		
		</p>
		<p><span>Инвентарный номер</span>
	    	<input type='text' id='invent' name='invent' value="<?php if (Auth::getInstance()->isExsistsTableFilter('Tools','invent')) { echo Auth::getInstance()->getTableFilter('Tools','invent'); }?>">	
		</p>
		<p><span>Год приобретения</span> 
	    	<input type='text' id='year_purchase' name='year_purchase' maxlength='4' value="<?php if (Auth::getInstance()->isExsistsTableFilter('Tools','year_purchase')) { echo Auth::getInstance()->getTableFilter('Tools','year_purchase'); }?>">		
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
	<form method="POST" action="/tools/add">
		<p>Новая запись</p>
		<p>
			<span>Название</span>
	    	<input required type='text' id='name' name='name'>		
		</p>
		<p><span>Аудитория</span><br>
			<?php Widgets::dropDownList('SELECT * FROM audience','id','number','audience'); ?>
		</p>
		<p>
	    <span>Тип инструмента</span><br>
	    	<?php Widgets::dropDownList('SELECT * FROM spr_mto','type_mto','type_mto','type_mto'); ?>
		</p>
		<p><span>Ответственный</span>
	    	<input required type='text' id='Owner' name='Owner'>		
		</p>
		<p><span>Инвентарный номер</span>
	    	<input required type='text' id='invent' name='invent'>	
		</p>
		<p><span>Количество</span>
	    	<input required type='text' id='Count' name='Count' value='0' maxlength='4'>		
		</p>
		<p><span>Год приобретения</span> 
	    	<input type='text' id='year_purchase' name='year_purchase' maxlength='4'>		
		</p>
			<button type='submit' id='insert' name='insert'>Добавить</button>
		</form>
	</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="9"><img src="/web/images/table.png">Инструменты</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Название </td>
	<td> Год приобретения </td>
	<td> Инвентарный номер </td>
	<td> Количество </td>
	<td> Тип инструмента </td>
	<td> Аудитория </td>
	<td> Ответственный </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($toolsList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['year_purchase'];?></td>
			<td><?php echo $item['invent'];?></td>
			<td><?php echo $item['Count'];?></td>
			<td><?php echo $item['type_mto'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM audience', 'number', 'id', $item['audience']);?></td>
			<td><?php echo $item['Owner'];?></td>

            <td>
                <a href="/tools/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="tools" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="9"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>