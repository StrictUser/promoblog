<?php

	function html($text){
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