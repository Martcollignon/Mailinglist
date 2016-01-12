<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
include_once('include/initialization.php');
$user = getConnectedUser($connexion);
if(empty($user)){
  redirectTo('login.php');
}

// Récupération des 10 derniers messages
$reponse = $connexion->query('SELECT id, email, inscription, uniqid, isconfirmed FROM mailinglist');

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
			<h1>Mailing list:</h1>
			
			<form method="post" class="form-group">
        <div class="input-group input-mailing">
          <span class="input-group-btn">
            <a class="btn btn-default" href="add.php">Add an email adress</a>
            <button class="btn btn-primary" type="submit">Send emails</button>
          </span>
        </div>
      </form>

			<table class="table table-striped table-hover ">
	      <thead>
	        <tr>
	          <th>ID</th>
				    <th>email</th>		
				    <th>Date d'inscription</th>
				    <th>Is confirmed ?</th>
				    <th>Uniq Id</th>
				    <th>Modify</th>
				    <th>Delete line</th>
	        </tr>
	      </thead>
	      <tbody>
		      
		        <?php
						// Affichage les inscrits et leurs informations
						while ($donnees = $reponse->fetch())
						{
							echo '<tr><td>' . $donnees['id'] . '</td> <td>' . $donnees['email'] . '</td> <td>' . $donnees['inscription']  . '</td> <td>' . $donnees['isconfirmed'] . '</td> <td>' . $donnees['uniqid'] . '</td> <td>' . '<a href="modify.php?id=' . $donnees["id"] . '">Modify</a>' . '</td> <td>' . '<a href="delete.php?id=' . $donnees["id"] . '">Delete</a>' . '</td></tr>';
						}
						
						$reponse->closeCursor();
						?>
		      
	      </tbody>
	    </table>
		</section>
 	</div>
</body>
</html>

