<?php
// lorsque l'on utilise les sessions, on commence toujours le script par "session_start();
// avant d'écrire la moindre ligne
session_start();
$_SESSION['user']; //session e-mail utilisateur
$_SESSION['userPrenom']; //prenom de l'utilisateur
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
            include('menuNv.php');
//            ?><!-- Menu de navigation-->
        </header>

        <section>

           <h2 class="titresolo"> Bienvenue sur ton profil <?php echo $_SESSION['userPrenom']; ?></h2>

            <h3 class="titreemprunt">Livres en cours d'emprunt :</h3>
            <div class="connectionLivres">

            <?php
            // Je construis ma requete :
            // afficher les emprunts sur le profil utilisateur
            $resultat = $db->query('SELECT emp.dateEmprunt, u.emailUser, l.titre, a.prenomAuteur, a.nomAuteur, ed.nomEditeur, l.idLivre
	FROM emprunt emp 
    INNER JOIN livre l 
    ON l.idLivre = emp.livreId
    INNER JOIN auteur a 
    ON a.idAuteur = l.auteurId
    INNER JOIN editeur ed 
    ON ed.idEditeur = l.editeurId
    INNER JOIN utilisateur u 
    ON u.emailUser = emp.userEmail
    WHERE u.emailUser = "'.$_SESSION['user'] .'" AND dateRetour IS NULL;') or die(print_r($db->errorInfo()));

            foreach ($resultat as $row) {
                echo "<div class='grille'><p><strong>Titre : </strong><em>" . $row['titre'] . "</em><br/> ";
                echo "<strong>Auteur : </strong>" . $row['prenomAuteur'] . " ";
                echo $row['nomAuteur'] . "<br/>";
                echo "<strong>Maison d'édition : </strong>" . $row['nomEditeur'] . "<br/>";
                echo "<form action='' method='post'>
                <input type='hidden' id='rendre' value =''>
                <button value ='".$row["idLivre"]."' name= 'rendre' type='submit' class='boutonUser'>Rendre</button>
                </form></div>";

                }

            if(isset($_POST['rendre'])){


                $rendre = $db->prepare('UPDATE emprunt, livre 
                                                SET emprunt.dateRetour = CURRENT_DATE, livre.boolDispo = TRUE
                                                WHERE userEmail = :user AND dateRetour IS NULL AND emprunt.livreId = :emp AND livre.idLivre = :emp;') or die(print_r($db->errorInfo()));
                $rendre->execute([
                        'emp' => $_POST['rendre'],
                    'user' => $_SESSION['user']
                ]);

                header("Location:profil.php");
            }

            ?>
            </div>
        </section>
    <hr/>
        <section>
        <h3 class="titreemprunt">Découvrez nos livres disponibles :</h3>

            <div class="connectionLivres">
        <?php
//php : emprunt de tous les livres
            $Emprunter = $db->query("SELECT l.titre, a.prenomAuteur, a.nomAuteur, ed.nomEditeur, l.idLivre
	FROM livre l
    INNER JOIN auteur a
    	ON a.idAuteur = l.auteurId
        INNER JOIN editeur ed 
        	ON ed.idEditeur = l.editeurId
	WHERE boolDispo = TRUE
	                   ORDER BY l.titre;") or die(print_r($db->errorInfo()));

            foreach ($Emprunter as $row) {
                echo "<div class='grille'><p><strong>Titre : </strong><em>" . $row['titre'] . "</em><br/> ";
                echo "<strong>Auteur : </strong>" . $row['prenomAuteur'] . " ";
                echo $row['nomAuteur'] . "<br/>";
                echo "<strong>Maison d'édition : </strong>" . $row['nomEditeur'] . "<br/>";
                echo "<form action='' method='post'>
                <input type='hidden' id='emprunter' value =''>
                <button value ='".$row["idLivre"]."' name='emprunter' type='submit' class='boutonUser'>Emprunter</button>
                </form></div>";
            }

        if(isset($_POST['emprunter'])){
            $emprunter = $db->prepare('INSERT INTO emprunt (userEmail, livreId, dateEmprunt, dateRetour)
                                                VALUES (:user, :livre, :dateEmp, :dateRet);
                                            UPDATE livre SET boolDispo = FALSE WHERE idLivre = :livre;') or die(print_r($db->errorInfo()));
            $emprunter->execute([
                'livre' => $_POST['emprunter'],
                'user' => $_SESSION['user'],
                'dateEmp' => date('y-m-d'),
                'dateRet' => NULL,
            ]);

            header("Location:profil.php");
        }

        ?>

        </div>
    </section>

        <footer>
            <p class="copyright">Copyright 2023 - ESB</p>
        </footer>
    </body>
</html>


