<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/ppssz/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>Отделение</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('ppssz','id_department')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_department','id',array('id','name'),Auth::getInstance()->getTableFilter('ppssz','id_department'),'id_department',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM spr_department','id',array('id','name'),'id_department',true,false); ?>
		</p>
		<p>
	    <span>Уровень обучения</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('ppssz','id_level_education')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_level_education','id','level',Auth::getInstance()->getTableFilter('ppssz','id_level_education'),'id_level_education',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM spr_level_education','id','level','id_level_education',true,false); ?>
		</p>
		<p><span>Код специальности</span>
	    	<input type='text' id='specialty' name='specialty' value="<?php if (Auth::getInstance()->isExsistsTableFilter('ppssz','specialty')) { echo Auth::getInstance()->getTableFilter('ppssz','specialty'); }?>">		
		</p>
		<p><span>Специальность</span>
	    	<input type='text' id='name' name='name' value="<?php if (Auth::getInstance()->isExsistsTableFilter('ppssz','name')) { echo Auth::getInstance()->getTableFilter('ppssz','name'); }?>">	
		</p>
		<p>
			<input type="submit" id='filtration_form_submit' name='filtration_form_submit' value="Применить">
		</p>
		<p>
			<input type="submit"  id='filtration_form_submit' name='filtration_form_reset' value="Очистить ">
		</p>    		
    	</form>
	</div>
<div id="add_data_table_form" class="TW_add_data_table_form">
<form method="POST" action="/ppssz/add">
	<p>Новая запись</p><br>
	<p><span>id</span>
    	<input required type='text' id='id_specialty' name='id_specialty'>	
	</p>
	<p><span>Код специальности</span>
    	<input required type='text' id='specialty' name='specialty'>		
	</p>
	<p><span>Специальность</span>
    	<input required type='text' id='name' name='name'>		
	</p>
	<p><span>Уровень обучения</span><br>
<?php Widgets::dropDownList('SELECT * FROM spr_level_education','id','level','id_level_education'); ?>
	</p>
		<p><span>Отделение</span><br>
<?php Widgets::dropDownList('SELECT * FROM spr_department','id','name','id_department'); ?>
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="6"><img src="/web/images/table.png">ППССЗ</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Код специальности </td>
	<td> Специальность </td>
	<td> Уровень обучения </td>
	<td> Отделение </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($ppsszList as $item): ?>
		<tr>
			<td><?php echo $item['id_specialty'];?></td>
			<td><?php echo $item['specialty'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_level_education', 'level', 'id', $item['id_level_education']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_department', array('id','name'), 'id', $item['id_department']);?></td>
            <td>
                <a href="/ppssz/editfill/<?php echo $item['id_specialty']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="ppssz" data-id="<?php echo $item['id_specialty']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="6"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>