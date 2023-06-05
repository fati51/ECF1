<?php
session_start();

if (!isset($_SESSION['patient_id'])) {
    header('Location: connexion.php');
    exit;
}


if (isset($_GET['action']) && $_GET['action'] === 'logout') {

    session_destroy();

    
    header('Location: connexion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Patient</title>
</head>
<body>
    



    <a href="connexion.php">Se déconnecter</a>
</body>
</html>
