<?php
require_once 'setup.php';
require_once '_head.php';
?>

<h2>Список товаров</h2>

<?php
$query = 'select * from Shop order by ID';
$result = $sql->query($query);

if ($result->num_rows > 0){

	foreach($result as $p){

		echo "<div class='product'>";
		echo "<a href='index.php?id=".$p['ID']."'>".$p['Name']."</a> (".$p['Price']." руб.)";
		echo "</div>";
	}

} else {
	echo '<div class="info">Товаров нет.</div>';
}

?>

<hr>

<br>

<div>
<a href='create.php' class='but'>Добавить товар</a>
</div>

<?php
require_once '_footer.php';
?>