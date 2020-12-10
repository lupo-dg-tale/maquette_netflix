<?php
session_start();
$token = bin2hex(openssl_random_pseudo_bytes(6));
$_SESSION["token"] = $token;
$_SESSION["token_time"] = time();
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
            <h2>S'identifier</h2>
            <form action="traitement.php" method="POST">
                <?php
                if (isset($_SESSION["unknow"])) {
                    echo "<div>" . $_SESSION["unknow"] . "</div>";
                }
                ?>
                <input type="email" name="mail" id="mail" placeholder="E-mail" required>
                <?php
                if (isset($_SESSION["champvide"])) {
                    echo "<div>" . $_SESSION["champvide"] . "</div>";
                }
                if (isset($_SESSION["invalidmail"])) {
                    echo "<div>" . $_SESSION["invalidmail"] . "</div>";
                }
                ?>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <?php
                if (isset($_SESSION["champvide"])) {
                    echo "<div>" . $_SESSION["champvide"] . "</div>";
                }
                ?>
                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
                <input type="submit" name="submit" id="submit" value="S'identifier">
                <div>
                    <input type="checkbox" id="souvenir" name="souvenir">
                    <label for="souvenir">Se souvenir de moi</label>
                </div>
            </form>
            <p>Première visite sur Netflix ? <a href="page2.php">Inscrivez-vous</a></p>
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
