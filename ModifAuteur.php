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
        $idAuteur = 0;
        $nomAuteur = '';
        $prenomAuteur = '';

        if (isset($_POST['idAuteur'])) {
            $id = $_POST['idAuteur'];
            $modif = $db->prepare('SELECT *
                                        FROM auteur
                                        WHERE idAuteur = :id');
            $modif->execute(array(':id' => $id));
            $row = $modif->fetch();
            $idAuteur = $row['idAuteur'];
            $nomAuteur = $row['nomAuteur'];
            $prenomAuteur = $row['prenomAuteur'];
                    }
        ?>

        <?php
        echo '<form action="" method="post"> 
            <input id="idAuteur" name="idAuteur" type="hidden" value="' . $idAuteur . '" class="rechercheAdmin">
            <label class="labelcrea">Nom de l\'auteur :</label>    
            <input id ="nomAuteur" name="nomAuteur" type="text" value="' . $nomAuteur . '" class="rechercheAdmin">
            <br/>
            <label class="labelcrea">Prénom de l\'auteur :</label> 
            <input id ="prenomAuteur" name="prenomAuteur" type="text" value="' . $prenomAuteur . '"  class="rechercheAdmin">
                        <br/> 
                        <button type="submit" name="modiflivre" class="boutonAutre">Valider</button>
        </form>
    </div>';



        if (isset($_POST['nomAuteur']) && isset($_POST['prenomAuteur'])) {

            $modiflivre = $db->prepare('UPDATE auteur SET nomAuteur = ?, 
                                                    prenomAuteur = ? 
                                                    WHERE idAuteur = ?');
            $modiflivre->execute(array($_POST['nomAuteur'], $_POST['prenomAuteur'], $id));
            if ($modiflivre) {
                header('Location = pageAdmin.php');
            }
        }




        ?>
    </div>
</section>

</body>
</html>

