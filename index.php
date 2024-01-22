<?php
// lorsque l'on utilise les sessions, on commence toujours le script par "session_start();
// avant d'écrire la moindre ligne
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="designV3.css"/>
    <link rel="icon" type="image/jpg" href="images/iconeBook.png"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Oval&display=swap" rel="stylesheet">
    <title>Bibliothèque ESB</title>
</head>
<body>
<?php

include "requeteConnexionBDD.php";
?>

<header>
    <nav class="banniere">
        <a href="index.php" class="logo"><img src="images/iconeBook2.png" alt="empilement de livres">
            <h1>Bibliothèque ESB</h1></a>
        <ul class="menu">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="LivresBestOf.php">Livres</a></li>
            <li> <a href="index.php"><button class="boutonMenu" type="submit">Connexion</button></a>
                <a href="creationCompte.php"><button type="submit" class="boutonMenu">Création de compte</button></a></li>
        </ul>
    </nav>
</header>
<section>
    <div class="connectionIndex">

        <h2>Connexion</h2>
        <form action="" method="post" class="formulaire">
            <label for="emailUser" class="labelcrea">Votre email :</label>
            <input id="emailUser" name="emailUser" type="email" placeholder="email">
            <br/>
            <label for="motDePasse" class="labelcrea">Votre mot de passe</label>
            <input id="motDePasse" name="motDePasse" type="password" placeholder="mot de passe">
            <br/>
            <?php


            if (isset($_POST['emailUser']) && isset($_POST['motDePasse'])) {

            $query = 'SELECT * FROM utilisateur where emailUser = "' . $_POST['emailUser'] . '" AND motDePasse = "' . $_POST['motDePasse'] . '"; ';

                $resultat = $db->query($query) or die(print_r($db->errorInfo()));
                foreach ($resultat as $row) {
                    if ($_POST['emailUser'] == $row['emailUser'] && $_POST['motDePasse'] == $row['motDePasse']) {
                        if ($_POST['emailUser'] == "admin@admin.fr" && $_POST['motDePasse'] == "admin") {
                            header("Location:pageAdmin.php");
                            $_SESSION['admin'] = $_POST['emailUser'];
                                } else {
                                    header("Location:profil.php");
                            $_SESSION['userPrenom'] = $row['prenomUser'];
                            $_SESSION['user'] = $row['emailUser'];
                                }
                            }
                    if ($_POST['emailUser'] != $row['emailUser'] || $_POST['motDePasse'] != $row['motDePasse']) {
                        header("Location:mauvaiseConnection.php?" . $_POST['emailUser'] . "," . $_POST['motDePasse']);
                    }
                }
                echo "Identifiant ou mot de passe incorrect <br/>";
            }
            ?>
            <button type="submit" class="boutonIndex">Valider</button>
            <a href="creationCompte.php">
                <button type="button" class="boutonIndex">Création de compte</button>
            </a>
        </form>
    </div>
</section>




<footer class="footindex">
    <p class ="copyright">Copyright 2023 - ESB</p>
</footer>
</body>
</html>
