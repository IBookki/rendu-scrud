<?php
require 'config/db.php';


$nom_utilisateur = 'admin';
$mot_de_passe = 'admin';
$email = 'admin@gmail.com';
$role = 'administrateur';

$hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, email, role) VALUES (:nom_utilisateur, :mot_de_passe, :email, :role)");
    $stmt->execute([
        'nom_utilisateur' => $nom_utilisateur,
        'mot_de_passe' => $hashed_password,
        'email' => $email,
        'role' => $role
    ]);

    echo "Administrateur ajouté avec succès !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
