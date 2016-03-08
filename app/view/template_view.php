<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta charset="utf-8">
		<title>Промоблог - главная страница</title>
		<?php if($_SERVER['REQUEST_URI'] !== '/promo/') {
			echo '<link rel="stylesheet" type="text/css" href="../style/main.css">';
		}else{
			echo '<link rel="stylesheet" type="text/css" href="style/main.css">';
		}?>
	</head>
	<body>

		<div class="wrapper">
			<div id="header">
				<div id="logo">
					<a href="/promo/">Bla-Bla</span> <span class="cms">TEAM</span></a>
				</div>
				<div id="menu">
					<ul>
						<li class="first active"><a href="/promo/">Главная</a></li>
						<li><a href="/promo/category/">Категории</a></li>
					</ul>
					<br class="clearfix" />
				</div>
			</div>
		</div>

		<script src="js/jquery-1.12.0.js"></script>
	</body>
</html>