<?php
session_start();
require 'config/db.php';

// Récupère tous les films de la base de données
$stmt = $pdo->query("SELECT * FROM films ORDER BY date_ajout DESC");
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste des Films</title>
</head>
<body class="background">

    <div class="header">
        <h1 class="text-center roboto-regular">FILMS</h1>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur'): ?>
            <a class="btn" href="admin_dashboard.php">Retour au Tableau de Bord</a> 
        <?php else: ?>
            <a class="btn" href="login.php">Connexion</a>
        <?php endif; ?> 

    </div>

    <div class="container-films">
    <?php if (count($films) > 0): ?>
        <?php foreach ($films as $film): ?>
            <div class="container-desc-film bg-grey">

               <div class="film-left">
                    <h2 class="roboto-regular"><?= htmlspecialchars($film['titre']); ?></h2>
                        
                    <?php if (!empty($film['affiche_url'])): ?>
                        <img src="<?= htmlspecialchars($film['affiche_url']); ?>" alt="Affiche de <?= htmlspecialchars($film['titre']); ?>" class="affiche">
                    <?php endif; ?>
                </div>

                <div class="film-right">
                    <p><strong>Réalisateur :</strong> <?= htmlspecialchars($film['realisateur']); ?></p>
                    <p><strong>Année de sortie :</strong> <?= htmlspecialchars($film['annee_sortie']); ?></p>
                    <p><strong>Genre :</strong> <?= htmlspecialchars($film['genre']); ?></p>
                    <p><?= nl2br(htmlspecialchars($film['description'])); ?></p>
                </div>

                <!--Modifier-->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur'): ?>
                    <a class="btn" href="edit_film.php?id=<?= $film['id']; ?>">Modifier</a>
                <?php endif; ?>

                <!--Supprimer-->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur'): ?>
                    <a class="btn btn-delete" href="delete_film.php?id=<?= $film['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?');" class="text-red-500">Supprimer</a>
                <?php endif; ?>
            </div>
    </div>
            
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun film n'a été ajouté pour le moment.</p>
    <?php endif; ?>
</body>
</html>
