<html>
    <head>
        <title>Main Index</title>
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
        body {font-family: Montserrat, sans-serif;}
        .navbar-nav .nav-item:hover {background-color: rgba(180, 190, 203, 0.4);}
        a {color: #000000; text-decoration: none;}
        #welcome-notlogin {text-align: center; margin-top: 10px;}
    </style>
        <?php
             if(isset($_SESSION['username'])){
                 $user = new \app\models\User();
                 $user = $user->get($_SESSION['username']);
                 if(isset($_SESSION['user_id'])){
                     echo '<h3>Welcome, ' . $_SESSION['username'] . '!</h3><br>';
                 } 
             } else {
                 echo '<h3 id="welcome-notlogin">Welcome to the forum, login or register for full functionality!<h3><br>';
             }
         ?>
    </body>
<h1 style="padding-left: 1%;">Topics</h1>
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
    echo "<div style='border:1px solid black; width:400px; margin-left:1%; padding-left:1%;'>";
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
