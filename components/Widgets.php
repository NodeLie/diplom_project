<?php

class Widgets 
{
	//Получить необходимые значений выбранных полей таблиц по id
	public static function getDataTableById($sql,$need,$dataId,$id,$separator = true)
    {
        if(empty($sql) or empty($id) or empty($need) or empty($dataId)){
            return false;
        }
        $db = DataBase::getInstance()->getDb();
        $return = "";
        $sql.=' WHERE '.$dataId.'='.$id;
   		$result = $db->prepare($sql);
        $result->execute();
        $row = $result->fetch();
        if (!is_array($need))
        {
        	$return = $row[$need];
        }
    	else
    	{
	        for ($i=0; $i < count($need); $i++)
	        { 
	        	if ($i != count($need)-1)
	        	{	        	
	        		$return.=$row[$need[$i]];

	        		if ($separator)
	        		{	        		
	        			$return.='| ';
	        		}
	        		else
	        		$return.=' ';
	        	} else $return.=$row[$need[$i]];
	        }
    	}
       	return $return;
       
    }

	// Выпадающий список с массивом
	public static function dropDownSimple($data,$name,$select = -1,$offset = 0)
	{
		echo "<select id='".$name."' name='".$name."'>
			  <option value=''></option>";

		for ($i = 0+$offset; $i < count($data)+$offset; $i++)
		{
			if ($select == $i)
				echo "<option value='".$data[$i]."' selected>".$data[$i]."</option>";
			else
				echo "<option value='".$data[$i]."'>".$data[$i]."</option>";
		}

		echo "</select>";
	}

	// Выпадающий список с использованием базы данных
	public static function dropDownList($sql,$fieldId,$fieldData,$name,$isEmpty = true,$required = true,$fieldForeignData = array())
	{
		$db = DataBase::getInstance()->getDb();
		$result = $db->prepare($sql);

		if (!empty($fieldForeignData)) // Внешние параметры
			$result->execute($fieldForeignData);
		else
			$result->execute();

		$result->execute();

		if ($result->rowCount() > 0)
		{
			if ($required)
			{
				echo "<select required id='".$name."' name='".$name."'>"; 
			} 
			else echo "<select id='".$name."' name='".$name."'>"; 
			if($isEmpty)
			{
				echo "<option value=''></option>";
			}
		}
		else
			echo "<select id='".$name."' name='".$name."' disabled>";

		while ($row = $result->fetch())
		{
			if (is_array($fieldData)) // Если массив с данными
			{
				$data = "";
				for ($i = 0; $i < count($fieldData); $i++)
					$data .= $row[$fieldData[$i]] . '|';

				echo "<option value='".$row[$fieldId]."'>".$data."</option>";
			}
			else
			{
				echo "<option value='".$row[$fieldId]."'>".$row[$fieldData]."</option>";
			}
		}

		echo "</select>";		
	}
	// Множественный список с использованием базы данных
	public static function dropDownMultipleList($sql,$fieldId,$fieldData,$name,$isEmpty = true,$required = true,$fieldForeignData = array())
	{
		$db = DataBase::getInstance()->getDb();
		$result = $db->prepare($sql);

		if (!empty($fieldForeignData)) // Внешние параметры
			$result->execute($fieldForeignData);
		else
			$result->execute();

		$result->execute();

		if ($result->rowCount() > 0)
		{
			if ($required) {
				echo "<select required multiple = 'multiple' id='".$name."' name='".$name."[]'>"; 
			} else
			echo "<select multiple = 'multiple' id='".$name."' name='".$name."[]'>"; 
			if($isEmpty)
			{
				echo "<option value=''></option>";
			}
		}
		else
			echo "<select id='".$name."' name='".$name."' disabled>";

		while ($row = $result->fetch())
		{
			if (is_array($fieldData)) // Если массив с данными
			{
				$data = "";
				for ($i = 0; $i < count($fieldData); $i++)
					$data .= $row[$fieldData[$i]] . '|';

				echo "<option value='".$row[$fieldId]."'>".$data."</option>";
			}
			else
			{
				echo "<option value='".$row[$fieldId]."'>".$row[$fieldData]."</option>";
			}
		}

		echo "</select>";		
	}
	// Множественный список с использованием базы данных и зарнее выбранный ID
	public static function dropDownMultipleSelectIdList($sql,$fieldId,$fieldData,$fieldSelectData,$name,$isEmpty = false,$fieldForeignData = array())
	{
		$db = DataBase::getInstance()->getDb();
		$result = $db->prepare($sql);

		if (!empty($fieldForeignData)) // Внешние параметры
			$result->execute($fieldForeignData);
		else
			$result->execute();

		echo "<select multiple id='".$name."' name='".$name."'>";

		if ($isEmpty)
			echo "<option value=''></option>";

		while ($row = $result->fetch())
		{
			if (is_array($fieldData)) // Если массив с данными
			{
				$data = "";
				for ($i = 0; $i < count($fieldData); $i++)
					$data .= $row[$fieldData[$i]] . '|';

				if ($fieldSelectData == $row[$fieldId])
					echo "<option value='".$row[$fieldId]."' selected>".$data."</option>";
				else
					echo "<option value='".$row[$fieldId]."'>".$data."</option>";
			}
			else
			{
				if ($fieldSelectData == $row[$fieldId])
					echo "<option value='".$row[$fieldId]."' selected>".$row[$fieldData]."</option>";
				else
					echo "<option value='".$row[$fieldId]."'>".$row[$fieldData]."</option>";
			}
		}

		echo "</select>";
	}
	// Выпадающий список с использованием базы данных и зарнее выбранный ID
	public static function dropDownSelectIdList($sql,$fieldId,$fieldData,$fieldSelectData,$name,$isEmpty = false,$required = true,$fieldForeignData = array())
	{
		$db = DataBase::getInstance()->getDb();
		$result = $db->prepare($sql);

		if (!empty($fieldForeignData)) // Внешние параметры
			$result->execute($fieldForeignData);
		else
			$result->execute();
		if ($required) {
			echo "<select required id='".$name."' name='".$name."'>";
		} else
		echo "<select id='".$name."' name='".$name."'>";

		if ($isEmpty)
			echo "<option value=''></option>";

		while ($row = $result->fetch())
		{
			if (is_array($fieldData)) // Если массив с данными
			{
				$data = "";
				for ($i = 0; $i < count($fieldData); $i++)
					$data .= $row[$fieldData[$i]] . '|';

				if ($fieldSelectData == $row[$fieldId])
					echo "<option value='".$row[$fieldId]."' selected>".$data."</option>";
				else
					echo "<option value='".$row[$fieldId]."'>".$data."</option>";
			}
			else
			{
				if ($fieldSelectData == $row[$fieldId])
					echo "<option value='".$row[$fieldId]."' selected>".$row[$fieldData]."</option>";
				else
					echo "<option value='".$row[$fieldId]."'>".$row[$fieldData]."</option>";
			}
		}

		echo "</select>";
	}

	// Форма удаления записи
	public static function dialogBoxConfirmDelete()
	{
		echo '<div id="back_dialog"></div>
		<div id="dialog_box_confirm">
		<div class="dialog_box_confirm_right_line"></div>
		<div class="dialog_box_confirm_left_line"></div>
    	<div class="dialog_box_confirm_title">
        	<span>Удаление записи</span>
    	</div>
		<div class="dialog_box_confirm_content">
			Вы уверены что хотите удалить выбранную запись?
		</div>
	
		<div class="dialog_box_confirm_footer">
			<button type="button" id="dialog_box_confirm_ok" name="dialog_box_confirm_ok">Да</button>
			<button type="button" id="dialog_box_confirm_cancel" name="dialog_box_confirm_cancel">Нет</button>
		</div>
		</div>';
	}
}
?>