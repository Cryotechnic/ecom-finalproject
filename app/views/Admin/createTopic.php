<html>
	<head>
		<title>Create a new form</title>
	</head>
	<body>
	<?php 
		if($data != null) {
			echo $data;
			echo "<br>";
		}
	?>
		Create a new topic:
		<form action='' method='post'>
			Title: <input type='text' name='title' /><br>
            <textarea name='description' placeholder='Description'></textarea><br>
			<input type='submit' name='action' value='Create' />
		</form>
	</body>
</html>

