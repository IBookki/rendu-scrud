<?php
require 'config/db.php';

if ($pdo) {
    echo "Connexion réussie !";
} else {
    echo "Erreur de connexion.";
}
?>
