<h1>Добро пожаловать!</h1>

<section class="box">
	<p>
		<img src="img/office-small.jpg" align="left">
	</p>
</section>
<section class="last-posted">

	<?php foreach($data as $article):?>

			<article>
				<form action="/promo/article/" method="post">
					<h3><?php echo $article['title']; ?></a></h3>
					<div class="preview-text">
						<?php echo $article['text']; ?>
					</div>
					<span>
						<?php echo $article['date']; ?>
					</span>
					<p>
						<?php echo $article['category']; ?>
					</p>
					<input type="submit" name="read" value="Read full text">
					<input type="hidden" name="action" value="view">
					<input type="hidden" name="id" value="<?php echo $article['id']; ?>" formmethod="get">
				</form>

			</article>
		<br>

	<?php endforeach;?>
</section>