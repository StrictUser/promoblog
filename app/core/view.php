<?php
	class View
	{
		public function generate($content_view, $template_view, $data = null){
			/*if(is_array($data)){
				extract($data);
			}*/

			include 'app/view/' . $template_view;
		}
	}