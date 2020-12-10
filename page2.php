<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <img src="img/logo_netflix.png" alt="logo netflix">
        <h1 hidden>Netflix</h1>
    </header>
    <main>
        <section>
            <h2>S'inscrire</h2>
            <form action="traitement2.php" method="POST">
                <input class="inputback" type="email" name="mail" id="mail" placeholder="Votre e-mail" required>
                <?php
                if (isset($_SESSION["champvide"])) {
                    echo "<div>" . $_SESSION["champvide"] . "</div>";
                }
                if (isset($_SESSION["invalidmail"])) {
                    echo "<div>" . $_SESSION["invalidmail"] . "</div>";
                }
                if (isset($_SESSION["mailexist"])) {
                    echo "<div>" . $_SESSION["mailexist"] . "</div>";
                }
                ?>
                <input class="inputback" type="password" name="password" id="password" placeholder="Mot de passe" required>
                <?php
                if (isset($_SESSION["champvide"])) {
                    echo "<div>" . $_SESSION["champvide"] . "</div>";
                }
                ?>
                <input class="inputback" type="password" name="confirmpass" id="confirmpass" placeholder="Confirmez votre mot de passe" required>
                <?php
                if (isset($_SESSION["champvide"])) {
                    echo "<div>" . $_SESSION["champvide"] . "</div>";
                }

                if(isset($_SESSION["samepass"])) {
                    echo "<div>" . $_SESSION["samepass"] . "</div>";
                }
                ?>
                <input class="inputback" type="submit" name="submit" id="submit" value="S'identifier">
            </form>
            <p>Déjà sur Netflix ? <a href="index.php">Connectez-vous</a></p>
        </section>
    </main>
    <footer>
        <p>Des questions ? Appeler le 06 65 65 65 65</p>
        <nav>
            <a href="#">Conditions des cartes cadeaux</a>
            <a href="#">Conditions d'utilisation</a>
            <a href="#">Déclaration de confidentialité</a>
        </nav>
    </footer>
</body>

</html>
<?php
session_destroy();
?>