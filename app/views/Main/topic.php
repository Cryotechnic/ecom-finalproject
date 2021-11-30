<html>
    <head>
        <title>Topic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Topic</h1>
        <?php
            // display create post form if user is logged in
            if(isset($_SESSION['user_id'])) {
                echo '<a href="'.BASE.'/Secure/createPost/'.$data.'">Create a post</a><br>';
            }
            $posts = new \app\models\Post();
            $posts = $posts->getByTopicId($data);
        //display all topics
        foreach($posts as $post){
            $user = new \app\models\User();
            $user = $user->getById($post->user_id);
            echo "<div style='border:1px solid black; width:20%; white-space: nowrap; padding-left: 1%;'>";
            echo "<div style='float:left;'>";
            echo "<img src=''>";
            echo "</div>";
            echo '<h2><a href="'.BASE.'/Main/Post/'.$post->post_id.'">' . $post->getTitle() . '</a><br></h2>';
            echo "<p>Created by: $user->username</p> <p>Created at: {$post->getCreated_at()}</p> <p>Updated at: {$post->getUpdated_at()}</p>";
            echo "</div>";    
            echo "</div><br>";
        }
        ?>
    </body>
</html>