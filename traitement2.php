<?php

session_start();

foreach ($_POST as $key => $val) {
    if (!empty($val)) {
        ${$key} = htmlspecialchars($val);
    } else {
        $_SESSION["champvide"] = "Le champ doit être renseigné";
        header("Location:http://localhost/maquette_netflix/page2.php");
        exit();
    }
}

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["invalidmail"] = "L'adresse e-mail n'est pas valide";
    header("Location:http://localhost/maquette_netflix/page2.php");
    exit();
}


if ($password !== $confirmpass) {
    $_SESSION["samepass"] = "Indiquez un mot de passe identique";
    header("Location:http://localhost/maquette_netflix/page2.php");
    exit();
}

try {
    $pdo = new PDO("mysql:dbname=netflix;host=localhost", "root", "");
} catch (PDOException $e) {
    echo 'Connexion failed : ' . $e->getMessage();
}

$query = $pdo->prepare("SELECT mail FROM user WHERE mail = :mail");
$query->bindParam(":mail", $mail);
$query->execute();

$password = sha1($password);

if (!$query->rowCount()) {
    $query = $pdo->prepare("INSERT INTO user (mail, password) values (:mail, :password)");
    $query->bindParam(":mail", $mail);
    $query->bindParam(":password", $password);
    $query->execute();
    header("Location:http://localhost/maquette_netflix/bienvenue2.php");
} else {
    $_SESSION["mailexist"] = "Cette adresse email est déjà utilisée";
    header("Location:http://localhost/maquette_netflix/page2.php");
    exit();
}
