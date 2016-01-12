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
	$req = $connexion->prepare("UPDATE mailinglist SET email = :email, inscription = :inscription, isconfirmed = :isconfirmed WHERE id='$id' ");
	
	$req->execute(array(
		'email' => $_POST['email'],
		'inscription' => $_POST['inscription'],
		'isconfirmed' => $_POST['isconfirmed'],
		));
	
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
			<h1>Modifiy user data</h1>
			
			<?php
					// Affichage les inscrits et leurs informations
					while ($donnees = $reponse->fetch()){
			?>
					
			<div class="bs-component">
				<form class="form-horizontal" method="post"> 
					<div class="form-group">
    				<label for="login" class="col-lg-2 control-label">email</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" id="email" value="<?php echo $donnees['email'] ?>" name="email" />
							</div>
					</div>
					<div class="form-group ">
    				<label for="inscription" class="col-lg-2 control-label">Inscription date</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" id="inscription" value="<?php echo $donnees['inscription'] ?>" name="inscription" />
							</div>
					</div>
					<div class="form-group ">
    				<label for="isconfirmed" class="col-lg-2 control-label">Is confirmed ?</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" id="isconfirmed" value="<?php echo $donnees['isconfirmed'] ?>" name="isconfirmed" />
							</div>
					</div>
					<div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
	          <a href="admin.php" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary" name="submit" />Modify</button>
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

