<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/disciplines/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>ППССЗ</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('disciplines','ppsz')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_ppssz ORDER BY specialty','id_specialty',array('specialty','name'),Auth::getInstance()->getTableFilter('disciplines','ppsz'),'ppsz',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM spr_ppssz ORDER BY specialty','id_specialty',array('specialty','name'),'ppsz',true,false); ?>
		</p>
		<p>
	    <span>Фонд помещений</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('disciplines','ppsz')) {
	    	if (Auth::getInstance()->isExsistsTableFilter('disciplines','id_foundation')){
				Widgets::dropDownSelectIdList('SELECT id_foundation,foundation_offices_fgos.name as o_name,spr_t_cabinet_fgos.name as c_name FROM foundation_offices_fgos INNER JOIN spr_t_cabinet_fgos ON id_t_cabinet = spr_t_cabinet_fgos.id WHERE id_ppssz = '.Auth::getInstance()->getTableFilter('disciplines','ppsz')
					.' ORDER BY c_name','id_foundation',array('c_name','o_name'),Auth::getInstance()->getTableFilter('disciplines','id_foundation'),'id_foundation',true,false);
			} 
			else Widgets::dropDownList('SELECT id_foundation,foundation_offices_fgos.name as o_name,spr_t_cabinet_fgos.name as c_name FROM foundation_offices_fgos INNER JOIN spr_t_cabinet_fgos ON id_t_cabinet = spr_t_cabinet_fgos.id WHERE id_ppssz = '.Auth::getInstance()->getTableFilter('disciplines','ppsz').' ORDER BY c_name','id_foundation',array('c_name','o_name'),'id_foundation',true,false); } else echo "<select disabled> </select>";?>
		</p>
		<p><span>Название</span>
	    	<input type='text' id='name' name='name' value="<?php if (Auth::getInstance()->isExsistsTableFilter('disciplines','name')) { echo Auth::getInstance()->getTableFilter('disciplines','name'); }?>">		
		</p>
		<p><span>Год</span>
	    	<input type='text' id='year_fgos' name='year_fgos' value="<?php if (Auth::getInstance()->isExsistsTableFilter('disciplines','year_fgos')) { echo Auth::getInstance()->getTableFilter('disciplines','year_fgos'); }?>">	
		</p>
		<p><span>Индекс дисциплины</span> 
	    	<input type='text' id='index_discipline' name='index_discipline' value="<?php if (Auth::getInstance()->isExsistsTableFilter('disciplines','index_discipline')) { echo Auth::getInstance()->getTableFilter('disciplines','index_discipline'); }?>">		
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
<form method="POST" action="/disciplines/add">
	<p>Новая запись</p><br>
	<p><span>Название</span>
    	<input required type='text' id='name' name='name'>		
	</p>
	<p><span>Индекс дисциплины</span>
    	<input required type='text' id='index_discipline' name='index_discipline'>		
	</p>
	<p><span>ППССЗ</span>
	<?php Widgets::dropDownList("SELECT * FROM spr_ppssz ORDER BY specialty","id_specialty",array('specialty','name'),"ppsz");?></p>
	<p><span>Год ФГОС</span>
    	<input type='text' id='year_fgos' name='year_fgos'>		
	</p>
	<p><span>Шифр</span><br>
<?php Widgets::dropDownList('SELECT * FROM spr_ciphers_disciplines','id_сiphers_dis',array('ciphers_dis','description'),'id_ciphers'); ?>
	</p>
	<p>
    <span>Фонд помещений</span><br>
    	<select id="id_foundation" name="id_foundation" disabled>
    		<option>Выберите ППССЗ</option>
    	</select>
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="8"><img src="/web/images/table.png">Дисциплины </td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> ППСCЗ </td>
	<td> Название </td>	
	<td> Год ФГОС </td>
	<td> Индекс дисциплины </td>
	<td> Тип помещения </td>	
	<td> Фонд помещений </td>	
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($DisciplinesList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_ppssz', array('specialty','name'), 'id_specialty', $item['ppsz']);?></td>
			<td><?php echo $item['name'];?></td>			
			<td><?php echo $item['year_fgos'];?></td>
			<td><?php echo $item['index_discipline'];?></td>
			<td><?php
			$id_t_cabinet = Widgets::getDataTableById('SELECT * FROM foundation_offices_fgos', 'id_t_cabinet', 'id_foundation', $item['id_foundation']);
			 echo Widgets::getDataTableById('SELECT * FROM spr_t_cabinet_fgos', 'name', 'id', $id_t_cabinet);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM foundation_offices_fgos', 'name', 'id_foundation', $item['id_foundation']);?></td>						
            <td>
                <a href="/disciplines/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="disciplines" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="8"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>