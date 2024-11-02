<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/workplace-teacher/filtration" method="POST">
		<p>Фильтры</p>		
		<p><span>Аудитория</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('WorkplaceTeacher','audience')){
				Widgets::dropDownSelectIdList('SELECT * FROM audience ORDER BY number','id','number',Auth::getInstance()->getTableFilter('WorkplaceTeacher','audience'),'audience',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM audience ORDER BY number','id','number','audience',true,false); ?>
		</p>
		<p><span>Название</span>
	    	<input type='text' id='name' name='name' value="<?php if (Auth::getInstance()->isExsistsTableFilter('WorkplaceTeacher','name')) { echo Auth::getInstance()->getTableFilter('WorkplaceTeacher','name'); }?>">		
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
<form method="POST" action="/workplace-teacher/add">
	<p>Новая запись</p><br>
	<p><span>Название</span>
    	<input required type='text' id='name' name='name'>		
	</p>
	<p><span>Количество</span>
    	<input required type='text' id='count' name='count'>		
	</p>
	<p><span>Аудитория</span><br>
<?php Widgets::dropDownList('SELECT * FROM audience','id','number','audience'); ?>
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
	</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="5"><img src="/web/images/table.png">Рабочее место преподавателя</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Название </td>
	<td> Количество </td>
	<td> Аудитория </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($WorkplaceTeacherList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['count'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM audience', 'number', 'id', $item['audience']);?></td>
            <td>
                <a href="/workplace-teacher/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="workplace-teacher" data-id="<?php echo $item['id']; ?>">
            </td>
		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="5"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>