<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./public/css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
	<title>Register account</title>
</head>
<body class="flex-row-center">
	<div class="card card-login flex-column">
		<h1 class="header">Keep<span class="highlight">Note</span></h1>
		<form action="/register" method="POST" class="flex-column">
			<input class="input" type="email" placeholder="email">
			<input class="input" type="password" placeholder="password">
			<input class="input" type="password" placeholder="confirm password">
			<button class="button" type="submit">Register</button>
			<div class="login-note">Already have an account? <a class="highlight" href="/login">Log in</a></div>
		</form>
	</div>
</body>
</html>