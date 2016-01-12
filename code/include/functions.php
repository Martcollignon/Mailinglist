<?php

function emailExists($connexion, $email){
  $query = $connexion->prepare('SELECT COUNT(*) AS total FROM mailinglist WHERE email = :email');
  $query->bindValue(':email', $email);
  $query->execute();
  if($result = $query->fetch()){
    return !empty($result['total']);
  }
  return false;
}

function uniqidExists($connexion, $uniqid){
  $query = $connexion->prepare('SELECT COUNT(*) AS total FROM mailinglist WHERE uniqid = :uniqid');
  $query->bindValue(':uniqid', $uniqid);
  $query->execute();
  if($result = $query->fetch()){
    return !empty($result['total']);
  }
  return false;
}

function getConnectedUser($connexion)
{

  if(empty($_SESSION['user_secret'])){
    return false;
  }
  $secret = $_SESSION['user_secret'];
  $query = $connexion->prepare('SELECT * FROM user WHERE secret = :secret');
  $query->bindValue(':secret', $secret);
  $query->execute();
  if($user = $query->fetch()){
    return $user;
  }else{
    return false;
  }
}

function getUserTasks (PDO $connexion, $userId)
{
  $query = $connexion->prepare( 'SELECT * FROM task WHERE user_id = :user_id' );
  $query->bindValue( ':user_id', $userId );
  $query->execute();
  $tasks = $query->fetchAll();
  return $tasks;
}

function redirectTo($url)
{
  header('Location: '.$url);
  exit;
}

function validateDate($input, $format = 'Y-m-d H:i:s')
{
    $date = DateTime::createFromFormat($format, $input);
    return $date && $date->format($format) == $input;
}

function displayTasks($tasks){
  include('tasks.view.php');
}