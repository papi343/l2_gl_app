<?php
$Serveur='localhost';
$login ='root';

try {
  $connexion = new PDO("mysql:host=$Serveur;dbname=teste", $login);
$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "connexion reussi";
}
catch (PDOException $e){
    echo 'ECHEC de la connexion :' .$e->getMessage();
}