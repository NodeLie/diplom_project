<div class="passport_form">
<form action="/passport/edit-exec" method="POST">
	<p>
		<span>Специальность</span>
	    <?php Widgets::dropDownSelectIdList('SELECT * FROM spr_ppssz','id_specialty',array('specialty','name'),$Passport->id_ppssz,'id_ppssz',false); ?>
    </p>
    <p>
		<span>Тип кабинета</span>
	    <?php Widgets::dropDownSelectIdList('SELECT * FROM spr_t_cabinet_fgos','id','name',$Passport->id_t_cabinet,'id_t_cabinet',false); ?>
    </p>
	<p>
		<span>Фонд помещений</span>
	    <?php Widgets::dropDownSelectIdList("SELECT * FROM foundation_offices_fgos WHERE id_ppssz =".$Passport->id_ppssz." AND id_t_cabinet =".$Passport->id_t_cabinet,'id_foundation','name',$Passport->id_foundation,'id_foundation',false); ?>
    </p>
	<p>
		<span>Аудитория</span>
	    <?php if (Auth::getInstance()->compareRules(Auth::PASSPORTIST))
	    { 
	    	Widgets::dropDownSelectIdList("SELECT audience.id as audience, number FROM f_o_fgos_audience INNER JOIN (audience INNER JOIN audience_employee ON audience.id = audience_employee.id_audience) ON f_o_fgos_audience.id_audience = audience.id WHERE id_foundation =".$Passport->id_foundation,'audience','number',$Passport->id_audience,'audience',false); 
	 	} 
	 	else
	 	{
	 		 Widgets::dropDownSelectIdList("SELECT audience.id as audience, number FROM f_o_fgos_audience INNER JOIN (audience INNER JOIN audience_employee ON audience.id = audience_employee.id_audience) ON f_o_fgos_audience.id_audience = audience.id WHERE id_foundation =".$Passport->id_foundation." AND id_employee =".$_SESSION['Auth']['id'],'audience','number',$Passport->id_audience,'audience',false); 
	 	}?>
    </p>
    <p>
		<span>Дисциплина</span>
	    <?php Widgets::dropDownSelectIdList("SELECT * FROM disciplines WHERE id_foundation =".$Passport->id_foundation,'id',array('index_discipline','name','year_fgos'),$Passport->discipline,'discipline',false); ?>
    </p>
    <p>№Протокола ПЦК <input required type="text" name="number_protokol" value="<?echo $Passport->number_protokol?>">Дата утверждения <input required type="date" name="date_statement" value="<?echo $Passport->journal_date ?>"></p>
    <div style="color: gray;">
    <h5>2.3 Дидактические материалы</h5>
	<table id="passport_didact_mat">
		<thead>
			<tr>
				<td>Наименование</td>
				<td>Количество</td>				
			</tr>
		</thead>
		<tbody>
		<? if (!empty($Passport->didactMat)){	
		foreach ($Passport->didactMat as $item): ?>
		<tr>
			<td><? echo $item['didact_mat']; ?></td>
			<td><? echo $item['didact_mat_gty']; ?></td>
		</tr>		
		<?endforeach;} else{?>	
			<tr>
				<td align="center" colspan="2">Данных нет</td>				
			</tr>
		<?}?>
		</tbody>
	</table>
	</div>
	<div style="color: gray;">
	<h5>3.1 Инструкции</h5>
    <table id="passport_instr">
		<thead>
			<tr>
				<td>Название</td>			
			</tr>
		</thead>
		<tbody>	
			<? if (!empty($Passport->instr)){	
		foreach ($Passport->instr as $item): ?>
		<tr>
			<td><? echo $item['name']; ?></td>			
		</tr>		
		<?endforeach;} else{?>	
			<tr>
				<td align="center" colspan="2">Данных нет</td>				
			</tr>
		<?}?>	
		</tbody>
	</table>
	</div>
	<h5>3.3 Рабочее место</h5>
    <table  id="passport_workplace_teacher">
		<thead>
			<tr>
				<td>Наименование</td>
				<td>Инвентарный номер</td>
				<td>Количество</td>				
			</tr>
		</thead>
		<tbody>	
		<? if (!empty($Passport->workplace_teacher)){	
			$i=0;
		foreach ($Passport->workplace_teacher as $item): ?>
		<tr>
			<td><? echo $item['name']; ?></td>
			<td><input type="text" name="workplace_teacher[<?echo $i;?>][invent]" value = "<? echo $item['invent']; ?>"></td>
			<td><input type="text" name="workplace_teacher[<?echo $i;?>][Count]" value = "<? echo $item['Count']; ?>"></td>
			<input type="hidden" name="workplace_teacher[<?echo $i;?>][id]" value = "<?php echo $item['id']; ?>">
		</tr>
		<? $i++; ?>		
		<?endforeach;} else{?>	
			<tr>
				<td align="center" colspan="2">Данных нет</td>				
			</tr>
		<?}?>		
		</tbody>
	</table> 
	<div style="color: gray;">
	<h5>4 Материально-техническое оснащение</h5>
	<table  id="passport_tools">
		<thead>
			<tr>
				<td>Наименование</td>
				<td>Инвентарный номер</td>
				<td>Количество</td>
				<td>Год приобретения</td>			
			</tr>
		</thead>
		<tbody>	
		<? if (!empty($Passport->tools)){	
		foreach ($Passport->tools as $item): ?>
		<tr>
			<td><? echo $item['name']; ?></td>
			<td><? echo $item['invent']; ?></td>
			<td><? echo $item['Count']; ?></td>
			<td><? echo $item['year_purchase']; ?></td>
		</tr>		
		<?endforeach;} else{?>	
			<tr>
				<td align="center" colspan="2">Данных нет</td>				
			</tr>
		<?}?>		
		</tbody>
	</table>
	</div>
	<h5>7.1 Соответсвие площади технологическим нормам</h5>
	<p>
		<span>Количество учебных мест</span>
	    <input type="text" name="number_jobs" value="<?echo $Passport->number_jobs?>">
    </p>
    <p>
		<span>Количество учебных мест</span>
	    <input type="text" name="number_special_jobs" value="<?echo $Passport->number_special_jobs?>">
    </p>  
    <h5>7.2 Температурный режим</h5>
	<table>
		<thead>
			<tr>
				<td>Температура в летний период град. С</td>
				<td>Температура в зимний период град. С</td>				
			</tr>
		</thead>
		<tbody>			
			<tr>				
				<td><input type="text" name="fact_light_estestvennaya" value="<?echo $Passport->fact_light_estestvennaya?>"></td>
				<td><input type="text" name="fact_light_estestvennaya" value="<?echo $Passport->fact_light_estestvennaya?>"></td>
			</tr>			
		</tbody>
	</table>
<!--
    <h5>7.3 Источники шума</h5>
	<table id="ist_shum" border="1">
		<thead>
			<tr>
				<td>Фактический уровень шума, Дб</td>
				<td>Источник шума</td>				
			</tr>
		</thead>
		<tbody>
		<? if (!empty($Passport->ist_shum)){	
		foreach ($Passport->ist_shum as $item): ?>
		<tr>
			<td><? echo $item['name']; ?></td>
			<td><? echo $item['desciption']; ?></td>
		</tr>		
		<?endforeach;} else{?>	
			<tr>
				<td align="center" colspan="2">Данных нет</td>				
			</tr>
		<?}?>								
		</tbody>
	</table>
	<button id="add_ist_shum">Добавить</button>
-->
    <h5>7.4 Уровень освещенности</h5>
	<table>
		<thead>
			<tr>
				<td>Вид освещенности</td>
				<td>Фактическая освещенность</td>				
			</tr>
		</thead>
		<tbody>			
			<tr>				
				<td>Естественная, КЕО(%)</td>
				<td><input type="text" name="fact_light_estestvennaya" value="<?echo $Passport->fact_light_estestvennaya?>"></td>
			</tr>
			<tr>				
				<td>Искусственная, Люкс</td>
				<td><input type="text" name="fact_light_estestvennaya" value="<?echo $Passport->fact_light_estestvennaya?>"></td>
			</tr>
		</tbody>
	</table>
    <h5>7.5 Обеспечение спецодеждой и индивидуальными защитными средствами</h5>
	<table class="soot_temp" id="wear">
        <thead>
        <tr>
            <td>Наименование СО и индивидуальных ЗС</td>
            <td>Обеспеченность (%, шт.)</td>
        </tr>
        </thead>
        <tbody>
		<? if (!empty($Passport->wear)){	
		foreach ($Passport->wear as $item): ?>
		<tr>
			<td><? echo $item['name']; ?></td>
			<td><? echo $item['gty']; ?></td>
		</tr>		
		<?endforeach;} else{?>	
			<tr>
				<td align="center" colspan="2">Данных нет</td>				
			</tr>
		<?}?>
        </tbody>
    </table>
    <button id="add_wear">Добавить</button>
    <h5>8.1 Требуемое материально-техническое оснащение</h5>
	<table id="passport_perspect">
		<thead>
			<tr>
				<td>Наименование</td>
				<td>Количество</td>
				<td>Примечание</td>
				<td></td>				
			</tr>
		</thead>
		<tbody>
		<? if (!empty($Passport->perspect)){	
		foreach ($Passport->perspect as $item): ?>
		<tr>
			<td><? echo $item['name']; ?></td>
			<td><? echo $item['qty']; ?></td>
			<td><? echo $item['description']; ?></td>
			<td><img src="/web/images/table_button_delete.png" class="delete_button" data-table="perspect" data-id="<?php echo $item['id']; ?>"></td>
		</tr>		
		<?endforeach;} else{?>	
			<tr>
				<td align="center" colspan="4">Данных нет</td>				
			</tr>
		<?}?>
		</tbody>
	</table>
	<button id="add_perspect">Добавить</button>
    <h5>8.2 Виды деятельности заведующего лабораторией/мастерской</h5>
	<table id="passport_dop_work">
		<thead>
			<tr>
				<td>Наименование</td>
				<td>Примечание</td>
				<td></td>					
			</tr>
		</thead>
		<tbody>
		<? if (!empty($Passport->dopWork)){	
		foreach ($Passport->dopWork as $item): ?>
		<tr>
			<td><? echo $item['name']; ?></td>
			<td><? echo $item['description']; ?></td>
			<td><img src="/web/images/table_button_delete.png" class="delete_button" data-table="dop-work" data-id="<?php echo $item['id']; ?>"></td>
		</tr>		
		<?endforeach;} else{?>	
			<tr>
				<td align="center" colspan="3">Данных нет</td>				
			</tr>
		<?}?>
		</tbody>
	</table>
	<button id="add_dop_work">Добавить</button>
    <h5>9. Дата ежегодной приемки</h5>
    <p>От <input type="date" name="date_priem" value="<?php echo $Passport->date_priem ?>"></p>
     <input type="hidden" name="id" value="<?php echo $Passport->id; ?>">
    <input type="submit" name="edit_passport" value="Применить изменения">
</form>
</div>