<html>
    <head>
        <title>Main Index</title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['username'])){
                $user = new \app\models\User();
                $user = $user->get($_SESSION['username']);
                if(isset($_SESSION['user_id'])){
                    echo 'Welcome, ' . $_SESSION['username'] . '!';
                    echo '<a href="'.BASE.'/Main/logout">Logout</a>';
                } 
            } else {
                echo 'Welcome to the forum, login or register for full functionality!<br>';
                echo '<a href="'.BASE.'/Main/login">Login</a><br>';
                echo '<a href="'.BASE.'/Main/register">Register</a>';
            }
        ?>
    </body>
    <br>
    <br>
    <?php
        if(isset($_SESSION['username'])){
            if($user->type == 'admin'){
                echo '<a href="'.BASE.'/Admin/index">Admin Panel</a><br><br>';
                echo '<a href="'.BASE.'/Admin/createTopic">Create Topic</a><br><br>';
            }
        }
?>

<?php
$topics = new \app\models\Topic();
$topics = $topics->getAllTopics();
//display all topics
foreach($topics as $topic){
    echo "<div style='border:1px solid black; width:400px;'>";
    echo '<br><a style="font-size: 30px;" href="'.BASE.'/Main/Topic/'.$topic['topic_id'].'">'.$topic['name'].'</a>';
    echo '<br>'.$topic['description'].'<br><br>';

    if(isset($_SESSION['username'])){
        if($user->type == 'admin'){
            echo '<a href="'.BASE.'/Admin/deleteTopic/'.$topic['topic_id'].'">delete</a><br>';
        }
    }
    echo "</div><br>";
}


?>

</html>
