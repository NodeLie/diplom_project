<div class="join_block_left_form">
	<div id="filtration_form" class="EW_filtration_form">
		<form action="/san-pin/filtration" method="POST">
		<p>Фильтры</p>		
		<p><span>Название</span>
	    	<input type='text' id='indexx' name='indexx' value="<?php if (Auth::getInstance()->isExsistsTableFilter('sanpin','indexx')) { echo Auth::getInstance()->getTableFilter('sanpin','indexx'); }?>">		
		</p>
		<p><span>Шифр</span>
	    	<input type='text' id='cipher' name='cipher' value="<?php if (Auth::getInstance()->isExsistsTableFilter('sanpin','cipher')) { echo Auth::getInstance()->getTableFilter('sanpin','cipher'); }?>">	
		</p>
		<p><span>Единица измерения</span> 
	    	<input type='text' id='unit_measure' name='unit_measure' value="<?php if (Auth::getInstance()->isExsistsTableFilter('sanpin','unit_measure')) { echo Auth::getInstance()->getTableFilter('sanpin','unit_measure'); }?>">		
		</p>
		<p><span>Нормы СанПин</span> 
	    	<input type='text' id='norm_san_pin' name='norm_san_pin'  value="<?php if (Auth::getInstance()->isExsistsTableFilter('sanpin','norm_san_pin')) { echo Auth::getInstance()->getTableFilter('sanpin','norm_san_pin'); }?>">		
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
<form method="POST" action="/san-pin/add">
	<p>Новая запись</p><br>
	<p><span>Название</span>
    	<input required type='text' id='indexx' name='indexx'>		
	</p>	
	<p><span>Шифр</span>
    	<input required type='text' id='cipher' name='cipher'>		
	</p>
	<p><span>Единица измерения</span>
    	<input required type='text' id='unit_measure' name='unit_measure'>		
	</p>
	<p><span>Нормы СанПин</span>
    	<input required type='text' id='norm_san_pin' name='norm_san_pin'>		
	</p>
		<button type='submit' id='insert' name='insert'>Добавить</button>
</form>
</div>
</div>
<div id="table_wrapper">
<table id="main_table" class="TW_main_table">
<thead>
<tr>
	<td id="main_table_title" colspan="6"><img src="/web/images/table.png">СанПин</td>
</tr>
<tr>
	<td style="min-width: 25px">№</td>
	<td> Название </td>
	<td> Шифр </td>
	<td> Единица измерения </td>
	<td> Нормы СанПин </td>
	<td> </td>
</tr>
</thead>
<tbody id="main_table_body">
	<?php foreach ($SanPinList as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['indexx'];?></td>
			<td><?php echo $item['cipher'];?></td>
			<td><?php echo $item['unit_measure'];?></td>
			<td><?php echo $item['norm_san_pin'];?></td>
            <td>
                <a href="/san-pin/editfill/<?php echo $item['id']; ?>"><img src="/web/images/table_button_edit.png"></a>
                <img src="/web/images/table_button_delete.png" class="delete_button" data-table="san-pin" data-id="<?php echo $item['id']; ?>">
            </td>

		</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="6"><?php echo $pagination->get(); ?></td>
	</tr>
</tbody>
</table>

</div>