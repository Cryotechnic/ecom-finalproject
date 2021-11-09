<html>
	<head>
		<title>Login</title>
	</head>
	<body>
	<?php 
		if($data != null) {
			echo $data;
		}
	?>
	Login to an existing user or <a href="/Main/register">Register</a> a new user
		<form action='' method='post'>
			Username: <input type='text' name='username' /><br>
			Password: <input type='password' name='password' /><br>
			<input type='submit' name="action" value='Login' />
		</form>
	</body>
</html>