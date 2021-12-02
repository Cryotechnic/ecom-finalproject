<html>
    <head>
        <title>Post</title>
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
            $likes = new \app\models\Like();
            $likes = $likes->getByPostId($post->post_id);
            $likesCount;
            if($likes == null){
                $likesCount = 0;
            } else {
                $likesCount = count($likes);
            }
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
        <?php
            $like = new \app\models\Like();
            $like = $like->getLike($post->post_id, $_SESSION['user_id']);
            echo 'Likes:' . $likesCount;   
            echo '<br>';
            if($like == null){
                echo '<a href="'.BASE.'/Secure/like/'.$post->post_id.'">Like</a>';
            } else {
                echo '<a href="'.BASE.'/Secure/unlike/'.$post->post_id.'">Unlike</a>';
            }
            echo '<br>';
            if(isset($_SESSION['user_id'])){
                if($_SESSION['admin'] == true){
                    if($post->pinned == 0){
                        echo '<a href="'.BASE.'/Admin/pinpost/'.$post->post_id.'">Pin</a>';
                    } else {
                        echo '<a href="'.BASE.'/Admin/unpinpost/'.$post->post_id.'">Unpin</a>';
                    }
                }
            }
            if(isset($_SESSION['user_id'])){
                // report post button
                echo '<br>';
                echo '<a href="'.BASE.'/Secure/reportpost/'.$post->post_id.'">Report this post</a>';
            }
        ?>
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
                echo nl2br($post->content);
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
                echo '<p>' . nl2br($reply->content) . '</p>';

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
                    echo '<a href="'.BASE.'/Secure/Reply/'.$post->post_id.'">Reply to this post</a><br>';
                    echo '<a href="'.BASE.'/Secure/quoteReply/'.$post->post_id.'">Quote to this post</a>';
                    if($_SESSION['admin'] == true){
                        echo '<br><a href="'.BASE.'/Admin/lockpost/'.$post->post_id.'">Lock post</a>';
                    }
                } else if($post->locked == 1){
                    echo 'This post is locked and not accepting more replies at this time';
                    if($_SESSION['admin'] == true){
                        echo '<br><a href="'.BASE.'/Admin/unlockpost/'.$post->post_id.'">Unlock post</a>';
                    }
                } else {
                    echo 'You must be logged in to reply';
                }
            ?>
    </body>
</html>