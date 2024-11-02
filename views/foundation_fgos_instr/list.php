<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/foundation-fgos-instr/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>ППССЗ</span><br>
			<?php Widgets::dropDownList('SELECT * FROM spr_ppssz ORDER BY specialty','id_specialty',array('specialty','name'),'ppsz',true,false); ?>
		</p>
		<p>
	    <span>Фонд помещений</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('foundationfgosinstr','id_foundation')){
				Widgets::dropDownSelectIdList('SELECT * FROM foundation_offices_fgos','id_foundation','name',Auth::getInstance()->getTableFilter('foundationfgosinstr','id_foundation'),'id_foundation',true,false);
			} 
			else echo "<select id='id_foundation' name='id_foundation' disabled>
					<option>Выберите ППССЗ</option>
				</select>";?>
				
		</p>
		<p><span>Инструкции</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('foundationfgosinstr','id_instr')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_instr','id','name',Auth::getInstance()->getTableFilter('foundationfgosinstr','id_instr'),'id_instr',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM spr_instr','id','name','id_instr',true,false); ?>
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
		<p>Новая запись</p>			
			<a style="color: black;" href="/foundation-fgos-instr/add">Добавить</a>	
	</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="5"><img src="/web/images/table.png">Соответствие инструкций фондам помещений</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Специальность </td>
	<td> Фонд помещений </td>
	<td> Инструкции </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($FoundationFgosInstrList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT spr_ppssz.name as ppssz_name, specialty FROM foundation_offices_fgos INNER JOIN spr_ppssz ON id_ppssz = spr_ppssz.id_specialty',array('specialty','ppssz_name'), 'id_foundation', $item['id_foundation']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT spr_t_cabinet_fgos.name as t_cabinet_name,foundation_offices_fgos.name as office_name FROM foundation_offices_fgos INNER JOIN spr_t_cabinet_fgos ON id_t_cabinet = spr_t_cabinet_fgos.id', array('t_cabinet_name','office_name'), 'id_foundation', $item['id_foundation']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_instr', 'name', 'id', $item['id_instr']);?></td>
            <td>
                <a href="/foundation-fgos-instr/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="foundation-fgos-instr" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="5"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>