
<?php
session_start();


if (!isset($_SESSION['patient_id'])) {
    header('Location: connexion.php');
    exit;
}


$pseudo = $_SESSION['pseudo'];


$servername = "localhost";
$username = " ";
$password = " ";
$dbname = "dietiticienne_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}


$sql = "SELECT * FROM recettes WHERE patient_id = " . $_SESSION['patient_id'];
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    $recettes = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $recettes = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace patient</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Bienvenue dans votre espace personnel, <?php echo $pseudo; ?>.</h1>

        <?php if (count($recettes) > 0): ?>
            <h2 class="mt-4">Vos recettes :</h2>
            <ul class="list-group">
                <?php foreach ($recettes as $recette): ?>
                    <li class="list-group-item">
                        <h3><?php echo $recette['titre']; ?></h3>
                        <p><?php echo $recette['description']; ?></p>

                        <form>
                            <input type="hidden" name="recette_id" value="<?php echo $recette['id']; ?>">
                            <div class="mb-3">
                                <label for="avis" class="form-label">Avis :</label>
                                <textarea class="form-control" name="avis" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note (1-5) :</label>
                                <input type="number" class="form-control" name="note" min="1" max="5" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer l'avis</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="mt-4">Aucune recette disponible.</p>
        <?php endif; ?>

        <form method="POST" action="deconnexion.php" class="mt-4">
            <button type="submit" class="btn btn-danger">Se déconnecter</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>


