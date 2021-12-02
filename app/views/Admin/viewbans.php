<html>
    <head>
        <title>Banned Users</title>
    </head>
    <body>
        <h1>Banned users</h1>
        <a href="/Admin/index">Go back</a>
    <br>
        <?php

        $users = new \app\models\User();
        $users = $users->getBannedUsers();

        foreach($users as $user){
            echo "<tr>
			<td>$user->username</td>
			<td>
				<a href='/Admin/unbanuser/$user->user_id'>unban</a>
			</td>
		</tr>";
        }
        ?>
    </body>

</html>