<html>
    <head>
        <title>Topic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            $topic = new \app\models\Topic();
            $topic = $topic->getByTopicId($post->topic_id);
        ?>
        <a href="<?=BASE?>/Main/index">Home</a> >
        <a href="<?=BASE?>/Main/topic/<?=$topic->topic_id?>"><?= $topic->name ?></a> > 
        <a href="<?=BASE?>/Main/post/<?=$post->post_id?>"><?= $post->title ?></a>
        <hr>
    </body>
</html>