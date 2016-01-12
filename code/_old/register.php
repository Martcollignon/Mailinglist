<?php
include_once('include/initialization.php');
$errors = array();
if(!empty($_POST)){
	if(empty($_POST['login'])){
		$errors['login'] = 'Le login est obligatoire';
	}else if(loginExists($connexion, $_POST['login'])){
		$errors['login'] = 'Ce login est déjà dans notre base de donnée';
	}

	if(empty($_POST['password'])){
		$errors['password'] = 'Le password est obligatoire';
	}else if(strlen($_POST['password']) < 4){
		$errors['password'] = 'Votre password doit faire au minimum 4 caractères';
	}

	if(empty($errors)){
		$sql = 'INSERT INTO user(login, hash, secret)
		VALUES(:login, :hash, :secret)';
		$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$secret = uniqid();
		$preparedStatement = $connexion->prepare($sql);
		$preparedStatement->bindValue('login', $_POST['login']);
		$preparedStatement->bindValue('hash', $hash);
		$preparedStatement->bindValue('secret', $secret);

		if($preparedStatement->execute()){
			$_SESSION['user_secret'] = $secret;
			redirectTo('index.php');
		}




	}
}

?>


<!doctype html>
<html class="no-js" lang="fr">
<head>
		<meta charset="UTF-8">
		<title>Register</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,900' rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="static/main.css" media="all">
</head>
</head>
<body>
	<section class="main">
	    <header class="with-navigation">
	  	   <h1>Créer un compte</h1>
	  	   <ul class="tabs">
	         <li><a href="login.php" class="">login</a></li>
	         <li><a href="register.php" class="active">créer un compte</a></li>
	       </ul>
	  	</header>

	  	<div class="content">
	  		<?php foreach($errors as $error): ?>
				<div class="alert error"><?php echo $error; ?></div>
			<?php endforeach; ?>

		  <form method="post" action="">

				<div class="field">
					<label>name</label>
					<input type="text" name="name" />
				</div>

		    <div class="field">
		      <label>login</label>
		      <input type="text" name="login" />
		    </div>

		    <div class="field">
		      <label>password</label>
		      <input type="password" name="password" />
		    </div>

			<div class="field">
		      <input type="submit" name="valider" class="button" />
		    </div>

		  </form>
		</div>
	</section>
</body>
</html>
