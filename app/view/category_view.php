<h1>Список категорий</h1>

	<div class="categories">
		<form action="" method="post">
			<?php foreach ($data as $item): ?>
				<p>Category name: <a href="view_category/"><?=$item['name']; ?></a>
				<span> Amount of articles in category: <?=$item['amount']; ?></span></p>
				<input type="hidden" name="action" value="follow">
				<input type="hidden" name="id" value="<?=$item['id']; ?>">
			<?php endforeach;?>
		</form>
	</div>