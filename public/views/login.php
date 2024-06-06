<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./public/css/style.css">
	<link rel="stylesheet" href="./public/css/toast.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
	<title>KeepNote - Login</title>
</head>
<body class="flex-row-center">
	<div class="card card-login flex-column">
		<h1 class="header">Keep<span class="highlight">Note</span></h1>
		<form action="/login" method="POST" class="flex-column">
			<input class="input" type="email" name="email" placeholder="email">
			<input class="input" type="password" name="password" placeholder="password">
			<a class="login-note" style="align-self:end;" href="/forgot-password">Forgot password?</a>
			<button class="button" type="submit">Login</button>
			<div class="login-note">No account yet? <a class="highlight" href="/register">Create new!</a></div>
		</form>
	</div>
	<?php include VIEWS_PATH . 'shared/toasts.php' ?>
</body>
</html>