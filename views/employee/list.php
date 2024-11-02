<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/employee/filtration" method="POST">
		<p>Фильтры</p>
		<p><span>Отделение</span><br>
			<?php if (Auth::getInstance()->isExsistsTableFilter('employee','id_department')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_department','id',array('id','name'),Auth::getInstance()->getTableFilter('employee','id_department'),'id_department',true,false);
			}
			else Widgets::dropDownList('SELECT * FROM spr_department','id',array('id','name'),'id_department',true,false); ?>
		</p>
		<p>
	    <span>ПК ПЦК</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('employee','id_pk_pkc')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_pk_pks','id',array('id','cipher','name'),Auth::getInstance()->getTableFilter('employee','id_pk_pkc'),'id_pk_pkc',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM spr_pk_pks','id',array('id','cipher','name'),'id_pk_pkc',true,false); ?>
		</p>
		<p>
	    <span>Тип занятости</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('employee','id_type_employee')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_t_employee','id','name',Auth::getInstance()->getTableFilter('employee','id_type_employee'),'id_type_employee',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM spr_t_employee','id','name','id_type_employee',true,false); ?>
		</p>
		<p>
	    <span>Должность</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('employee','id_posts')){
				Widgets::dropDownSelectIdList('SELECT * FROM spr_posts','id','name',Auth::getInstance()->getTableFilter('employee','id_posts'),'id_posts',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM spr_posts','id','name','id_posts',true,false); ?>
		</p>
		<p>
	    <span>Права доступа</span><br>
	    	<?php if (Auth::getInstance()->isExsistsTableFilter('employee','rules')){
				Widgets::dropDownSelectIdList('SELECT * FROM rules','id','name',Auth::getInstance()->getTableFilter('employee','rules'),'id_posts',true,false);
			} 
			else Widgets::dropDownList('SELECT * FROM rules','id','name','rules',true,false); ?>
		</p>
		<p><span>Фамилия</span>
	    	<input type='text' id='surname' name='surname' value="<?php if (Auth::getInstance()->isExsistsTableFilter('employee','surname')) { echo Auth::getInstance()->getTableFilter('employee','surname'); }?>">		
		</p>
		<p><span>Имя</span>
	    	<input type='text' id='name' name='name' value="<?php if (Auth::getInstance()->isExsistsTableFilter('employee','name')) { echo Auth::getInstance()->getTableFilter('employee','name'); }?>">		
		</p>
		<p><span>Отчество</span>
	    	<input type='text' id='patronymic' name='patronymic' value="<?php if (Auth::getInstance()->isExsistsTableFilter('employee','patronymic')) { echo Auth::getInstance()->getTableFilter('employee','patronymic'); }?>">		
		</p>		
		<p><span>Логин</span> 
	    	<input type='text' id='login' name='login' value="<?php if (Auth::getInstance()->isExsistsTableFilter('employee','login')) { echo Auth::getInstance()->getTableFilter('employee','login'); }?>">		
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
<form method="POST" action="/employee/add">
	<p>Новая запись</p><br>	
	<p><span>ПК ПЦК</span><br>
        <?php Widgets::dropDownList('SELECT * FROM spr_pk_pks','id',array('id','cipher','name'),'id_pk_pkc'); ?>
    </p>
<p>
    <span>Тип занятости</span><br>
    	<?php Widgets::dropDownList('SELECT * FROM spr_t_employee','id','name','id_type_employee'); ?>
</p>
<p>
    <span>Должность</span><br>
    	<?php Widgets::dropDownList('SELECT * FROM spr_posts','id','name','id_posts'); ?>
</p>
<p>
    <span>Отделение</span><br>
    	<?php Widgets::dropDownList('SELECT * FROM spr_department','id','name','id_department'); ?>
</p>
<p>
    <span>Права доступа</span><br>
    	<?php Widgets::dropDownList('SELECT * FROM rules','id','name','rules'); ?>
</p>
	<p><span>Имя</span>
    	<input required type='text' id='name' name='name'>		
	</p>
	<p><span>Фамилия</span>
    	<input required type='text' id='surname' name='surname'>		
	</p>
	<p><span>Отчество</span>
    	<input required type='text' id='patronymic' name='patronymic'>	
	</p>
	<p><span>Логин</span>
    	<input required type='text' id='login' name='login'>		
	</p>
	<p><span>Пароль</span> 
    	<input required type='password' id='password' name='password'>		
	</p>   
		<button type='submit' id='insert' name='insert'>Добавить</button>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="11"><img src="/web/images/table.png">Преподаватели</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Фамилия </td>
	<td> Имя </td>	
	<td> Отчество </td>
	<td> ПК ПЦК </td>
	<td> Отделение </td>
	<td> Тип занятости </td>
	<td> Должность </td>
	<td> Логин </td>
	<!--<td> Пароль </td>-->
	<td> Доступ </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($EmployeeList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['surname'];?></td>
			<td><?php echo $item['name'];?></td>			
			<td><?php echo $item['patronymic'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_pk_pks', array('cipher','name'), 'id', $item['id_pk_pkc']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_department', array('id','name'), 'id', $item['id_department']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_t_employee', 'name', 'id', $item['id_type_employee']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM spr_posts', 'name', 'id', $item['id_posts']);?></td>
			<td><?php echo $item['login'];?></td>
			<!--<td><?php echo $item['password'];?></td>-->
			<td><?php echo Widgets::getDataTableById('SELECT * FROM rules', 'name', 'id', $item['rules']);?></td>
            <td>
                <a href="/employee/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="employee" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="11"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>