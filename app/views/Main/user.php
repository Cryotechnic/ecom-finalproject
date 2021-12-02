<!DOCTYPE html>
<html lang="en">
    <body>
        <?php
        $user = new \app\models\User();
        $user = $user->getById($data);
        $posts = new \app\models\Post();
        $posts = $posts->getByUserId($data);
        ?>
        User Profile<br>
        <a href="/Main/logout">Logout</a>
        <a href="/Main/index">Home</a>
        <div style='border:1px solid black; width:80%; height: auto; white-space: nowrap; margin-top: 2%; margin: 2% auto;'>
            <div style="display:flex">
                <div style="text-align: center; padding-right: 2%;">
                    <h1><?=$user->username?></h1>
                    <?php
                        if($user->user_id == $_SESSION['user_id']){
                            echo "<a href='/Secure/editProfile'>Edit Profile</a>";
                        }
                    ?>
                </div>
                <div style="text-align: left; flex: 50%;">
                    <h2><?php 
                        if($user->dob == "0000-00-00"){
                            echo "User has not set their date of birth";
                        } else {
                            echo $user->dob;
                        }
                    ?></h2>
                    <h2><?php 
                        if($user->location == ""){
                            echo "User has not set their location yet";
                        } else {
                            echo $user->location;
                        }
                    ?></h2>
                    <h2><?php
                    if($user->bio == ""){
                            echo "User has not set their bio yet";
                        } else {
                            echo $user->bio;
                        }
                        ?></h2>
                        <h2>Posts</h2>
                        <?php   
                        foreach($posts as $post){
                            echo "<a href='/Main/post/".$post->post_id."'>".$post->title."</a><br>";
                        }
                        ?>
                </div>
            </div>
        </div>
    </body>
</html>