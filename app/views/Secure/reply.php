<html>
	<head>
		<title>Reply to Post</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet">
   	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
    <?php 
        $post = new \app\models\Post();
        $post = $post->getByPostId($data['post_id']);
        $author = new \app\models\User();
        $author = $author->getById($post->user_id);
	?>
        <style>body,html{height:100%}.global-container{height:100%;display:flex;align-items:center;justify-content:center;background-color:#282a36}form{padding-top:10px;font-size:14px;margin-top:30px}.card-title{font-weight:300}.btn{font-size:14px;margin-top:20px}.login-form{width:330px;margin:20px}.sign-up{text-align:center;padding:20px 0 0}.alert{margin-bottom:-30px;font-size:13px;margin-top:20px;}</style>
		<div class="global-container">
			<div class="card login-form">
				<div class="card-body">
					<h3 class="card-title text-center">Reply to post: <?php echo $post->title ?></h3>
					<div class="card-text">
						<form action='' method='post'>
							<div class="form-group">
								<label for="exampleInputEmail1">Reply Title</label>
								<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="posttitle" name="title">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Reply Content</label>
                                <?php
                                    if(isset($data['quote'])){
                                        echo '<textarea type="text" class="form-control form-control-sm" id="exampleInputPassword1" name="description">';
                                        echo "\"" . $data['quote'] . "\"" . "\nWritten by: " . $author->username . "\n";
                                        echo "</textarea>";
                                    } else {
                                        echo '<textarea type="text" class="form-control form-control-sm" id="exampleInputPassword1" name="description"></textarea>';
                                    }
                                ?>
							</div>
							<button type="submit" class="btn btn-primary btn-block" name="action" value="Reply">Reply to Post</button>

							<div class="sign-up">
								Changed your mind? Go back by <a href="/Main/index">clicking here</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>

