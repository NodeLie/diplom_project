<?php
class RoomLayout
{
    public  function getImageById($id)
    {
        $db = DataBase::getInstance()->getDb();

        // Текст запроса к БД
        $sql = 'SELECT path_electric, path_tables FROM audience WHERE id=:id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $row=$result->fetch();
        echo "<img src='/web/images/".$row['path_electric']."'> <br>";
        echo "<img src='/web/images/".$row['path_tables']."'>";
    }
}