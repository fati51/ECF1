<?php
session_start();


if (isset($_SESSION['admin_id'])) {
    header('Location: admin_espace.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['mot_de_passe'];

    
    if ($pseudo === 'admin' && $motDePasse === 'admin123') {
        
        $_SESSION['admin_id'] = 1;

        
        header('Location: admin_espace.php');
        exit;
    }

    
    $error = "Identifiants invalides. Veuillez réessayer.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
</head>
<body>
    <h1>Connexion Administrateur</h1>

    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" required><br>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
