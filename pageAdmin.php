<?php
session_start();
$_SESSION['admin'];
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="designV3.css" />
    <link rel="icon" type="image/jpg" href="images/iconeBook.png" />
    <title>Bibliothèque ESB</title>
</head>
<body>
<?php
// Connexion à la base de données
include "requeteConnexionBDD.php";
?>
<header>
    <?php
    include('menuAdmin.php');
    ?>
</header>

<section>
    <h2 class="titresolo">Bienvenue cher administrateur</h2>
    <div class="connectionAdmin2"> <!-- Section création de livre -->
        <p>Si un livre n'existe pas, vous pouvez le créer ci-dessous :</p>
        <a href="creationLivre.php"><button type="button" class="boutonUser">Création de Livre</button></a>
    </div>

    <div class="connectionCreation">
        <h2>Modification</h2> <!-- Section modification de livre -->

        <form action="ModifLivre.php" method="post">

            <select name="idLivre" id="idLivre" class="boutonDeroulant">
                <option value="">--Livre--</option>
                <?php

                // Je construis ma requete
                $resultat = $db->query('SELECT * FROM livre ORDER BY titre') or die(print_r($db->errorInfo()));

                foreach ($resultat as $row) {
                    echo '<option value="' . $row['idLivre'] . '">' . $row['titre'] .'</option><br>';
                }

                ?>
            </select>
            <button class="boutonUser" type="submit">Modifier</button>

        </form>
    </div>

    <div class="connectionModif">

        <div class="grille">
            <h3>Auteur</h3>
            <form action="ModifAuteur.php" method="post">
            <select name="idAuteur" id="idAuteur" class="boutonDeroulant">
                <option value="">--Auteur--</option>
                <?php

                // Je construis ma requete
                $resultat = $db->query('SELECT * FROM auteur ORDER BY nomAuteur') or die(print_r($db->errorInfo()));

                foreach ($resultat as $row) {
                    echo '<option value="' . $row['idAuteur'] . '">' . $row['nomAuteur'] . ' ' . $row['prenomAuteur'] . '</option><br>';
                }

                ?>
            </select>

                <button type="submit" name="validauteur" class="boutonUser">Modifier</button>
            </form>

        </div>
        <div class="grille">
            <h3>Editeur</h3>
            <form action="ModifEditeur.php" method="post">
            <select name="idEditeur" id="idEditeur" class="boutonDeroulant">
                <option value="">--Editeur--</option>
                <?php
                // Je construis ma requete
                $resultat = $db->query('SELECT * FROM editeur ORDER BY nomEditeur') or die(print_r($db->errorInfo()));

                foreach ($resultat as $row) {
                    echo '<option value="' . $row['idEditeur'] . '" id="' . $row['idEditeur'] . '">' . $row['nomEditeur'] . '</option><br>';
                }

                ?>
            </select>


                <button type="submit" name="validediteur" class="boutonUser">Modifier</button>
            </form>

        </div>
        <div class="grille">
            <h3>Genre</h3>
            <form action="ModifGenre.php" method="post">
            <select name="idGenre" id="idGenre" class="boutonDeroulant">
                <option value="">--Genre--</option>
                <?php
                // Je construis ma requete
                $resultat = $db->query('SELECT * FROM genre  ORDER BY libelle') or die(print_r($db->errorInfo()));

                echo "ok";
                foreach ($resultat as $row) {
                    echo '<option value="' . $row['idGenre'] . '">' . $row['libelle'] . '</option><br>';
                }

                ?>
            </select>

                <button type="submit" name="validgenre" class="boutonUser">Modifier</button>
            </form>

        </div>
    </div>

    <div class="connectionAdmin2">
        <h2>Suppression</h2>
        <p>Rechercher un titre pour le modifier :</p>
        <form action="" method="post">
            <input id="mot" name="mot" type="text" class="rechercheAdmin" placeholder="Recherche"><br/>
            <button type="submit" name="recherche" class="boutonUser">Valider</button>
        </form>

        <?php
        if (isset($_POST['mot'])) {
            $recherche = $db->query('SELECT l.titre, a.nomAuteur, a.prenomAuteur, nomEditeur, libelle, isbn, nbPage, l.idLivre
    FROM livre l
    INNER JOIN auteur a
    ON a.idAuteur = l.auteurId
    INNER JOIN editeur ed
    ON ed.idEditeur = l.editeurId
    INNER JOIN genre g
    ON g.idGenre = l.genreId
    WHERE l.titre LIKE "%' . $_POST['mot'] . '%" OR a.nomAuteur LIKE "%' . $_POST['mot'] . '%" OR a.prenomAuteur LIKE "%' . $_POST['mot'] . '%" OR ed.nomEditeur LIKE "%' . $_POST['mot'] . '%";')
            or die(print_r($db->errorInfo()));


            foreach ($recherche as $row) {
                echo "<hr>";
                echo "<p><strong>Titre</strong> : " . $row['titre'] . "<br/>";
                echo "<strong>Auteur</strong> : " . $row['nomAuteur'] . " ";
                echo $row['prenomAuteur'] . "<br/>";
                echo "<strong>Editeur</strong> : " . $row['nomEditeur'] . "</p>";
                echo "<form action='supprimerLivre.php' method='post'>
                <input type='hidden' value=".$row['idLivre']." name='idLivre' id='idLivre'>
                <button name= 'supprimer' type='submit' class='boutonAutre'>Supprimer</button>
                </form>";
            }
        }
        ?>
    </div>
</section>



<footer>
    <p class="copyright">Copyright 2023 - ESB</p>
</footer>
</body>
</html>

