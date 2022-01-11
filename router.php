<?php

	function router($page) {

		if(!empty($page['page'])):			// Check if the array is empty, if so then redirect to the home page
			
			$page = strtr(trim($page['page']), array ('"' => '%', '\'' => '%', '--' => '%', '*' => '%'));		// Escaping values
			$path = 'app/controller/'.$page.'.php';																// Creating a page path
			$getRow = count($_GET);																				// Counts the rows of an array

			if(file_exists($path) && $getRow  < 2):				// Make sure the file exists and there are less than two lines. If error then redirect to 404 page

				include "$path";

			else:

				include '404.php';

			endif;

		else:

			include 'app/view/home.php';

		endif;
	};


?>