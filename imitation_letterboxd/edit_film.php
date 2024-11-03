<?php
require 'config/auth.php';
verifierAdmin();
require 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM films WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$film) {
        header("Location: films.php");
        exit();
    }
} else {
    header("Location: films.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $realisateur = $_POST['realisateur'];
    $annee_sortie = $_POST['annee_sortie'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $affiche_url = $_POST['affiche_url'];

    $stmt = $pdo->prepare("UPDATE films SET titre = :titre, realisateur = :realisateur, annee_sortie = :annee_sortie, genre = :genre, description = :description, affiche_url = :affiche_url WHERE id = :id");
    $stmt->execute([
        'titre' => $titre,
        'realisateur' => $realisateur,
        'annee_sortie' => $annee_sortie,
        'genre' => $genre,
        'description' => $description,
        'affiche_url' => $affiche_url,
        'id' => $id
    ]);

    header("Location: films.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier le Film</title>
</head>
<body class="background">
    <h1>Modifier le Film</h1>
    
    <form action="edit_film.php?id=<?= $film['id']; ?>" method="POST">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($film['titre']); ?>" required><br><br>

        <label for="realisateur">Réalisateur :</label>
        <input type="text" id="realisateur" name="realisateur" value="<?= htmlspecialchars($film['realisateur']); ?>" required><br><br>

        <label for="annee_sortie">Année de Sortie :</label>
        <input type="number" id="annee_sortie" name="annee_sortie" value="<?= htmlspecialchars($film['annee_sortie']); ?>" min="1900" max="2100" required><br><br>

        <label for="genre">Genre :</label>
        <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($film['genre']); ?>" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description"><?= htmlspecialchars($film['description']); ?></textarea><br><br>

        <label for="affiche_url">URL de l'affiche :</label>
        <input type="url" id="affiche_url" name="affiche_url" value="<?= htmlspecialchars($film['affiche_url']); ?>"><br><br>

        <button type="submit">Enregistrer les Modifications</button>
    </form>

    <p class="container roboto-regular"><a href="films.php">Retour à la Liste des Films</a></p>
</body>
</html>
