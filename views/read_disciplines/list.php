<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/read-disciplines/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>Академический год</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('ReadDisciplines','id_academic_year')){
				Widgets::dropDownSelectIdList('SELECT * FROM academic_year','id','id',Auth::getInstance()->getTableFilter('ReadDisciplines','id_academic_year'),'id_academic_year',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM academic_year','id','id','id_academic_year',true,false); ?>
		</p>
		<p>
	    <span>Преподаватель</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('ReadDisciplines','id_employee')){
				Widgets::dropDownSelectIdList('SELECT * FROM employee','id',array('surname','name','patronymic'),Auth::getInstance()->getTableFilter('ReadDisciplines','id_employee'),'id_employee',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM employee','id',array('surname','name','patronymic'),'id_employee',true,false); ?>
		</p>
		<p>
	    <span>Дисциплина</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('ReadDisciplines','id_disciplines')){
				Widgets::dropDownSelectIdList('SELECT * FROM disciplines','id', array('index_discipline','name'), Auth::getInstance()->getTableFilter('ReadDisciplines','id_disciplines'),'id_disciplines',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM disciplines','id',array('index_discipline','name'),'id_disciplines',true,false); ?>
		</p>
		<p>
			<input type="submit" id='filtration_form_submit' name='filtration_form_submit' value="Применить ">
		</p>
		<p>
			<input type="submit"  id='filtration_form_submit' name='filtration_form_reset' value="Очистить">
		</p>    		
    	</form>
	</div>
<div id="add_data_table_form" class="TW_add_data_table_form">
<form method="POST" action="/read-disciplines/add">
	<p>Новая запись</p><br>
	<p><span>Академический год</span><br>
	<?php Widgets::dropDownList('SELECT * FROM academic_year','id','id','id_academic_year'); ?>
	</p>
	<p><span>Преподаватель</span><br>
<?php Widgets::dropDownList('SELECT * FROM employee','id',array('surname','name','patronymic'),'id_employee'); ?>
	</p>
	<p>
    <span>Дисциплина</span><br>
    	<?php Widgets::dropDownList('SELECT * FROM disciplines','id',array('index_discipline','name'),'id_disciplines'); ?>
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="5"><img src="/web/images/table.png">Читаемые дисциплины</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Академический год </td>
	<td> Преподаватель </td>
	<td> Дисциплина </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($ReadDisciplinesList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['id_academic_year'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM employee', array('surname','name','patronymic'), 'id', $item['id_employee']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM disciplines', array('index_discipline','name'), 'id', $item['id_disciplines']);?></td>		
            <td>
                <a href="/read-disciplines/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="read-disciplines" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="5"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>