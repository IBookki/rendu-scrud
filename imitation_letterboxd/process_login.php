<?php
session_start();
require 'config/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (!empty($username) && !empty($password)) {
        // Prépare la requête pour trouver l'utilisateur
        $stmt = $pdo->prepare("SELECT id, nom_utilisateur, mot_de_passe, role FROM utilisateurs WHERE nom_utilisateur = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifie si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nom_utilisateur'];
            $_SESSION['role'] = $user['role'];

            // Redirige l'utilisateur selon son rôle
            if ($user['role'] === 'administrateur') {
                header("Location: admin_dashboard.php");  // Page admin
            } else {
                header("Location: films.php");  // Page d'accueil pour utilisateurs
            }
            exit();
        } else {
            // Redirige avec un message d'erreur si les identifiants sont incorrects
            header("Location: login.php?error=invalid");
            exit();
        }
    } else {
        header("Location: login.php?error=emptyfields");
        exit();
    }
} else {
    // Redirige si la méthode n'est pas POST
    header("Location: login.php");
    exit();
}
