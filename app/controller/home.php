<?php
spl_autoload_register(function ($class) {

	$path = 'app/model/'.$class.'.php';

	if(file_exists($path)):

		include "$path";

	else:

		echo 'Файл '.$path.'.php не найден!!!';
		exit();

	endif;
	
});

$user = new Users();

$error = $user->inputData($_POST);
$user->outLog($_POST);


include 'app/view/home.php';