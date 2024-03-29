<?php require 'inc/config.php'; ?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Chouette Coin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Le Chouette Coin</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                    <a class="nav-link" href="products.php">Produits</a>
                    <!-- //? Affichage conditionnel du bouton se connecter/ page de profil -->
                    <?php
                    //? Vérification des variables des sessions : si elle n'existent pas, alors afficher un bouton se connecter
                    if (empty($_SESSION['id'])) {
                    ?>
                        <a class="nav-link" href="login.php">Se connecter</a>
                    <?php
                        //? Si elles existent, afficher un bouton qui redirige vers la page de profil et un bouton de déconnexion
                    } else {
                    ?>
                        <!-- //? J'affiche le nom de l'utilisateur connecté qui est stocké en token de session dans le bouton -->
                        <a class="nav-link" href="profile.php"><?php echo $_SESSION['username']; ?></a>
                        <!-- //? Pour me déconnecter j'envoie une requête GET avec l'info logout qui permet de se déconnecter de n'importe où. -->
                        <a class="nav-link" href="?logout">Se déconnecter</a>
                    <?php
                    }
                    ?>
                </nav>
            </div>
        </header>