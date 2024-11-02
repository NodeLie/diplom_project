<div id="add_fgos_instr" style="height: 100%; width: 70%; margin: auto;">
<form method="POST" action="/foundation-fgos-instr/add">
		<p>Новая запись</p>
		<p><span>ППССЗ</span><br>
			<?php Widgets::dropDownList('SELECT * FROM spr_ppssz ORDER BY specialty','id_specialty',array('specialty','name'),'ppsz'); ?>
		</p>
		<p>
	    <span>Фонд помещений</span><br>
	    	<select required id = 'id_foundation' name="id_foundation" disabled>
	    		<option>Выберите ППССЗ</option>
	    	</select>
		</p>
		<p><span>Инструкции</span><br>
			<?php Widgets::dropDownMultipleList('SELECT * FROM spr_instr','id','name','id_instr',false); ?>
		</p>		
			<button type='submit' id='insert' name='insert'>Добавить</button>
</form>
</div>