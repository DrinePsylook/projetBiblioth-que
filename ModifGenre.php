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
        <h2>Modification d'auteur</h2>

        <?php
        $idGenre = 0;
        $libelle = '';

        if (isset($_POST['idGenre'])) {
            $id = $_POST['idGenre'];
            $modif = $db->prepare('SELECT *
                                        FROM genre
                                        WHERE idGenre = :id');
            $modif->execute(array(':id' => $id));
            $row = $modif->fetch();
            $idGenre = $row['idGenre'];
            $libelle = $row['libelle'];
        }
        ?>

        <?php
        echo '<form action="" method="post"> 
            <input id="idGenre" name="idGenre" type="hidden" value="' . $idGenre . '" class="rechercheAdmin">
            <label class="labelcrea">Nom de l\'auteur :</label>    
            <input id ="libelle" name="libelle" type="text" value="' . $libelle . '" class="rechercheAdmin">
                                   <br/> 
                        <button type="submit" name="modiflivre" class="boutonAutre">Valider</button>
        </form>
    </div>';



        if (isset($_POST['libelle'])) {

            $modiflivre = $db->prepare('UPDATE genre SET libelle = ?                                                    
                                                    WHERE idGenre = ?');
            $modiflivre->execute(array($_POST['libelle'], $id));
            if ($modiflivre) {
                header('Location = pageAdmin.php');
            }
        }




        ?>
    </div>
</section>

</body>
</html>

