<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
include_once('include/initialization.php');

$errors = array();

// Systeme d'envoi de l'email

if(!empty($_POST)){
	$mail = strip_tags($_POST['email']);
	$mail = trim($mail);
	$uniqid = uniqid();
	$message = "Hello, \n happy to see you want to subscribe to the mailing list of Hyper secret product ! \n You only have 30min to confirm your email here: \n 
	http://martincollignon.be/php/mailinglist/confirm.php?uniqid=$uniqid \n \n  Thank you.";
	
	if(empty($mail)){
		$errors['email'] = 'Please write your email';
	}
	if(emailExists($connexion, $mail)){
		$errors['exist'] = 'This email is already registered';
	}
	if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
		$errors['validEmail'] = 'Oops, this is not a valid email';
	}
	
	if(empty($errors)){
		// Insertion du message à l'aide d'une requête préparée
		$req = $connexion->prepare('INSERT INTO mailinglist (email, inscription, isconfirmed, uniqid) VALUES(?, ?, ?, ?)');
		$req->execute(array($mail, date("Y-m-d H:i:s"), "no", $uniqid));
		mail( $mail, "Subscribed to Hyper secret product", $message, $uniqid);
		
		// Redirection vers la page OK
		header('Location: subscribed.php');
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Hyper secret product </title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css" />
		<link rel="stylesheet" href="_styles/style.css" />
	</head>

	<body>
		<div class="container">
			<header class="col-lg-12">
				<h1>Hyper secret product</h1>
				<a href="login.php" class="btn btn-default btn-sm btn-admin">I'm administrator</a>
			</header>
			
			<section class="col-lg-12 well">
				<div class="page-header">
					<h1 class="center">We are building an hyper secret product</h1>
					<h2 class="center">You wanna have it ?</h2>
        </div>
				
				<?php foreach($errors as $error): ?>
					<div class="alert alert-dismissible alert-danger">
					  <?php echo $error; ?>
					</div>
				<?php endforeach; ?>
				
				<form method="post" class="form-group">
          <div class="input-group input-mailing">
            <input type="text" class="form-control" placeholder="Type in your email adress" name="email" id="email" />
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit">Inscrivez-moi !</button>
            </span>
          </div>
        </form>
			</section>
		  
		</div>
	</body>
</html>
