<?php
    if(!empty($_POST)){
        if(isset($_POST["username"], $_POST["email"], $_POST["pass"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){
            $pseudo = strip_tags($_POST["username"]);

            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                die("l'adress email est incorrecte");
            }

            $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

            require_once "../utils/connexion.php";

            $req = "INSERT INTO `admin`(`username`, `email`, `pass`) VALUE(:pseudo, :email, '$pass')";

            $query = $db->prepare($req);

            $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

            $query->execute();

            $id = $db->lastInsertId();

            session_start();
            $_SESSION["user"] = [
                "id" => $id,
                "pseudo" => $pseudo,
                "email" => $_POST["email"]
            ];
            header("location: admin.php");
        }else{
            die("le formulaire est incomplet");
        }
    }
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/album.css">
</head>

<body>
<div class="search">
            <div class="logo"></div>
            <form action="../partials/recherche.php" method="get" id="monform">
                <input type="search" name="terme" id="rechercher">
                <input type="submit" name="s" value="Rechercher">
            </form>
</div>
        <?php include('menu2.php'); ?>
<main>
<h1>Inscription</h1>
    <form method="post" class="connexion">
        <label for="pseudo">pseudo</label><br />
        <input type="text" name="username" id="pseudo"><br /><br />
        <label for="email">email</label><br />
        <input type="email" name="email" id="email"><br /><br />
        <label for="pass">mot de passe</label><br />
        <input type="password" name="pass" id="pass"><br /><br />
        <input type="submit" value="s'inscrire">
    </form>
</main>
    <script src="../js/menu.js"></script>
</body>
</html>