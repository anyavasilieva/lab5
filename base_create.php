<?php

require_once 'setup.php';
require_once '_head.php';

$query = "SELECT * FROM information_schema.tables WHERE table_name = 'Shop' limit 1";
$result = $sql->query($query);

if ($result && $result->num_rows == 1){

	echo "<h2>Таблица Shop в базе есть.<br>Выход.</h2>";

} else {
	echo "<h2>Таблицы Shop в базе нет.<br>Создадим...</h2>";

	$query = "CREATE TABLE IF NOT EXISTS `Shop` (
			`ID` int(11) NOT NULL AUTO_INCREMENT,
			`Created` datetime NOT NULL,
			`Name` varchar(255) NOT NULL,
			`Color` varchar(32) NOT NULL,
			`Price` int(11) NOT NULL,
			`Text` text NOT NULL,
			PRIMARY KEY (`ID`)
		   ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

	$result = $sql->query($query);
	$sql->close();

	echo "<h2>Таблица создана. Выход.</h2>";
}

echo "<p><a href='list.php' class='but'>Список товаров</a></p>";


require_once '_footer.php';
?>