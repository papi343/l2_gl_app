<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="form.css">
    <title>Document</title>
</head>
<body>
    <form id="fr" method="post" action="traitement.php">
        <label for=""> Nom </label><br><br>
        <input type="text" name="lastname" value=""><br>
         <label for=""> prenom </label><br>
        <input type="text" name="firtsname" value=""><br>
         <label for=""> email </label><br>
        <input type="email" name="email" value=""><br>
         <label for=""> mots de passe </label><br>
        <input type="password" name="motspass" value=""><br>
        <label for="">commentaire</label><br>
        <textarea name="commentaire" id="">votre messaege</textarea><br>
        <button type="submit">ENVOYER</button>

    </form>
</body>
</html>