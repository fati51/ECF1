<?php
session_start();


if (isset($_SESSION['patient_id'])) {
    unset($_SESSION['patient_id']);
    session_destroy();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['mot_de_passe'];

    
    $servername = "localhost";
    $username = "votre_nom_utilisateur";
    $password = "votre_mot_de_passe";
    $dbname = "dietiticienne_db";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    
    $sql = "SELECT id, mot_de_passe FROM patients WHERE pseudo = '$pseudo'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['mot_de_passe'];

        if (password_verify($motDePasse, $hashedPassword)) {
            
            $_SESSION['patient_id'] = $row['id'];
            $_SESSION['pseudo'] = $row['pseudo'];
            
            header('Location: espace_patient.php');
            exit;
        }
    }

    
    $error = "Identifiants de connexion invalides.";

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

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
    <p> <a href="inscription.php">inscrive-vous</a></p>
</body>
</html>
