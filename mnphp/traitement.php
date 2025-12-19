<?php
//var_dump($_POST);
//ouvertur du ficher json puis conversion en tableau php
$ficher='utilisateur.json';
if(file_exists($ficher)){
    $json=file_get_contents($ficher);
    $utilisateur=json_decode($json,true);
}else{
    $utilisateur=[];
}
function newid($utilisateur)
{
if(!empty($utilisateur))
    {
        $ids=array_column($utilisateur,'id');
        $newid=max($ids)+1;
        
    }else {
        $newid=1;
    }
    return $newid;
}
$error="";
 $success=false;
  if($_SERVER['REQUEST_METHOD']==='POST')
  {
    $nom = trim($_POST['firtsname']);
    $prenom = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['motspass']);
    $success=true;
    if(empty($nom) && !preg_match('/^[a-zA-z].{2,}$/',$nom)){
            $error=$error."erreur sur le nom";
            echo "$error";
             $success=false;
    }
       if(empty($prenom)){
            $error=$error."erreur sur le prenom";
             $success=false;
    }
       if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
            $error=$error."erreur sur l'EMAIL";
             $success=false;
    }
       if(empty($password) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/',$password)){
            $error=$error."erreur sur le most de passe";
             $success=false;
    }
       if($success){
          $utilisateur[] =[
      "id"=>newid($utilisateur),
      "nom"=>$nom,
      "prenom"=>$prenom,
      "email"=>$email,
      "motspass"=>password_hash($password,PASSWORD_DEFAULT)
    ];  
   

  file_put_contents('utilisateur.json',json_encode($utilisateur,JSON_PRETTY_PRINT));
  echo " connexion reussi";
   
  } else {
    echo $error;
  }
       }
    
  

    
?>