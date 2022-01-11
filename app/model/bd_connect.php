<?php


	$host      = 'localhost';		//	Addres host
	$user_name = 'root';		//	User name database
	$password  = '147852369';	//	DataBase password
	$name_db   = 'users';		//	Name table DataBase


	//	create object connected DataBase MySQL 8

	$connect = new mysqli($host, $user_name, $password, $name_db);

?>