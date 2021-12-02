<html>
    <head>
        <title>Post</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-house-fill me-2"></i>Home</a>
                    </li>
                    <li class="nav-item dropdown rounded">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill me-2"></i>Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if(isset($_SESSION['user_id'])){
                            echo "<li><a class='dropdown-item' href='/Main/logout'>Logout</a></li>";
                            } else {
                                echo "<li class='dropdown-item'><a href='/Main/login'>Login</a></li>";
                                echo "<li class='dropdown-item'><a href='/Main/register'>Register</a></li>";
                            }
                        ?>            
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <style>
        body {font-family: Montserrat, sans-serif; background: #282a36;}
        h1, h2, h3 {color: #f8f8f2; padding-left: 1%;}
        .navbar-nav .nav-item:hover {background-color: rgba(180, 190, 203, 0.4);}
        a {color: #ff79c6; text-decoration: none; opacity: 1; padding-left: 1%;}
        #a {color: #ffb86c;}
        p {color: #ffb86c; padding-left: 1%;}
        a:hover {opacity: 0.6; transition: 0.5s; color: #ff79c6;}
        #welcome-notlogin {text-align: center; margin-top: 10px;}
        .btn, .btn-primary {margin-left: 1%; background-color: transparent; border-color: #ff79c6; color: #f8f8f2; border-radius: 0.25rem;}
        .btn:hover, .btn-outline-primary:hover {border-color: #bd93f9; color: #bd93f9; background-color: transparent; opacity: 1;}
        .admin, .admin .a-admin {margin-left: 1%; background-color: transparent; border-color: #f1fa8c; color: #f1fa8c; border-radius: 0.25rem;}
        .admin:hover, .admin:hover .a-admin:hover {border-color: #50fa7b; color: #50fa7b; background-color: transparent; opacity: 1;}
    </style>
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
        <!-- Again, HOW DOES THIS WORK -->
        <a style="whitespace: nowrap;" href="<?=BASE?>/Main/index">Home</a><a id="a">></a><a href="<?=BASE?>/Main/topic/<?=$topic->topic_id?>"><?= $topic->name ?></a><a id="a">></a>
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
                        echo '<br><button type="button" class="btn btn-outline-primary admin"><a class="a-admin" style="padding-left: 0%;" href="'.BASE.'/Secure/deletepost/'.$post->post_id.'">Delete</a></button>';
                        if($user->user_id == $post->user_id){
                            echo '<button type="button" class="btn btn-outline-primary admin"><a class="a-admin" style="padding-left: 0%;"href="'.BASE.'/Secure/editpost/'.$post->post_id.'">Edit</a></button>';
                        }
                    }
                }
            ?>
            
        </p>
        <?php
            $like = new \app\models\Like();
            if(isset($_SESSION['user_id'])){
                $like = $like->getLike($post->post_id, $_SESSION['user_id']);
                if($like == null){
                    echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Secure/like/'.$post->post_id.'">Like</a></button>';
                } else {
                    echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Secure/unlike/'.$post->post_id.'">Unlike</a></button>';
                }
            }
            echo '<p>Likes:' . $likesCount;   
            echo '</p><br>';
            

            if(isset($_SESSION['user_id'])){
                if($_SESSION['admin'] == true){
                    if($post->pinned == 0){
                        echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Admin/pinpost/'.$post->post_id.'">Pin</a></button>';
                    } else {
                        echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Admin/unpinpost/'.$post->post_id.'">Unpin</a></button>';
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
        <div style='border:1px solid white; width:30%; white-space: nowrap; margin-left: 1%; padding-left:1%;'>
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
                echo '<div style="border:1px solid white; width:20%; white-space: nowrap; margin-left: 1%; padding-left:1%;">';
                echo '<p>Reply by: ' . $author->username;
                // reply adte
                echo ' on ' . $reply->created_at;
                // updated date if different 
                if($reply->created_at != $reply->updated_at){
                    echo '<br> Last updated: ' . $reply->updated_at;
                }
                echo '</p>';
                echo '<p>' . nl2br($reply->content) . '</p>';

                if(isset($_SESSION['user_id'])){
                    if($author->user_id == $_SESSION['user_id']){
                        echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Secure/deletereply/'.$reply->reply_id.'">Delete</a></button>';
                        echo ' ';
                        echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Secure/editreply/'.$reply->reply_id.'">Edit</a></button>';
                    } else if($_SESSION['admin'] == true){
                        echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Admin/deletereply/'.$reply->reply_id.'">Delete</a></button>';
                    }
                }
                echo '</div>';
            }
        ?>
        <br>
            <?php 
            
                if(isset($_SESSION['user_id']) && $post->locked == 0){
                    echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Secure/Reply/'.$post->post_id.'">Reply to this post</a><br></button>';
                    echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Secure/quoteReply/'.$post->post_id.'">Quote to this post</a></button>';
                    if($_SESSION['admin'] == true){
                        echo '<button type="button" class="btn btn-outline-primary"><a href="'.BASE.'/Admin/lockpost/'.$post->post_id.'">Lock post</a></button>';
                    }
                } else if($post->locked == 1){
                    echo 'This post is locked and not accepting more replies at this time';
                    if($_SESSION['admin'] == true){
                        echo '<button type="button" class="btn btn-outline-primary"><br><a href="'.BASE.'/Admin/unlockpost/'.$post->post_id.'">Unlock post</a></button>';
                    }
                } else {
                    echo 'You must be logged in to reply';
                }
            ?>
    </body>
</html>