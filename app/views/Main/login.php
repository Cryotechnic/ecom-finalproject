<html>
	<head>
		<title>Login</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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