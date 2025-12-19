<?php
//nabigation
$pagevalide=['accueil','services','portfolio','contact'];
$page =$_GET['page'] ?? 'accueil';// permet de recupere le choix du c

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mon site - <?php echo ucfirst($page) ?></title>
        <style>
            nav {
                background: #f8f9fa;
                padding : 15px;
                margin-bottom: 20px;
            }
   nav a {
   padding: 10px 15px;
   margin: 15px;
   text-decoration: none;
   background-color: #f0f0f0;
   border-radius: 4px;
   color: #333;
   transition: all 0.3s;
}
   nav a.active {
   background-color: #007bff;
   color: white;
   font-weight:bold;
}
   nav a:hover {
   background-color: #ddd;
}
main {
    
    max-width: 800px;
    margin:0 auto;
}
   </style>
</head>
<body> 
    <a href="accueil.html">accueil</a>
    <nav>
        <?php 
        foreach ($pagevalide as $p): ?>
          <a href="?page=<?= $p ?>" class="<?=($page == $p) ? 'active' : ''  ?>"> <?= ucfirst($p) ?> </a>
        <?php endforeach ?>
    </nav>
  
  <main>
    <?php
         switch($page)
        {
      case "acceuil":
    echo "<h1> Bien venue sur notre site </h1>";
    break;
     case "services":
    echo "<h1> partie service </h1>";
    break;
     case "portfolio":
    echo "<h1> partie portfolio </h1>";
    break;
     case "contact":
       include "contacte.php";
    break;
    default:
    echo " <h1>page non trouver<h1>";
    break;
        }
   
    ?>
</main>
</body>
</html>

 