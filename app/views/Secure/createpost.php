<html>
	<head>
		<title>Create a new Post</title>
	</head>
	<body>
        <?php
            if(isset($_SESSION['username'])){
                $user = new \app\models\User();
                $user = $user->get($_SESSION['username']);
                if(isset($_SESSION['user_id'])){
                    echo 'Welcome, ' . $_SESSION['username'] . '! <br>';
                    echo '<a href="'.BASE.'/Main/logout">Logout</a>';
                } 
            } else {
                echo 'Welcome to the forum, login or register for full functionality!<br>';
                echo '<a href="'.BASE.'/Main/login">Login</a><br>';
                echo '<a href="'.BASE.'/Main/register">Register</a>';
            }
        ?>
    </body>
	<hr>
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
