<?php

session_start();

//On va vérifier :
//Si le jeton est présent dans la session et dans le formulaire
if (isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
    //Si le jeton de la session correspond à celui du formulaire
    if ($_SESSION['token'] == $_POST['token']) {
        //On stocke le timestamp qu'il était il y a 15 minutes
        $timestamp_ancien = time() - (15 * 60);
        //Si le jeton n'est pas expiré
        if ($_SESSION['token_time'] >= $timestamp_ancien) {
            unset($_SESSION["token"]);
            foreach ($_POST as $key => $val) {
                if (!empty($val)) {
                    ${$key} = htmlspecialchars($val);
                } else {
                    $_SESSION["champvide"] = "Le champ doit être renseigné";
                    header("Location:http://localhost/maquette_netflix/index.php");
                    exit();
                }
            }

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $_SESSION["invalidmail"] = "L'adresse e-mail n'est pas valide";
                header("Location:http://localhost/maquette_netflix/index.php");
                exit();
            }

            try {
                $pdo = new PDO("mysql:dbname=netflix;host=localhost", "root", "");
            } catch (PDOException $e) {
                echo 'Connexion failed : ' . $e->getMessage();
            }

            $query = $pdo->prepare("SELECT mail, password FROM user WHERE mail = :mail and password = :password");
            $query->bindParam(":mail", $mail);
            $query->bindParam(":password", $password);
            $query->execute();

            $password = sha1($password);

            if ($query->rowCount()) {
                $res = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION["user"] = $res["mail"];
                header("Location:http://localhost/maquette_netflix/bienvenue.php");
            } else {
                $_SESSION["unknow"] = "Email ou mot de passe incorrect";
                header("Location:http://localhost/maquette_netflix/index.php");
            }
        } else {
            $_SESSION['error'] = "Oups, veuillez recommencer svp.";
            header("Location:index.php");
        }
    }
}
