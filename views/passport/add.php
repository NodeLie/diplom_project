<div class="passport_form">
<? if (!empty($result)) {
 if($result == "Введены не все данные" || $result == "Произошла ошибка при добавлении паспорта"){ ?>
    <p>
        <span style="color:red;"><? echo $result;?></span>
    </p>
<? } else{ ?>
    <p>
        <span style="color:green;"><? echo $result;?></span>
    </p>
<? }} else { ?>
<form action="/passport/add" method="POST">   
    <p>
		<span>Специальность</span>
	    <?php Widgets::dropDownList('SELECT * FROM spr_ppssz','id_specialty',array('specialty','name'),'id_ppssz',false); ?>
    </p>
    <p>
		<span>Тип помещения</span>
	    <?php Widgets::dropDownList('SELECT * FROM spr_t_cabinet_fgos','id','name','id_t_cabinet',false); ?>
    </p>
	<p>
		<span>Фонд помещений</span>
	    <select required id="id_foundation" name="id_foundation" disabled>
	    	
	    </select>
    </p>
	<p>
		<span>Аудитория</span>
	    <select required id="audience" name="id_audience" disabled>
	    	
	    </select>
    </p>
	<p>
		<span>Дисциплина</span>
	    <select required id="disciplines" name="discipline" disabled>
	    	<option></option>
	    </select>
    </p>
    <p>№Протокола ПЦК <input required type="text" name="number_protokol">Дата утверждения <input required type="date" name="date_statement"></p>
    <div id="Instrs">
    <p id="InstrList">
		<span>Инструкции </span>
    </p>
    </div>
    <h4>Перспективное планирование</h4>
    <p><h5>Требуемое МТО (необязательно)</h5>
    	<table id="need_mto">
    		<thead>
    			<td>Оборудование, инструменты, ПО(+ссылка на объект в интернете)</td>
    			<td>Кол-во</td>
    			<td>Технические характеристики</td>
    		</thead>
    		<tbody>
    			
    		</tbody>
    	</table>
    	<button id='add_need_mto'>Добавить</button>
    </p>
     <p><h5>Виды деятельности (необязательно)</h5>
    	<table id="need_dop_work">
    		<thead>
    			<td>Виды деятельности заведующего лабораторией/мастерской</td>
    			<td>Примечание</td>	
    		</thead>
    		<tbody>
    			
    		</tbody>
    	</table>
    	<button id='add_need_dop_work'>Добавить</button>
    </p>
    <p>
        <h5>Дата ежегодной приемки</h5>
        От <input required type="date" name="date_priem">
    </p>
    <input type="submit" name="insert" value="Сформировать паспорт">
</form>
<?}?>
</div>