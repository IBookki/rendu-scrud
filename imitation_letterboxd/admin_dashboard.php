<?php
require 'config/auth.php';
verifierAdmin();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abel&family=Nova+Square&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard Admin</title>
</head>

<body class="background">
<div class="container">
    <h1 class="roboto-regular p-20">BIENVENUE ADMINISTRATEUR</h1>
    <ul class="vertical center">
        <li class="spacing"><a href="add_film.php" class="roboto-light">AJOUTER UN FILM</a></li>
        <li class="spacing"><a href="films.php" class="roboto-light">MODIFIER / SUPPRIMER UN FILM</a></li>
        <li class="spacing"><a href="logout.php" class="roboto-light text-red">DECONNEXION</a></li>
    </ul>
</div>

</body>
</html>
