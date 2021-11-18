<html>
    <head>
        <title>Main Index</title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['user_id'])){
                echo 'Welcome, ' . $_SESSION['username'] . '!';
                echo '<a href="'.BASE.'/Main/logout">Logout</a>';
            } else {
                echo 'Welcome to the forum, login or register for full functionality!<br>';
                echo '<a href="'.BASE.'/Main/login">Login</a><br>';
                echo '<a href="'.BASE.'/Main/register">Register</a>';
            }
        ?>
    </body>
    <br>
    <br>
    PUT CONTENT HERE
</html>
