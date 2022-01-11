<?php

	function router($page) {

		if(!empty($page['page'])):
			
			$page = strtr(trim($page['page']), array ('"' => '%', '\'' => '%', '--' => '%', '*' => '%'));
			$path = 'app/controller/'.$page.'.php';
			$getRow = count($_GET);

			if(file_exists($path) && $getRow  < 2):

				include "$path";

			else:

				include '404.php';

			endif;

		else:

			include 'app/view/home.php';

		endif;
	};


?>