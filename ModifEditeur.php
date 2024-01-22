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
        $idEditeur = 0;
        $nomEditeur = '';

        if (isset($_POST['idEditeur'])) {
            $id = $_POST['idEditeur'];
            $modif = $db->prepare('SELECT *
                                        FROM editeur
                                        WHERE idEditeur = :id');
            $modif->execute(array(':id' => $id));
            $row = $modif->fetch();
            $idEditeur = $row['idEditeur'];
            $nomEditeur = $row['nomEditeur'];
                    }
        ?>

        <?php
        echo '<form action="" method="post"> 
            <input id="idEditeur" name="idEditeur" type="hidden" value="' . $idEditeur . '" class="rechercheAdmin">
            <label class="labelcrea">Nom de l\'auteur :</label>    
            <input id ="nomEditeur" name="nomEditeur" type="text" value="' . $nomEditeur . '" class="rechercheAdmin">
            <br/>
             <button type="submit" name="modiflivre" class="boutonAutre">Valider</button>
        </form>
    </div>';



        if (isset($_POST['nomEditeur'])) {

            $modiflivre = $db->prepare('UPDATE editeur SET nomEditeur = ?                                                 
                                                    WHERE idEditeur = ?');
            $modiflivre->execute(array($_POST['nomEditeur'], $id));
            if ($modiflivre) {
                header('Location = pageAdmin.php');
            }
        }




        ?>
    </div>
</section>

</body>
</html>

