<?php
session_start();
require 'config/auth.php';
verifierAdmin();  // Vérifie que l'utilisateur est bien un administrateur
require 'config/db.php';

// Vérifie si l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prépare la requête de suppression
    $stmt = $pdo->prepare("DELETE FROM films WHERE id = :id");

    try {
        // Exécute la requête de suppression
        $stmt->execute(['id' => $id]);
        echo "<p>Film supprimé avec succès.</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur : " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Aucun identifiant de film fourni.</p>";
}

// Redirige vers la liste des films après suppression
header("Location: films.php");
exit();
?>
