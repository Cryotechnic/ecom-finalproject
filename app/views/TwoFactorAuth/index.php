<html>
	<head>
		<title>Create your Profile</title>
	</head>
	<body>
    <?php 
		if($data != null) {
			echo $data;
		}
	?>
    <br>
		<form action='' method='post'>
			Authenticator code: <input type='text' name='code'><br> 
			Not you? <a href='/Secure/logout'>Logout</a><br>
			<input type='submit' name="action" value='Verify Code' />
		</form>
	</body>
</html>