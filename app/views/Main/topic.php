<html>
    <head>
        <title>Topic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Topic</h1>
        <?php
            $topic = new \app\models\Topic();
            $topic = $topic->getTopicId();
            $posts = new \app\models\Post();
            $posts = $posts->getAllPosts();
            $users = new \app\models\User();
            $users = $users->getByTopicId($topic);
            if(isset($_SESSION['username'])){
                if($user->type == 'admin'){
                    echo '<a href="'.BASE.'/Admin/Topic/'.$topic['topic_id'].'lockTopic/'.$topic['post_id'].'">Lock Topic</a><br>';
                }
            }
        //display all topics
        foreach($posts as $post){
            echo "<div style='border:1px solid black; width:80%; white-space: nowrap;'>";
            echo "<div style='float:left;'>";
            echo "<img src=''>";
            echo "</div>";
            echo " <h2>{{$topic->getTitle()}}</h2> <p>{{$post->getContent()}}</p> <p>{{$post->getCreated_at()}}</p> <p>{{$post->getUpdated_at()}}</p> <p>Profile</p>";
            echo '<a href="'.BASE.'/Main/Topic/likePost/'.$post['post_id'].'">like post</a><br>';
            echo "</div>";    
            if(isset($_SESSION['username'])){
                if($user->type == 'admin'){
                    echo '<a href="'.BASE.'/Admin/Topic/'.$topic['topic_id'].'deletePost/'.$post['post_id'].'">delete post</a><br>';
                    echo '<a href="'.BASE.'/Admin/Topic/'.$topic['topic_id'].'banUser/'.$users['user_id'].'">ban user post</a><br>';
                    echo '<a href="'.BASE.'/Admin/Topic/'.$topic['topic_id'].'pinPost/'.$post['post_id'].'">pin post</a><br>';
                }
            }
            echo "</div><br>";
        }
        ?>
    </body>
</html>