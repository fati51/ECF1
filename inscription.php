
<?php
session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['mot_de_passe'];

    

    
    $servername = "localhost";
    $username = " ";
    $password = " ";
    $dbname = "dietiticienne_db";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    
    $sql = "SELECT id FROM patients WHERE pseudo = '$pseudo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "Ce pseudo est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        
        $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);

        $sql = "INSERT INTO patients (pseudo, mot_de_passe) VALUES ('$pseudo', '$hashedPassword')";
        if ($conn->query($sql) === TRUE) {
            
            header('Location: connexion.php');
            exit;
        } else {
            $error = "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" required><br>

        <input type="submit" value="S'inscrire">
        
    </form>
    
    <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
</body>
</html>
