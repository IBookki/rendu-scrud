<?php
require 'config/auth.php';
verifierAdmin();  
require 'config/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $realisateur = $_POST['realisateur'];
    $annee_sortie = $_POST['annee_sortie'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $affiche_url = $_POST['affiche_url'];


    $stmt = $pdo->prepare("INSERT INTO films (titre, realisateur, annee_sortie, genre, description, affiche_url) VALUES (:titre, :realisateur, :annee_sortie, :genre, :description, :affiche_url)");
    
    try {
        $stmt->execute([
            'titre' => $titre,
            'realisateur' => $realisateur,
            'annee_sortie' => $annee_sortie,
            'genre' => $genre,
            'description' => $description,
            'affiche_url' => $affiche_url
        ]);
        echo "<p>Film ajouté avec succès !</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="background">


     <div class="container">

        <h1 class="roboto-regular p-20">Ajouter un Film</h1>

        <form action="add_film.php" method="POST">
            <label class="roboto-light" for="titre">TITRE :</label>
            <input type="text" id="titre" name="titre" required><br><br>

            <label class="roboto-light" for="realisateur">REALISATEUR :</label>
            <input type="text" id="realisateur" name="realisateur" required><br><br>

            <label class="roboto-light" for="annee_sortie">ANNEE DE SORTIE :</label>
            <input type="number" id="annee_sortie" name="annee_sortie" min="1900" max="2100" required><br><br>

            <label class="roboto-light" for="genre">GENRE :</label>
            <input type="text" id="genre" name="genre" required><br><br>

            <label class="roboto-light"  for="description">DESCRIPTION :</label>
            <textarea id="description" name="description"></textarea><br><br>

            <label class="roboto-light" for="affiche_url">URL DE L'AFFICHE :</label>
            <input type="url" id="affiche_url" name="affiche_url"><br><br>

            <button type="submit">AJOUTER</button>
        </form>
        <p class="container roboto-regular"><a href="admin_dashboard.php">Retour au Tableau de Bord</a></p>
    </div>

    
    

</body>
</html>
