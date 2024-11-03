<?php
session_start();
require 'config/auth.php';
verifierAdmin();
require 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM films WHERE id = :id");

    try {
        $stmt->execute(['id' => $id]);
        echo "<p>Film supprimé avec succès.</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur : " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Aucun identifiant de film fourni.</p>";
}

header("Location: films.php");
exit();
?>
