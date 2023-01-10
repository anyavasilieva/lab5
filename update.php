<?php
require_once 'setup.php';
require_once '_head.php';

$id = (int)($_POST['id'] ? $_POST['id'] : $_GET['id']);

$Action = $_POST['Action'];

$err = '';

if ($id > 0) {

	$query = 'select * from Shop where ID = '.$id;
	$product = $sql->query($query);

	if ($product && $product->num_rows == 1) {

		$product = $product->fetch_assoc();

		if ($Action == 'save') {

			$Name   = $_POST['Name'];
			$Color  = $_POST['Color'];
			$Price  = $_POST['Price'];
			$Text   = $_POST['Text'];

			if ($Name == '') {
				$err = 'Необходимо обязательно ввести <strong>Название товара</strong>.';
			} else if ($Price == '' || (int)$Price == 0) {
				$err = 'Необходимо обязательно ввести <strong>Цену товара</strong>.';
			} else {

				$Name = $sql->real_escape_string($Name);
				$Color = $sql->real_escape_string($Color);
				$Price = (int)$Price;
				$Text = $sql->real_escape_string($Text);

				$query = 'UPDATE Shop SET
						Name  = "'.$Name.'",
						Color = "'.$Color.'",
						Price = "'.$Price.'",
						Text  = "'.$Text.'"
						where ID = '.$id;
				$result = $sql->query($query);

				ob_clean();
				header('Location: index.php?save=ok&id='.$id);
			        exit;
			}

		} else {
			$Name = $product['Name'];
			$Color = $product['Color'];
			$Price = $product['Price'];
			$Text = $product['Text'];
		}

		?>

		<h2>Редактирование товара</h2>

		<?= ($err ? '<div class="err">'.$err.'</div>' : '') ?>

		<form action='update.php' method='POST'>
			<input type='hidden' name='Action' value='save'>
			<input type='hidden' name='id' value='<?= $id ?>'>

			Название товара (*):<br>
			<input type="text" name="Name" value="<?= htmlspecialchars($Name) ?>"><br><br>

			Цвет:<br>
			<input type="text" name="Color" value="<?= htmlspecialchars($Color) ?>"><br><br>

			Цена (*):<br>
			<input type="text" name="Price" value="<?= htmlspecialchars($Price) ?>"><br><br>

			Описание:<br>
			<textarea name="Text"><?= htmlspecialchars($Text) ?></textarea><br><br>

			<input type='submit' value='Сохранить изменения' class='but'>
		</form>

		<div>Товар создан: <?= $product['Created'] ?></div>

		<?php

	} else {
		echo '<div class="err">Товар с ID '.$id.' не найден.</div>';
	}

} else {
	echo '<div class="err">Ошибка! Не указан id товара в ссылке.</div>';
}

?>

<hr>

<br>

<div>
  <a href='list.php' class='but'>Список товаров</a>
  <a href='create.php' class='but'>Добавить товар</a>
</div>

<?php
require_once '_footer.php';
?>