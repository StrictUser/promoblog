<?php
	class View
	{
		public function generate($content_view, $template_view, $data = null){
			include 'app/view/' . $template_view;
			include 'app/view/' . $content_view;
		}
	}