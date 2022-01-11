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

	function inputData($arr) {
		

		if(!empty($arr['input'])):

			include 'bd_connect.php';

			if(!empty($arr['login'])):

				$login = strtr(trim($arr['login']), array ('"' => '%', '\'' => '%', '--' => '%', '*' => '%'));

				if(!empty($arr['password'])):

					$password = strtr(trim($arr['password']), array ('"' => '%', '\'' => '%', '--' => '%', '*' => '%'));
					$sql = "SELECT password, user_id FROM tusers WHERE login = '$login'";
					$result = $connect->query($sql);
					$res = [];
					$connect->close();
					$res = $result->fetch_array(MYSQLI_ASSOC);


					if(password_verify($password, $res['password'])):


						$_SESSION['user_id'] = $res['user_id'];
						$_SESSION['login'] = $login;

					else:

						return 'Ошибка пароля';

					endif;

				else:

					return 'Введите пароль!!!';

				endif;

			else:

				return 'Введите логин!!!';

			endif;

		endif;

	}

	function outLog($arr) {
		if (!empty($arr['out'])):

			unset($_SESSION['user_id'], $_SESSION['login']);

		endif;
	}
}