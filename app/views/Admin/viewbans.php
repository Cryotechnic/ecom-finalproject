<html>
    <head>
        <title>Banned Users</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-md-auto gap-2">
                    <li class="nav-item rounded">
                        <a class="nav-link active" aria-current="page" href="/Main/index"><i class="bi bi-house-fill me-2"></i>Home</a>
                    </li>
                    <?php 
                            $user = new \app\models\User();
                            $user = $user->get($_SESSION['username']);
                        ?>
                    <li class="nav-item dropdown rounded">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill me-2"></i>Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if(isset($_SESSION['user_id'])){
                            echo "<li><a class='dropdown-item' href='/Main/user/".$user->user_id."'>Profile</a></li>";
                            echo "<li><a class='dropdown-item' href='/Main/logout'>Logout</a></li>";
                        } else {
                            echo "<li class='dropdown-item'><a href='/Main/login'>Login</a></li>";
                            echo "<li class='dropdown-item'><a href='/Main/register'>Register</a></li>";
                        }
                        ?>            
                        </ul>
                    </li>
                        <?php
                            $user = new \app\models\User();
                            if(isset($_SESSION['username'])){
                                //var_dump($_SESSION['username']);
                                $user = $user->get($_SESSION['username']);
                                if($user->type == 'admin'){
                                    echo '<li class="nav-item dropdown rounded">';
                                        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill me-2"></i>Admin</a>';
                                            echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';     
                                            echo '<li><a class="dropdown-item" href="/Admin/createTopic">Create Topic</a></li>';
                                            echo '<li><a class="dropdown-item" href="/Admin/index">Admin Panel</a></li>';
                                            echo '</ul>';
                                }
                            }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <style>
        body {font-family: Montserrat, sans-serif; background: #282a36;}
        h1, h2, h3 {color: #f8f8f2; padding-left: 1%;}
        .navbar-nav .nav-item:hover {background-color: rgba(180, 190, 203, 0.4);}
        a {color: #ff79c6; text-decoration: none; opacity: 1; padding-left: 1%;}
        p {color: #ffb86c;}
        a:hover {opacity: 0.6; transition: 0.5s; color: #ff79c6;}
        #welcome-notlogin {text-align: center; margin-top: 10px;}
        td tr {color: #ff79c6;}
    </style>
    <br>
    <h1 style="text-align: center;">Banned Users</h1>
    <a href="/Admin/index" style="text-align: center;">Admin Panel</a>
    <br>
        <?php

        $users = new \app\models\User();
        $users = $users->getBannedUsers();

        foreach($users as $user){
            echo "<tr>
			<td><a style='color: #ffb86c; pointer-events: none;'>$user->username</a></td>
			<td>
				<a href='/Admin/unbanuser/$user->user_id'>unban</a>
			</td>
		</tr>";
        }
        ?>
    </body>

</html>