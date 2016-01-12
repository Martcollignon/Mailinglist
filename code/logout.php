<?php
include_once('include/initialization.php');
$user = getConnectedUser($connexion);
if(empty($user)){
  redirectTo('login.php');
}

// Déconnexion
$userlogin = $user["login"];
$connexion->exec("UPDATE user SET isconnected = 'not-connected' WHERE login = '$userlogin' ");


$_SESSION['user_secret'] = null;
redirectTo('index.php');

?>