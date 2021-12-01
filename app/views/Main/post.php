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
            $author = new \app\models\User();
            $author = $author->getById($post->user_id);
        ?>
        <a href="<?=BASE?>/Main/index">Home</a> >
        <a href="<?=BASE?>/Main/topic/<?=$topic->topic_id?>"><?= $topic->name ?></a> > 
        <a href="<?=BASE?>/Main/post/<?=$post->post_id?>"><?= $post->title ?></a>
        <hr>

        <h1>Post: 
            <?php
                echo $post->title;
            ?>
        </h1>
        <p>
            Written by:
            <?php
                echo $author->username;
                echo " on: " . $post->created_at;
                if($post->created_at != $post->updated_at){
                    echo '<br>Last updated: ' . $post->updated_at;
                }
                if(isset($_SESSION['user_id'])){
                    $user = new \app\models\User();
                    $user = $user->get($_SESSION['username']);
                    if($user->type == 'admin' || $user->user_id == $post->user_id){
                        echo '<br><a href="'.BASE.'/Secure/deletepost/'.$post->post_id.'">Delete</a>';
                        if($user->user_id == $post->user_id){
                            echo '<br><a href="'.BASE.'/Secure/editpost/'.$post->post_id.'">Edit</a>';
                        }
                    }
                }
            ?>
            
        </p>
        <p>
        <div style='border:1px solid black; width:20%; white-space: nowrap; padding-left: 1%;'>
            <p>
            <?php
                echo "Original post written by: " . $author->username;
                echo " on: " . $post->created_at;
                if($post->created_at != $post->updated_at){
                    echo '<br>Last updated: ' . $post->updated_at;
                }
                echo '<br><br>';
                echo $post->content;
            ?>
            </p>
        </div>
        <br>
        <?php
            $replies = new \app\models\Reply();
            $replies = $replies->getByPostId($post->post_id);
            foreach($replies as $reply){
                $author = new \app\models\User();
                $author = $author->getById($reply->user_id);
                echo '<div style="border:1px solid black; width:20%; white-space: nowrap; padding-left: 1%;">';
                echo '<p>Reply by: ' . $author->username;
                // reply adte
                echo ' on ' . $reply->created_at;
                // updated date if different 
                if($reply->created_at != $reply->updated_at){
                    echo '<br> Last updated: ' . $reply->updated_at;
                }
                echo '</p>';
                echo '<p>' . $reply->content . '</p>';

                if($author->user_id == $_SESSION['user_id']){
                    echo '<a href="'.BASE.'/Secure/deletereply/'.$reply->reply_id.'">Delete</a>';
                    echo ' ';
                    echo '<a href="'.BASE.'/Secure/editreply/'.$reply->reply_id.'">Edit</a>';
                }
                echo '</div>';
            }
        ?>
        <br>
            <?php 
                if(isset($_SESSION['user_id']) && $post->locked == 0){
                    echo '<a href="'.BASE.'/Secure/Reply/'.$post->post_id.'">Reply to this post</a>';
                } else if($post->locked == 1){
                    echo 'This post is locked and not accepting more replies at this time';
                } else {
                    echo 'You must be logged in to reply';
                }
            ?>
    </body>
</html>