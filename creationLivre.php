<?php
session_start();
$_SESSION['admin'];
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="designV3.css"/>
    <link rel="icon" type="image/jpg" href="images/iconeBook.png"/>
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
    <div class="connectionCreation">
        <h2>Création de livre</h2>
        <form action="#" method="post">
            <input placeholder="Titre" id="titre" name="titre" type="text" class="rechercheAdmin"><br>
            <input placeholder="Nombre de Pages" id="nbPage" name="nbPage" type="number" class="rechercheAdmin"><br>
            <input placeholder="ISBN" id="isbn" name="isbn" type="number" class="rechercheAdmin"><br>

            <select name="auteurId" id="auteurId" class="boutonDeroulant">
                <option value="">--Auteur--</option>
                <?php

                // Je construis ma requete
                $resultat = $db->query('SELECT * FROM auteur ORDER BY nomAuteur') or die(print_r($db->errorInfo()));

                foreach ($resultat as $row) {
                    echo '<option value="' . $row['idAuteur'] . '">' . $row['nomAuteur'] . ' ' . $row['prenomAuteur'] . '</option><br>';
                }

                ?>
            </select>

            <select name="editeurId" id="editeurId" class="boutonDeroulant">
                <option value="">--Editeur--</option>
                <?php
                // Je construis ma requete
                $resultat = $db->query('SELECT * FROM editeur ORDER BY nomEditeur') or die(print_r($db->errorInfo()));

                foreach ($resultat as $row) {
                    echo '<option value="' . $row['idEditeur'] . '">' . $row['nomEditeur'] . '</option><br>';
                }

                ?>
            </select>
            <select name="genreId" id="genreId" class="boutonDeroulant">
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
            <br/>
            <button class="boutonAutre" type="submit">Envoyer</button>
        </form>
    </div>

    <div  class="titreadmin">
    <h2>Ajouts:</h2>
        <p>S'il manque l'auteur, l'éditeur ou le genre.</p>
    </div>

    <div class="connectionLivres">

        <div class="grille">
            <h2>Auteur</h2>
            <p>S'il' n'existe pas</p>
            <form action="" method="post">
                <label for="nomAuteur">Nom :</label><br/>
                <input id="nomAuteur" name="nomAuteur" type="text" class="rechercheAjout" required><br/>
                <label for="prenomAuteur">Prénom :</label><br/>
                <input id="prenomAuteur" name="prenomAuteur" type="text" class="rechercheAjout"><br/>
                <br/>
                <button type="submit" name="validauteur" class="boutonUser">Valider</button>
            </form>
            <?php
            if (isset($_POST['nomAuteur'])) {

                $validauteur = $db->prepare('INSERT INTO auteur(nomAuteur, prenomAuteur) VALUES (:nomAuteur, :prenomAuteur)') or die(print_r($db->errorInfo()));

                $validauteur->execute([
                    'nomAuteur' => $_POST['nomAuteur'],
                    'prenomAuteur' => $_POST['prenomAuteur'],
                ]);
            }
            ?>
        </div>
        <div class="grille">
            <h2>Editeur</h2>
            <p>S'il n'existe pas</p>
            <form action="" method="post">
                <label for="nomEditeur">Editeur</label><br/>
                <input id="nomEditeur" name="nomEditeur" type="text" class="rechercheAjout" required>
                <br/>
                <button type="submit" name="validediteur" class="boutonUser">Valider</button>
            </form>
            <?php
            if (isset($_POST['nomEditeur'])) {

                $validediteur = $db->prepare('INSERT INTO editeur(nomEditeur) VALUES (:nomEditeur)') or die(print_r($db->errorInfo()));

                $validediteur->execute([
                    'nomEditeur' => $_POST['nomEditeur'],
                ]);
            }
            ?>
        </div>
        <div class="grille">
            <h2>Genre</h2>
            <p>S'il n'existe pas</p>
            <form action="" method="post">
                <label for="libelle">Genre</label><br/>
                <input id="libelle" name="libelle" type="text" class="rechercheAjout" required>
                <br/>
                <button type="submit" name="validgenre" class="boutonUser">Valider</button>
            </form>
            <?php
            if (isset($_POST['libelle'])) {

                $validgenre = $db->prepare('INSERT INTO genre(libelle) VALUES (:libelle)') or die(print_r($db->errorInfo()));

                $validgenre->execute([
                    'libelle' => $_POST['libelle'],
                ]);
            }
            ?>
        </div>
    </div>
</section>

<footer>
    <p class="copyright">Copyright 2023 - ESB</p>
</footer>
</body>
</html>


<?php

if (isset($_POST['titre']) && isset($_POST['nbPage']) && isset($_POST['isbn']) && isset($_POST['auteurId']) && isset($_POST['editeurId']) && isset($_POST['genreId'])) {

// Je construis ma requetes
    $query = 'INSERT INTO livre (titre, nbPage, isbn, auteurId, editeurId, genreId) values (:titre, :nbPage, :isbn, :auteurId, :editeurId, :genreId)';
    $pdoStat = $db->prepare($query);

    $executeIsOk = $pdoStat->execute([
        'titre' => $_POST['titre'],
        'nbPage' => $_POST['nbPage'],
        'isbn' => $_POST['isbn'],
        'auteurId' => $_POST['auteurId'],
        'editeurId' => $_POST['editeurId'],
        'genreId' => $_POST['genreId'],
    ]) or die(print_r($db->errorInfo()));
}

?>

<!-- <section  class="creation">
    <h2>Création de Livre</h2>
    <form action="" method="post">
        <label for="titre">Titre</label>
        <input id="titre" name="titre" type="text" required>
        <br/>
        <label for="nbPage">Nombre de pages</label>
        <input id="nbPage" name="nbPage" type="number" required>
        <br/>
        <label for="isbn">ISBN</label>
        <input id="isbn" name="isbn" type="number" required>
        <br/>
        <label for="auteurId">Auteur</label>
        <input id="auteurId" name="auteurId" type="number" required>
        <br/>
        <label for="editeurId">Editeur</label>
        <input id="editeurId" name="editeurId" type="number" required>
        <br/>
        <label for="genreId">Genre</label>
        <input id="genreId" name="genreId" type="number" required>
        <br/>
        <button type="submit">Valider</button>
    </form>

</section>

<footer>
    <p class="copyright">Copyright 2023 - ESB</p>
</footer>
</body>
</html> -->
