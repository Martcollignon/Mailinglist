<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
include_once('include/initialization.php');

if($user = getConnectedUser($connexion)){
	redirectTo('admin.php');
}

$errors = array();

if(!empty($_POST)){
	if(empty($_POST['login'])){
		$errors['login'] = 'Le login est obligatoire';
	}

	if(empty($_POST['password'])){
		$errors['password'] = 'Le password est obligatoire';
	}

	if(empty($errors)){
		$sql = 'SELECT * FROM user WHERE login = :login';
		$preparedStatement = $connexion->prepare($sql);
		$preparedStatement->bindValue(':login', $_POST['login']);
		$preparedStatement->execute();
		$user = $preparedStatement->fetch();
		
		// Afficher qu'il est connecté
		$userlogin = $user["login"];
		$connexion->exec("UPDATE user SET isconnected = 'connected' WHERE login = '$userlogin' ");
		
		if(!empty($user)
		&& password_verify($_POST['password'], $user['hash'])){
			$_SESSION['user_secret'] = $user['secret'];
			redirectTo('admin.php');
		}
	}
}
?>


<!doctype html>
<html class="no-js" lang="fr">
<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css" />
		<link rel="stylesheet" href="_styles/style.css" />
</head>
<body>
	<div class="container">
		<header class="col-lg-12">
			<h1>Hyper secret product</h1>
		</header>

	<section class="col-lg-6 bs-component well">
	  <form method="post" action="" class="login form-horizontal">
		  <fieldset>
			  <legend>My admin account</legend>
			  <p>If you want to know: login: admin<br /> password: admin<br /></p>
				<div class="form-group">
          <label for="login" class="col-lg-2 control-label">Login</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="login" placeholder="Your login" name="login" />
          </div>
        </div>
        
        <div class="form-group">
          <label for="password" class="col-lg-2 control-label">Password</label>
          <div class="col-lg-10">
            <input type="password" class="form-control" id="login" placeholder="Your login" name="password" />
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary" name="envoyer" />Connection</button>
          </div>
        </div>
		    
		  </fieldset>
	  </form>
	</section>
</body>
</html>
