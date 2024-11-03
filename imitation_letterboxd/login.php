<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="style.css" />
    <title>Connexion</title>
</head>
<body class="background">

    <div class="center"></div>
        <h2 class="roboto-regular p-20">Connexion</h2>
        <form action="process_login.php" method="POST">
            <label class="" for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Se connecter</button>

        </form>

        <p class="container roboto-regular"><a href="films.php">Retour aux films</a></p> 

    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
        echo "<p style='color:red;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
    }
    ?>
</body>
</html>
