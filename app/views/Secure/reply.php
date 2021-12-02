<html>
	<head>
		<title>Reply to post</title>
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
        $post = $post->getByPostId($data['post_id']);
        $author = new \app\models\User();
        $author = $author->getById($post->user_id);
	?>
		Reply to post: <?php echo $post->title ?>
		<form action='' method='post'>
			Reply content: <br>
            <textarea name='description' placeholder='Content'>
                <?php 
                    if(isset($data['quote'])){
                        echo "\"";
                        echo $data['quote'];
                        echo "\"";
                        echo "\nWritten by: $author->username";
                        echo "\non: " . $post->created_at;
                    }
                ?>
            </textarea><br>
			<input type='submit' name='action' value='Reply' />
		</form>
	</body>
</html>

