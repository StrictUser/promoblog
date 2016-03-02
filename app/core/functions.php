<?php
		function html($text)
		{
			return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
		}

		function markdown2html($text)
		{
			$text = html($text);

			// Преобразуем стиль Windows (\r\n) в Unix (\n).
			$text = str_replace("\r\n", "\n", $text);

			// Преобразуем стиль Macintosh (\r) в Unix (\n).
			$text = str_replace("\r", "\n", $text);

			// Абзацы
			$text = '<p>' . str_replace("\n\n", '</p><p>', $text) . '</p>';

			// Разрывы строк
			$text = str_replace("\n", '<br>', $text);

			// [текст ссылки](адрес URL)
			$text = preg_replace('/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i',
				'<a href="$2">$l</a>', $text);

			return $text;
		}

		function clean_query($query)
		{
			$query = strip_tags($query);
			$query = htmlentities($query);
			$query = stripslashes($query);

			return $query;
		}

		function destroy_session()
		{
			$_SESSION = array();

			if (session_id() != "" || isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 2592000, '/');
			}
			session_destroy();
		}

		function create_password()
		{
			$salt1 = 'asdfZXc34sddfthgjlggq5';
			$salt2 = 'zdMKFayIGjhaYEsQ';
			$tmo_pass = hash('ripemd128', "$salt2$salt1");

			return substr($tmo_pass, mt_rand(0, 32), 8);
		}