<?php

class Users {
	
	function registration($arr) {

		

		if(!empty($arr['input'])):	

			include 'bd_connect.php';

			if(!empty($arr['login'])):					

				$login = strtr(trim($arr['login']), array ('"' => '%', '\'' => '%', '--' => '%', '*' => '%'));
				$sql = "SELECT login FROM tusers WHERE login = '$login'";
				$result = $connect->query($sql);
				$res = $result->fetch_assoc();

				if(!$res):

					if(!empty($arr['email'])):

						$email = strtr(trim($arr['email']), array ('"' => '%', '\'' => '%', '--' => '%', '*' => '%'));
						$sql = "SELECT email FROM tusers WHERE email = '$email'";
						$result = $connect->query($sql);
						$res = $result->fetch_assoc();
						

						if(!$res):

							if(!empty($arr['password'])):

								$password = password_hash($arr['password'], PASSWORD_DEFAULT);
								$sql = "INSERT INTO tusers (login, password, email) VALUES ('$login', '$password', '$email')";
								$result = $connect->query($sql);
								$connect->close();

								if($result === true):

									unset($login, $password, $email, $res);
									header('location: ./index.php?page=home');
									exit();


								else:

									$connect->close();
									return 'Ошибка при регистрации!!!';

								endif;


							else:

								$connect->close();
								return 'Введите пароль!!!';

							endif;


						else:

							$connect->close();
							return 'Такой Email уже зарегистрирован!!!';

						endif;


					else:

						$connect->close();
						return 'Введите Email!!!';

					endif;


				else:

					$connect->close();
					return 'Логин занят!!!';

				endif;


			else:

				return 'Введите логин!!!';

			endif;


		endif;

	}


	// Login function

	function inputData($arr) {
		

		if(!empty($arr['input'])):					// Checking an array value to check if a button is pressed

			include 'bd_connect.php';				// Include the MySQL database configuration file.

			if(!empty($arr['login'])):				// Checking an array for a name value

				$login = strtr(trim($arr['login']), array ('"' => '%', '\'' => '%', '--' => '%', '*' => '%'));					// Escaping username from SQL injections

				if(!empty($arr['password'])):																					// Checking an array for a password value

					$password = strtr(trim($arr['password']), array ('"' => '%', '\'' => '%', '--' => '%', '*' => '%'));		// Escaping password from SQL injections
					$sql = "SELECT password, user_id FROM tusers WHERE login = '$login'";										// SQL query to get password hash
					$result = $connect->query($sql);						// Sending an SQL query to the database
					$res = [];
					$connect->close();
					$res = $result->fetch_array(MYSQLI_ASSOC);


					if(!empty($res)):

						if(password_verify($password, $res['password'])):		// Comparing password hash with user password

							$_SESSION['user_id'] = $res['user_id'];
							$_SESSION['login'] = $login;

						else:

							return 'Ошибка пароля';

						endif;

					else:

						return 'Не верный логин!!!';

					endif;

				else:

					return 'Введите пароль!!!';

				endif;

			else:

				return 'Введите логин!!!';

			endif;

		endif;

	}


	// Function out login

	function outLog($arr) {	
		if (!empty($arr['out'])):									// Checking the array value of the pressed button

			unset($_SESSION['user_id'], $_SESSION['login']);		// Delite the valye of the SESSION array

		endif;								
	}
}