<html>
	<head>
		<title>Edit Post</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet">
   	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
        <?php
        
        $post = new \app\models\Post();
		$post = $post->getByPostId($data);
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        if($post->user_id != $user->user_id){
            echo "You are not allowed to edit this post<br>";
            echo '<a href="'.BASE.'/Main/index">Go back home</a><br>';
            return;   
        }
        
        ?>
        <style>body,html{height:100%}.global-container{height:100%;display:flex;align-items:center;justify-content:center;background-color:#f5f5f5}form{padding-top:10px;font-size:14px;margin-top:30px}.card-title{font-weight:300}.btn{font-size:14px;margin-top:20px}.login-form{width:330px;margin:20px}.sign-up{text-align:center;padding:20px 0 0}.alert{margin-bottom:-30px;font-size:13px;margin-top:20px;}</style>
		<div class="global-container">
			<div class="card login-form">
				<div class="card-body">
					<h3 class="card-title text-center">Edit Post</h3>
					<div class="card-text">
						<form action='' method='post'>
							<div class="form-group">
								<label for="exampleInputEmail1">Post Title</label>
								<input disabled type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="posttitle" name="location" value="<?= $post->title ?>" />
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Post Content</label>
								<textarea type="text" class="form-control form-control-sm" id="exampleInputPassword1" name="description"><?=$post->content?></textarea>
							</div>
							<button type="submit" class="btn btn-primary btn-block" name="action" value="Create">Update Post</button>

							<div class="sign-up">
								Changed your mind? Go back by <a href="/Main/index">clicking here</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </body>
	<hr>
	<body>
	<?php 

	?>
		Edit your post:
		<form action='' method='post'>
			Title of your post: <input disabled type='text' name='title' value='<?= $post->title ?>'/><br>
            <textarea name='description' placeholder='Content'><?= $post->content ?></textarea><br>
			<input type='submit' name='action' value='Create' />
		</form>
	</body>
</html>

