<html>
	<head>
		<title>Register</title>
	</head>
	<body>
	<?php 
		if($data != null) {
			echo $data;
			echo "<br>";
		}
	?>
		Register a new user or <a href="/Main/login">Login</a> with your credentials
		<form action='' method='post'>
			Username: <input type='text' name='username' /><br>
			Password: <input type='password' name='password' /><br>
			Password confirmation: <input type='password' name='password_confirm' /><br>
			<input type='submit' name='action' value='Register' />
		</form>
	</body>
</html>