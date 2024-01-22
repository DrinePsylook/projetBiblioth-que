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
        <h2>Modification de livre</h2>

        <?php
        $idLivre = 0;
        $titre = '';
        $nbPage = '0';
        $isbn = '0';
        $nomAuteur = '';
        $prenomAuteur = '';
        $editeur = '';

        if (isset($_POST['idLivre'])) {
            $id = $_POST['idLivre'];
            $modif = $db->prepare('SELECT *
    FROM livre l
    INNER JOIN auteur a
    ON a.idAuteur = l.auteurId
    INNER JOIN editeur ed
    ON ed.idEditeur = l.editeurId
    INNER JOIN genre g
    ON g.idGenre = l.genreId
    WHERE l.idLivre = :id');
            $modif->execute(array(':id' => $id));
            $row = $modif->fetch();
            $idLivre = $row['idLivre'];
            $titre = $row['titre'];
            $nbPage = $row['nbPage'];
            $isbn = $row['isbn'];
            $nomAuteur = $row['nomAuteur'];
            $prenomAuteur = $row['prenomAuteur'];
            $editeur = $row['nomEditeur'];
            $genre = $row['libelle'];
            $auteurId = $row['auteurId'];
            $editeurId = $row['editeurId'];
            $genreId = $row['genreId'];
                    }
        ?>

        <?php
        echo '<form action="" method="post"> 
            <input id="idLivre" name="idLivre" type="hidden" value="' . $idLivre . '" class="rechercheAdmin">
            <label class="labelcrea">Titre :</label>    
            <input id="titre" name="titre" type="text" value="' . $titre . '" class="rechercheAdmin">
            <br/>
            <label class="labelcrea">Nombre de pages:</label> 
            <input id="nbPage" name="nbPage" type="text" value="' . $nbPage . '"  class="rechercheAdmin">
            <br/>
            <label class="labelcrea">ISBN :</label> 
            <input id="isbn" name="isbn" type="text" value="' . $isbn . '" class="rechercheAdmin">
            <br/>
            <button type="submit" name="modiflivre" class="boutonAutre">Valider</button>
        </form>
    </div>';


        if (isset($_POST['titre']) && isset($_POST['nbPage']) && isset($_POST['isbn'])) {
//var_dump($_POST); die();
           $modiflivre = $db->prepare('UPDATE livre SET titre = ?, nbPage = ?, isbn = ? WHERE idLivre = ?');
           $modiflivre->execute(array($_POST['titre'], $_POST['nbPage'], $_POST['isbn'], $id ));

            if ($modiflivre) {
                header('Location = pageAdmin.php');
            }
        }


        ?>
    </div>
</section>

</body>
</html>

