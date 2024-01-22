<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="designV3.css" />
    <link rel="icon" type="image/jpg" href="images/iconeBook.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Oval&display=swap" rel="stylesheet">
    <title>Bibliothèque ESB</title>
</head>
<body>
<?php
// Connexion à la base de données
include "requeteConnexionBDD.php";
?>
<header>
    <nav class="banniere">
        <a href="index.php" class="logo"><img src="images/iconeBook2.png" alt="empilement de livres">
            <h1>Bibliothèque ESB</h1></a>
        <ul class="menu">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="LivresBestOf.php">Livres</a></li>
            <li> <a href="index.php"><button class="boutonMenu" type="submit">Connexion</button></a></li>
        </ul>
    </nav>
</header>
<section>
    <div class="connectionIndex">

        <h2>Bravo !</h2>
        <p>Votre compte est créé.</p>
        <a href="index.php"><button type="button" class="boutonIndex">Connexion</button></a>

    </div>
</section>

<footer>
    <p class="copyright">Copyright 2023 - ESB</p>
</footer>
</body>
</html>
<?php

if (isset($_POST['emailUser']) && isset($_POST['motDePasse']) && isset($_POST['nomUser']) && isset($_POST['prenomUser']) && isset($_POST['dateNaissance'])) {
    $query = 'INSERT INTO utilisateur(emailUser, motDePasse, nomUser, prenomUser, dateNaissance) values ( :emailUser, :motDePasse, :nomUser, :prenomUser, :dateNaissance)';
    $pdoStat = $db->prepare($query);

    $executeIsOk = $pdoStat->execute([
        'emailUser' => $_POST['emailUser'],
        'motDePasse' => $_POST['motDePasse'],
        'nomUser' => $_POST['nomUser'],
        'prenomUser' => $_POST['prenomUser'],
        'dateNaissance' => $_POST[('dateNaissance')],
    ]) or die(print_r($db->errorInfo()));
}
?>
