<html>
	<head>
		<title>Edit your post</title>
	</head>
	<body>
        <?php
        
        $post = new \app\models\Post();
		$post = $post->getByPostId($data);
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        if($post->user_id != $user->user_id){
            echo "You are not allowed to edit this post<br>";
            echo '<a href="'.BASE.'/Main/index">Go back home</a><br>';
            return;   
        }
        
        ?>

        <?php
            if(isset($_SESSION['username'])){

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

	?>
		Edit your post:
		<form action='' method='post'>
			Title of your post: <input disabled type='text' name='title' value='<?= $post->title ?>'/><br>
            <textarea name='description' placeholder='Content'><?= $post->content ?></textarea><br>
			<input type='submit' name='action' value='Create' />
		</form>
	</body>
</html>

