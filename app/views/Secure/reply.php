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

        $post = new \app\models\Post();
        $post = $post->getByPostId($data);
	?>
		Reply to post: <?php echo $post->title ?>
		<form action='' method='post'>
			Reply content: <br>
            <textarea name='description' placeholder='Content'></textarea><br>
			<input type='submit' name='action' value='Reply' />
		</form>
	</body>
</html>

