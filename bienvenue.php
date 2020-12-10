<?php

session_start();
if(!isset($_SESSION["user"])){
    header("Location:index.php");
} else {
    $user = $_SESSION["user"];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Connexion réussie, bienvenue <?php echo $user ?> !</p>
    <form action="logout.php">
        <input type="submit" value="Se déconnecter">
    </form>
</body>

</html>