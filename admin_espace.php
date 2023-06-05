<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_connexion.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $patient_id = $_POST['patient_id']; 
    $temps_preparation = $_POST['temps_preparation'];
    $temps_repos = $_POST['temps_repos'];
    $temps_cuisson = $_POST['temps_cuisson'];
    $ingredients = $_POST['ingredients'];
    $etapes = $_POST['etapes'];
    $allergenes = $_POST['allergenes'];
    $type_regime = $_POST['type_regime'];
    $case_cochee = isset($_POST['case_cochee']) ? 1 : 0; 

    
    $servername = "localhost";
    $username = "nom_utilisateur";
    $password = "mot_de_passe";
    $dbname = "dietiticienne_db";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    
    $sql = "INSERT INTO recettes (patient_id, titre, description, temps_preparation, temps_repos, temps_cuisson, ingredients, etapes, allergenes, type_regime, case_cochee)
            VALUES ('$patient_id', '$titre', '$description', '$temps_preparation', '$temps_repos', '$temps_cuisson', '$ingredients', '$etapes', '$allergenes', '$type_regime', '$case_cochee')";

    if ($conn->query($sql) === TRUE) {
        
        header('Location: admin_espace.php');
        exit;
    } else {
        echo "Erreur lors de l'ajout de la recette : " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une recette</title>
</head>
<body>
    <h1>Ajouter une recette</h1>

    <form method="POST" action="">
        <label for="patient_id">Patient :</label>
        <select name="patient_id" required>
            <option value="" selected disabled>Sélectionnez un patient</option>
            <option value="1">Patient 1</option>
            <option value="2">Patient 2</option>
            <option value="3">Patient 3</option>
            <option value="4">Patient 4</option>
            <option value="5">Patient 5</option>
            <option value="6">Patient 6</option>
            <option value="7">Patient 7</option>
            <option value="8">Patient 8</option>
        
        </select><br>

        <label for="titre">Titre :</label>
        <input type="text" name="titre" required><br>

        <label for="description">Description :</label>
        <textarea name="description" required></textarea><br>

        <label for="temps_preparation">Temps de préparation :</label>
        <input type="text" name="temps_preparation" required><br>

        <label for="temps_repos">Temps de repos :</label>
        <input type="text" name="temps_repos" required><br>

        <label for="temps_cuisson">Temps de cuisson :</label>
        <input type="text" name="temps_cuisson" required><br>

        <label for="ingredients">Liste des ingrédients :</label>
        <textarea name="ingredients" required></textarea><br>

        <label for="etapes">Les étapes :</label>
        <textarea name="etapes" required></textarea><br>

        <label for="allergenes">Liste des allergènes possibles :</label>
        <textarea name="allergenes" required></textarea><br>

        <label for="type_regime">Type de régime :</label>
        <input type="text" name="type_regime" required><br>

        <label for="case_cochee">Case à cocher :</label>
        <input type="checkbox" name="case_cochee"><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
