<?php
$fichier ='users.json';
// Si le fichier n'existe pas, créer un tableau vide
if (file_exists($fichier)) {
  $json=file_get_contents($fichier);
   $users =json_decode($json,true);
}else {
    $users=[];
}

// Ajouter un utilisateur
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    // Nettoyage basique des données (améliore selon besoin)
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nom === '' || $prenom === '' || $email === '') {
        $message = 'Merci de remplir tous les champs.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email invalide.';
    } else {
        $nouveau = [
            'id' => uniqid(),
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'created_at' => date('c')
        ];

        $users[] = $nouveau; // ajouter au tableau
        file_put_contents('users.json', json_encode($users,JSON_PRETTY_PRINT ));
        $message = 'Utilisateur ajouté avec succès !';
        // Recharger la liste depuis le fichier pour être sûr
        $users = json_decode(file_get_contents($fichier), true);
    }
}

// Suppression d'un utilisateur avec get
if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    foreach ($users as $k => $u) {
        if (isset($u['id']) && $u['id'] === $idToDelete) {
            unset($users[$k]);
            // réindexer
            $users = array_values($users);
            file_put_contents($fichier, json_encode($users, JSON_PRETTY_PRINT ));
            $message = 'Utilisateur supprimé.';
            break;
        }
    }
}

// Modification simple affichage du formqulaire de modification
$editing = null;
if (isset($_GET['edit'])) {
    $idToEdit = $_GET['edit'];
    foreach ($users as $u) {
        if (isset($u['id']) && $u['id'] === $idToEdit) {
            $editing = $u;
            break;
        }
    }
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $id = $_POST['id'] ?? '';
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nom === '' || $prenom === '' || $email === '') {
        $message = 'Merci de remplir tous les champs.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email invalide.';
    } else {
        foreach ($users as $k => $u) {
            if (isset($u['id']) && $u['id'] === $id) {
                $users[$k]['nom'] = $nom;
                $users[$k]['prenom'] = $prenom;
                $users[$k]['email'] = $email;
                $users[$k]['updated_at'] = date('c');
                file_put_contents($fichier, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                $message = 'Utilisateur modifié.';
                // mettre fin
                break;
            }
        }
        // recharger la liste et annuler le mode édition
        $users = json_decode(file_get_contents($fichier), true);
        $editing = null;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion Utilisateurs (JSON)</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <style>
        :root{
            --bg:#f3f4f6;
            --card:#ffffff;
            --accent:#2563eb;
            --danger:#ef4444;
            --muted:#6b7280;
        }
        *{box-sizing:border-box}
        body{
            font-family: Inter, Roboto, Arial, sans-serif;
            background: var(--bg);
            margin:0;padding:20px;
        }
        .container{max-width:1000px;margin:20px auto;}
        .card{
            background:var(--card);
            padding:18px;border-radius:10px;box-shadow:0 6px 20px rgba(2,6,23,0.06);margin-bottom:18px;
        }
        h1{margin:0 0 10px;font-size:20px}
        form .row{display:flex;gap:8px;}
        input[type="text"],input[type="email"]{
            flex:1;padding:10px;border:1px solid #e5e7eb;border-radius:6px;
        }
        button{
            background:var(--accent);color:white;padding:10px 14px;border:none;border-radius:6px;cursor:pointer;
        }
        button.secondary{background:#374151}
        table{width:100%;border-collapse:collapse;margin-top:12px}
        th,td{padding:10px;border-bottom:1px solid #eef2f7;text-align:left}
        .actions a{margin-right:8px;text-decoration:none;color:var(--muted)}
        .message{padding:8px;background:#ecfccb;color:#365314;border-radius:6px;margin-bottom:12px}
        .small{font-size:13px;color:var(--muted)}
        .danger{color:var(--danger)}
        @media(max-width:700px){
            form .row{flex-direction:column}
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Gestion des utilisateurs (stockage JSON)</h1>
        <p class="small">Ajouter, modifier et supprimer des utilisateurs. Les données sont stockées dans <code>users.json</code>.</p>
        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <?php if ($editing): ?>
            <h2>Modifier l'utilisateur</h2>
            <form method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($editing['id'], ENT_QUOTES, 'UTF-8') ?>">
                <div class="row">
                    <input type="text" name="nom" placeholder="Nom" value="<?= htmlspecialchars($editing['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    <input type="text" name="prenom" placeholder="Prénom" value="<?= htmlspecialchars($editing['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($editing['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div style="margin-top:10px"> 
                    <button type="submit" name="modifier">Enregistrer</button>
                    <a href="./" class="small" style="margin-left:12px">Annuler</a>
                </div>
            </form>
        <?php else: ?>
            <h2>Ajouter un utilisateur</h2>
            <form method="POST">
                <div class="row">
                    <input type="text" name="nom" placeholder="Nom" required>
                    <input type="text" name="prenom" placeholder="Prénom" required>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div style="margin-top:10px">
                    <button type="submit" name="ajouter">Ajouter</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <div class="card">
        <h2>Liste des utilisateurs</h2>
        <?php if (empty($users)): ?>
            <p class="small">Aucun utilisateur pour l'instant.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr><th>Nom</th><th>Prénom</th><th>Email</th><th class="small">Actions</th></tr>
                </thead>
                <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($u['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($u['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="actions">
                            <a href="?edit=<?= urlencode($u['id'] ?? '') ?>"> Modifier</a>
                            <a href="?delete=<?= urlencode($u['id'] ?? '') ?>" class="danger" onclick="return confirm('Supprimer cet utilisateur ?')"> Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
