<section class="box">
	<p>
		<img src="/promo/img/office-full.jpg" align="left">
	</p>
</section>
<section class="last-posted">

	<?php foreach($data as $article):?>

		<article>
			<h3><?php echo $article['title']; ?></h3>
			<div class="full-text">
				<?php echo $article['text']; ?>
			</div>
			<span>
				<?php echo $article['date']; ?>
			</span>
			<p>
				<?php echo $article['category']; ?>
			</p>
			<textarea rows="5" cols="60" title="comment"></textarea>
			<input type="submit" name="comment" value="Add comment">
			<input type="hidden" name="id" value="<?php echo $article['id'];?>">

		</article>

	<?php endforeach;?>
</section>