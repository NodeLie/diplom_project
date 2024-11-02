<div class="join_block_left_form">
<form method="POST" action="/over-ten-years/export-excel">
	<p><span>Владелец</span>
    	<?php Widgets::dropDownSimple(array('Все','Туркина','Турбина','Чубаров'),'employee',0); ?>
	</p>	
	<input type="submit" id="export_excel_submit" name="export_excel_submit" value="Экспорт в Excel">
</form>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="4"><img src="/web/images/table.png">ПК (Кол-во записей: <?php echo $total; ?>)</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Название </td>
	<td> Год </td>
	<td> Owner </td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($OverTenYearsList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['year_purchase'];?></td>
			<td><?php echo $item['Owner'];?></td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="4"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>