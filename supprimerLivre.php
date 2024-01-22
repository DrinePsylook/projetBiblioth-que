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
    <div class="connectionIndex">
        <h2>Suppression de livre</h2>

<?php
if(isset($_POST['idLivre'])) {
    $supprimer = $db->query('DELETE FROM livre WHERE idLivre ="'.$_POST['idLivre'].'";') or die(print_r($db->errorInfo()));
}

   if($supprimer) {
        echo "Le livre a bien été supprimé <br/>";
    }else{
        echo "Impossible de supprimer le livre : il est utilisé pour l'historique d'emprunt <br/>";
    }
?>
        <a href = "pageAdmin.php"><button name= 'retour' type='button' class='boutonAutre'>Retour</button></a>
    </div>
</section>

<footer>
    <p class="copyright">Copyright 2023 - ESB</p>
</footer>
</body>
</html>
