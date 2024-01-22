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
        <header>
            <nav class="banniere">
                <a href="index.php" class="logo"><img src="images/iconeBook2.png" alt="empilement de livres">
                    <h1>Bibliothèque ESB</h1></a>
                <ul class="menu">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="LivresBestOf.php">Livres</a></li>
                    <li><a href="index.php"><button class="boutonMenu" type="submit">Connexion</button></a></li>
                </ul>
            </nav>
        </header>

        <section>
            <div class="connectionIndex">
            <h2>Création de compte</h2>
            <?php
            echo "<div>Veuillez renseigner tous les champs</div>";
            ?>
            <br/>
            <form action="CompteCreeValidation.php" method="post">
                <label for="emailUser" class="labelcrea">Votre email</label>
                <input id="emailUser" name="emailUser" type="email" required>
                <br/>
                <label for="motDePasse" class="labelcrea">Votre mot de passe</label>
                <input id="motDePasse" name="motDePasse" type="password" required>
                <br/>
                <label for="nomUser" class="labelcrea">Votre nom</label>
                <input id="nomUser" name="nomUser" type="text" required>
                <br/>
                <label for="prenomUser" class="labelcrea">Votre prénom</label>
                <input id="prenomUser" name="prenomUser" type="text" required>
                <br/>
                <label for="dateNaissance" class="labelcrea">Votre date de naissance</label>
                <input id="dateNaissance" name="dateNaissance" type="date" class="date" required>
                <br/>
                <button type="submit" class="boutonAutre">Valider</button><br/>
            </form>
            </div>
        </section>

        <footer>
            <p class="copyright">Copyright 2023 - ESB</p>
        </footer>
    </body>
</html>
