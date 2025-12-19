<?php
SESSION_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .erreur>p{
         color: red;
      }
      .content{
        margin: 100px;
        width: 400px;
      }
      legend {
        text-align: center;
      }
    </style>
</head>
<body>
    <div class="content">
        <fieldset>
            <legend>Contact</legend>
            <div class="erreur">
            <?php if(isset($_SESSION['erreur'])):?>
                <?php foreach($_SESSION['erreur'] as $err ):?>
                 <p><?= $err ?></p>
                 <?php endforeach;?>
                 <?php endif;?>
                 <?php unset($_SESSION['erreur'])?>

            <form action="traitement1.php" method="POST"   >
                <label for="">Nom</label>
                <input type="text" name="nom"> <br><br>
                  <label for="">prenom</label>
                <input type="text"  name="prenom"> <br><br>
                  <label for="">email</label>
                <input type="email"  name="email"> <br><br>
                  <label for="">tel</label>
                <input type="number"  name="telephone"> <br><br>
                  <label for="">objet</label>
                <input type="text"  name="objet"> <br><br>
                <label for="">Message</label><br><br>
                <textarea name="" id=""  name="message"></textarea><br><br>
                <button type="submit">Soumettre<button>
            </form>
        </fieldset>
    </div>
</body>
</html>