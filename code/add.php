<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
include_once('include/initialization.php');
$user = getConnectedUser($connexion);
if(empty($user)){
  redirectTo('login.php');
}

// Systeme d'envoi de l'email

if(!empty($_POST)){
	$uniqid = uniqid();
		
	// Insertion du message à l'aide d'une requête préparée
	$req = $connexion->prepare('INSERT INTO mailinglist (email, inscription, isconfirmed, uniqid) VALUES(?, ?, ?, ?)');
	$req->execute(array($_POST['email'], date("Y-m-d H:i:s"), "yes", $uniqid));
	
	// Redirection vers la page OK
	header('Location: admin.php');
	
}
?>

<!doctype html>
<html class="no-js" lang="fr">
<head>
		<meta charset="UTF-8">
		<title>Administrateur</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css" />
		<link rel="stylesheet" href="_styles/style.css" />
</head>
<body>
	<div class="main container">
    <header class="col-lg-12">
			<h1>Hyper secret product</h1>
			<a href="logout.php" class="btn btn-default btn-sm btn-admin">Log-out</a>
		</header>
		<section class="well mailinglist">
			<h1>Add a subscriber</h1>

					
			<div class="bs-component">
				<form class="form-horizontal" method="post"> 
					<div class="form-group">
    				<label for="login" class="col-lg-1 control-label">email</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" id="email" name="email" />
							</div>
					</div>
					<div class="col-lg-10 col-lg-offset-1">
						<a href="admin.php" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary" name="submit" />Add</button>
          </div>
				</form>
			</div>
		</section>
 	</div>
</body>
</html>

