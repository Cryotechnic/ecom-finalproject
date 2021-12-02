<html>
	<head>
		<title>Edit your post</title>
	</head>
	<body>
        <?php
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);
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
		Edit your Profile:
		<form action='' method='post'>
			Location: <input style="width:300px;" type='text' name='location' value="<?= $user->location ?>"/><br>
			Date of Birth: <input type='date' name='date' value='<?=$user->dob?>'/><br>
            Bio: <br>
            <textarea name='description' placeholder='Bio'><?= $user->bio ?></textarea><br>
			<input type='submit' name='action' value='Update' />
		</form>
	</body>
</html>

