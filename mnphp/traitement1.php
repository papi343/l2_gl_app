<?php
SESSION_start();

$erreur = [];
if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $nom = htmlspecialchars($_POST['nom']);
     $prenom = htmlspecialchars($_POST['prenom']);
      $email = htmlspecialchars($_POST['email']);
       $telephone = htmlspecialchars($_POST['telephone']);
        $objet = htmlspecialchars($_POST['objet']);
         $message = htmlspecialchars($_POST['message']);
    if(empty($nom))
    $erreur [] = "veuiller saisir votre nom";
    if(empty($prenom)) $erreur[] = "veuiller saisir votre prenom";
    if( empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL) ) $erreur[]="Saisir une email valide";
    $regx='/^(78|77|76|75)[0-9].{7}$/';
    if(!preg_match($regx, $telephone)) $erreur[]="Saisir un numero de telephone valide";
    if(!strlen($objet)>=30 || $objet == " ") $erreur[]=" veuiller remplir le champs objet";
    if(!strlen($message)>=150 || $message== " ") $erreur[]=" veuiller remplir le champs message";
    
  if(!empty($erreur))
  {
    $_SESSION['erreur']=$erreur;
    header("Location: index2.php?page=contact");
    exit();
  }
} else echo 'erreur';