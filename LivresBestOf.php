<?php
// lorsque l'on utilise les sessions, on commence toujours le script par "session_start();
// avant d'écrire la moindre ligne
session_start();
?>
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
            <li> <a href="index.php"><button class="boutonMenu" type="submit">Connexion</button></a>
                <a href="creationCompte.php"><button type="submit" class="boutonMenu">Création de compte</button></a></li>
        </ul>
    </nav>
</header>

<section>


    <h2 class="titresolo">Découvrez tous nos livres :<br/>
        <span class="petit">(A titre informatif)</span></h2>

    <div class="connectionLivres">

    <?php
    $resultat = $db->query("SELECT l.titre, a.prenomAuteur, a.nomAuteur, ed.nomEditeur, l.idLivre, l.boolDispo
	FROM livre l
    INNER JOIN auteur a
    	ON a.idAuteur = l.auteurId
        INNER JOIN editeur ed 
        	ON ed.idEditeur = l.editeurId
                   ORDER BY l.titre;") or die(print_r($db->errorInfo()));

    foreach ($resultat as $row) {
        echo "<div class='grille'><strong>Titre :</strong> " . $row['titre'] . "<br/>";
        echo "<strong>Auteur :</strong> " . $row['prenomAuteur'] . " ";
        echo $row['nomAuteur'] . "<br/> ";
        echo "<strong>Editeur :</strong> " . $row['nomEditeur']. "<br/>";
        if($row['boolDispo'] == 0){
            echo "<INPUT class='indisponible' TYPE='button' name='Indisponible' value='Indisponible' DISABLED>";
            } else {
            echo "<INPUT class='disponible' TYPE='button' name='Disponible' value='Disponible' DISABLED>";
        }
        echo "</div>";
        }
    ?>

    </div>
</section>

<footer>
    <p class="copyright">Copyright 2023 - ESB</p>
</footer>
</body>
</html>
