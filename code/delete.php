<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
include_once('include/initialization.php');
$user = getConnectedUser($connexion);
if(empty($user)){
  redirectTo('login.php');
}
//get id
$id = $_GET["id"];

// Récupération des 10 derniers messages
$reponse = $connexion->query("SELECT * FROM mailinglist WHERE id='$id'");

if(isset($_POST['submit'])){
	$connexion->exec("DELETE FROM mailinglist WHERE id='$id'");
	
	header('Location: admin.php');
}

if(isset($_POST['cancel'])){	
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
			<h1>Delete a subscriber</h1>
			
			<?php
					// Affichage les inscrits et leurs informations
					while ($donnees = $reponse->fetch()){
			?>
					
			<div class="bs-component">
				<form class="form-horizontal" method="post"> 
					<p>Are you sure you want to delete <?php echo $donnees['email']; ?> </p>
          <div class="col-lg-10">
	          <button type="submit" class="btn btn-default" name="cancel" />Cancel</button>
            <button type="submit" class="btn btn-primary" name="submit" />Delete</button>
          </div> 
				</form>
				<?php
					}
					
					$reponse->closeCursor();
					?>
			</div>
		</section>
 	</div>
</body>
</html>

