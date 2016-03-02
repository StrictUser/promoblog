<h1>Список категорий</h1>

	<div class="categories">
		<table style="border-collapse: collapse; border: 1px solid black;">
			<caption>Список всех категорий блога.</caption>
			<tr>
				<th>Name</th>
				<th>Amount of articles</th>
			</tr>

			<tr>
				<?php foreach ($data as $item): ?>
					<td><?=$item['name']; ?></td>
					<td>some amount</td>
				<?php endforeach;?>

			</tr>

		</table>

	</div>
<p><?php var_dump($data);?></p>