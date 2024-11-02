<!--<div class="join_block_left_form">

</div>-->
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="7"><img src="/web/images/table.png">Паспорта преподавателя</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Аудитория </td>
	<td> Тип </td>
	<td> Помещение </td>
	<td> Специальность </td>
	<td> Дисциплина </td>
	<td></td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($PassportList as $item): ?>
		<tr>
			<td><?php echo $item['passport_id'];?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM audience', 'number', 'id', $item['id_audience']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT spr_t_cabinet_fgos.name as type_cabinet FROM spr_t_cabinet_fgos INNER JOIN foundation_offices_fgos ON id_t_cabinet = id','type_cabinet', 'id_foundation', $item['id_foundation']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM foundation_offices_fgos','name', 'id_foundation', $item['id_foundation']);?></td>			
			<td><?php echo Widgets::getDataTableById('SELECT specialty FROM spr_ppssz INNER JOIN foundation_offices_fgos ON id_ppssz = id_specialty','specialty', 'id_foundation', $item['id_foundation']);?></td>
			<td><?php echo Widgets::getDataTableById('SELECT * FROM disciplines',array('index_discipline','name','year_fgos'), 'id', $item['discipline']);?></td>
            <td>
                <a href="/passport/editfill/<?php echo $item['passport_id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="passport" data-id="<?php echo $item['passport_id']; ?>">

                <? if ($_SESSION['Auth']['rules'] == 4) {?>
                <a href="/passport/print/<?php echo $item['passport_id']; ?>"><img src="/web/images/print_submit.png"></a>
                <? }?>
                
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="7"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>