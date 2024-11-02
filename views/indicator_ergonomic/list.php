<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/indicator-ergonomic/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>СанПин</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('IndicatorErgonomic','indexx')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_san_pin','indexx','indexx',Auth::getInstance()->getTableFilter('IndicatorErgonomic','indexx'),'indexx',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM spr_san_pin','indexx','indexx','indexx',true,false); ?>
		</p>
		<p>
	    <span>Аудитория</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('IndicatorErgonomic','audience')){
				Widgets::dropDownSelectIdList('SELECT * FROM audience','id','number',Auth::getInstance()->getTableFilter('IndicatorErgonomic','audience'),'audience',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM audience','id','number','audience',true,false); ?>
		</p>
		<p>
	    <span>Академический год</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('IndicatorErgonomic','academic_year')){
				Widgets::dropDownSelectIdList('SELECT * FROM academic_year','id','id',Auth::getInstance()->getTableFilter('IndicatorErgonomic','academic_year'),'academic_year',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM academic_year','id','id','academic_year',true,false); ?>
		</p>
		<p><span>Значение индикатора</span>
	    	<input type='text' id='indicator_values' name='indicator_values' value="<?php if (Auth::getInstance()->isExsistsTableFilter('IndicatorErgonomic','indicator_values')) { echo Auth::getInstance()->getTableFilter('IndicatorErgonomic','indicator_values'); }?>">		
		</p>	
		<p><span>Дополнительные показатели</span>
	    	<input type='text' id='additional_indicators' name='additional_indicators' value="<?php if (Auth::getInstance()->isExsistsTableFilter('IndicatorErgonomic','additional_indicators')) { echo Auth::getInstance()->getTableFilter('IndicatorErgonomic','additional_indicators'); }?>">		
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
<form method="POST" action="/indicator-ergonomic/add">
	<p>Новая запись</p><br>
	<p><span>СанПин</span>
    <?php Widgets::dropDownList('SELECT * FROM spr_san_pin','indexx','indexx','indexx'); ?>	
	</p>
	<p><span>Аудитория</span><br>
	<?php Widgets::dropDownList('SELECT * FROM audience','id','number','audience'); ?>
	</p>
	<p><span>Значение индикатора</span>
    	<input required type='text' id='indicator_values' name='indicator_values'>		
	</p>
	<p><span>Дополнительные показатели</span>
    	<input type='text' id='additional_indicators' name='additional_indicators'>	
	</p>
	<p><span>Академический год</span>
    <?php Widgets::dropDownList('SELECT * FROM academic_year','id','id','academic_year'); ?>	
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="7"><img src="/web/images/table.png">Показатели эргономики</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> СанПин </td>
	<td> Значение индикатора </td>
	<td> Дополнительные показатели </td>
	<td> Академический год </td>
	<td> Аудитория </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($IndicatorErgonomicList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['indexx'];?></td>
			<td><?php echo $item['indicator_values'];?></td>
			<td><?php echo $item['additional_indicators'];?></td>
			<td><?php echo $item['academic_year'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM audience', 'number', 'id', $item['audience']);?></td>
            <td>
                <a href="/indicator-ergonomic/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="indicator-ergonomic" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="7"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>