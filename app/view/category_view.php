<h1>Спмсок категорий</h1>
<p>
	<table>
		Список всех категорий блога.
		<tr><td>Name</td><td>Amount of articles</td><td>Preview</td></tr>
		<?php
			foreach ($data as $item) {
				echo '<tr><td>' . $item['name'] . '</td><td>' . count($item['text']) . '</td><td>' . $item[''] . '</td></tr>';
			}
		?>
	</table>
</p>