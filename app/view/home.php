	<section class="wrapper">
		<section class="wrapper-form">
			<h1><?php if(!empty($error)) echo $error; 
			if(!empty($_SESSION['login']))echo "Добро пожаловать {$_SESSION['login']}"; 
			if(!empty($del))echo "Аккаунт удален!!!"; ?></h1>
			<form action="?page=home" method="POST">
				<?php if(empty($_SESSION['user_id'])): ?>

					<input class="inputLine" type="text" name="login" placeholder="Введите логин">
					<input class="inputLine" type="password" name="password" placeholder="Введите пароль">
					<input class="inputKey" type="submit" name="input" value="Вход">

				<?php else: ?>

					<input class="inputKey" type="submit" name="out" value="Выход">
					<input class="inputKey" type="submit" name="del" value="Удалить">
					
				<?php endif; ?>
			</form>
			<a href="?page=registration">Регистрация</a>

		</section>
	</section>