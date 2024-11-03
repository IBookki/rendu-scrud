<?php
session_start();

function verifierAdmin() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'administrateur') {
        header("Location: login.php");  // Redirige vers la page de connexion si non autorisé
        exit();
    }
}
?>
