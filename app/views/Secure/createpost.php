<html>
	<head>
		<title>Create a new Post</title>
	</head>
	<body>
	<?php 
		if($data != null) {
			echo $data;
			echo "<br>";
		}
	?>
		Create a new Post:
		<form action='' method='post'>
			Title of your post: <input type='text' name='title' /><br>
            <textarea name='description' placeholder='Content'></textarea><br>
			<input type='submit' name='action' value='Create' />
		</form>
	</body>
</html>

