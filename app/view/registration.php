	<section class="wrapper">
		<section class="wrapper-form">
			<h1><?php if(!empty($error)) echo $error; ?></h1>
			<form method="POST">
				<input class="inputLine" type="text" name="login" placeholder="Введите логин">
				<input class="inputLine" type="password" name="password" placeholder="Введите пароль">
				<input class="inputLine" type="email" name="email" placeholder="Введите email">
				<input class="inputKey" type="submit" name="input" value="Зарегистрировать">
			</form>
			<a href="/">Назад</a>
		</section>
	</section>