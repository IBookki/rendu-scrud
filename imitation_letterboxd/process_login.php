<?php
session_start();
require 'config/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT id, nom_utilisateur, mot_de_passe, role FROM utilisateurs WHERE nom_utilisateur = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nom_utilisateur'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'administrateur') {
                header("Location: admin_dashboard.php"); 
            } else {
                header("Location: films.php"); 
            }
            exit();
        } else {
            header("Location: login.php?error=invalid");
            exit();
        }
    } else {
        header("Location: login.php?error=emptyfields");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
