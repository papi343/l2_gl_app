<?php
SESSION_start();
 if(!$_SESSION['utilisateur']){
    $_SESSION['utilisateur']=[];
 }

 if(isset($_POST['enrigistre']))
 {
   $nom=htmlspecialchars(trim($_POST['lastname']));
   $prenom=htmlspecialchars(trim($_POST['firtsname']));
   $email=htmlspecialchars(trim($_POST['email']));
   $datenaisse=htmlspecialchars(trim($_POST['datenaiss']));
   if($nom!=" " && $prenom!=" " && $email!=" " && $datenaisse!=" ")
   {
    $_SESSION['utilisateur'][]=[
        'nom'=>$nom,
        'prenom'=>$prenom,
        'email'=>$email,
        'date'=>$datenaisse
    ];
   }

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <div class="form">
        <form action="" method="post" >
        <legend>FORMULAIRE</legend>
        <label for=""> Nom </label><br><br>
        <input type="text" name="lastname" value=""><br>
         <label for=""> prenom </label><br>
        <input type="text" name="firtsname" value=""><br>
         <label for=""> email </label><br>
        <input type="email" name="email" value=""><br>
         <label for=""> Date de naissance  </label><br>
        <input type="date" name="datenaiss" value=""><br>
        <button type="submit" name="enrigistre">ENVOYER</button>
    </form>
        </div>
        <div class="tableau">
            <table border="4">
                <thead id="thead" > LISTE DES PERSONNES </thead>
                <tr>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>EMAIL</th>
                    <th>DATE DE NAISSANCE</th>
                </tr>
            <?php if(!empty($_SESSION['utilisateur'])):?>
                    <?php foreach($_SESSION['utilisateur'] as $user):?>
                <tr>
                    <td><?=  htmlspecialchars($user['nom'])?></td>
                      <td><?= htmlspecialchars($user['prenom'])?></td>
                        <td><?=  htmlspecialchars($user['email'])?></td>
                          <td><?= htmlspecialchars( $user['date'])?></td>
                </tr>
                <?php endforeach;?>
            <?php else:?>
                    <?php echo " veuiller remplir les information!!!!!";?>
                <?php endif;?>
            </table>
        </div>
    </div>
   
</body>
</html>