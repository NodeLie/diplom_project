<div id="edit_data_table_form">
<form id="edit_form_fill" method='POST' action='/employee/edit-exec'>
 <p><span>pk pkc</span><br>
        <?php Widgets::dropDownSelectIdList('SELECT * FROM spr_pk_pks','id','name',$Employee->id_pk_pkc,'id_pk_pkc'); ?>
    </p>
<p>
    <span>type employee</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_t_employee','id','name',$Employee->id_type_employee,'id_type_employee'); ?>
</p>
<p>
    <span>posts</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_posts','id','name',$Employee->id_posts,'id_posts'); ?>
</p>
<p>
    <span>department</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM spr_department','id','name',$Employee->id_department,'id_department'); ?>
</p>
<p>
    <span>Права доступа</span><br>
    	<?php Widgets::dropDownSelectIdList('SELECT * FROM rules','id','name',$Employee->rules,'rules'); ?>
</p>
	<p><span>Имя</span>
    	<input type='text' id='name' name='name' value="<?php echo $Employee->name; ?>">		
	</p>
	<p><span>Фамилия</span>
    	<input type='text' id='surname' name='surname' value="<?php echo $Employee->surname; ?>">		
	</p>
	<p><span>Отчество</span>
    	<input type='text' id='patronymic' name='patronymic'  value="<?php echo $Employee->patronymic; ?>">	
	</p>
	<p><span>Логин</span>
    	<input type='text' id='login' name='login' value="<?php echo $Employee->login; ?>">		
	</p>
	<p><span>Пароль</span> 
    	<input type='password' id='password' name='password' value="<?php echo $Employee->password; ?>">		
	</p>   
	<br>
    <input type="hidden" name="id" value="<?php echo $Employee->id; ?>">
	<button type='submit' id='edit' name='edit'>Редактировать</button>
</form>
</div>