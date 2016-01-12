<?php
ini_set('display_errors',1);

$uniqid = $_GET['uniqid'];
include_once('include/initialization.php');
	
$reponses = array();

if(uniqidExists($connexion, $uniqid)){
	$reponse = $connexion->query("SELECT inscription FROM mailinglist WHERE uniqid='$uniqid'");
	while ($donnees = $reponse->fetch()){
		$date = $donnees['inscription'];
	}
	$inscriptionTimestamp = strtotime($date);
	$currentTimestamp = time();

	$diff = $currentTimestamp - $inscriptionTimestamp;	
	
	if($diff < 1800){
		$connexion->exec("UPDATE mailinglist SET isconfirmed = 'yes' WHERE uniqid = '$uniqid' ");
		$reponses['reponse'] = '<h1 class="center">Congratulation</h1><h2 class="center">You re registered on Hyper secret product mailing list</h2>';
	}else{
		$reponses['reponse'] = '<h1 class="center">Sorry, you have exceeded 30 minutes</h1>';
	}

} else{
	$reponses['reponse'] = '<h1 class="center">Seems like there is a problem!</h1>';
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>You're subscribed ! </title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css" />
		<link rel="stylesheet" href="_styles/style.css" />
	</head>

	<body>
		<div class="container">
			<header class="col-lg-12">
				<h1>Hyper secret product</h1>
				<a href="login.php" class="btn btn-default btn-sm btn-admin">Je suis administrateur</a>
			</header>
			
			<section class="well">				
				<?php foreach($reponses as $reponse): ?>
					
					  <?php echo $reponse; ?>
					
				<?php endforeach; ?>
			</section>
		</div>
	</body>
</html>
