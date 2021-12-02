<html>
    <head>
        <title>Admin Page</title>
    </head>
    <body>
        <h1>Admin Page</h1>
        Only admins can see this
        <a href="/Main/index">Go back</a>
        <br>
        <a href="/Admin/viewbans">View banned users</a>

        <h2>Flagged posts</h2>
        <?php

        $flaggedposts = new \app\models\Post();
        $flaggedposts = $flaggedposts->getFlaggedPosts();

        foreach($flaggedposts as $post){
            $user = new \app\models\User();
            $user = $user->getById($post->user_id);
            echo "<div style='border:1px solid black; width:20%; white-space: nowrap; padding-left: 1%;'>";
            echo "<div style='float:left;'>";
            echo "</div>";
            echo '<h2><a href="'.BASE.'/Main/Post/'.$post->post_id.'">' . $post->getTitle() . '</a><br></h2>';
            echo "<p>Created by: $user->username</p> <p>Created at: {$post->getCreated_at()}</p> <p>Updated at: {$post->getUpdated_at()}</p>";
            echo "<p>";
            echo "<a href='".BASE."/Admin/unflagPost/$post->post_id'>Mark as read</a>";
            echo "</p>";
            echo "<p>";
            echo "<a href='".BASE."/Secure/deletePost/$post->post_id'>Delete</a>";
            echo "</p>";
            echo "</div>";    
            echo "</div><br>";
        }
        ?>
    </body>

</html>
