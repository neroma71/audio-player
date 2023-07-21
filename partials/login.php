<?php
    if(!empty($_POST)){
        if(isset($_POST["email"], $_POST["pass"])
          && !empty($_POST["email"] && !empty($_POST["pass"]))
          ){
           if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
              die("ce n'est pas un email"); 
           } 
            
            require_once "../utils/connexion.php";
            
            $req = "SELECT * FROM `admin` WHERE `email` = :email";
            $query = $db->prepare($req);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            
            $query->execute();
            
            $user = $query->fetch();
                if(!$user){
                    die("L'utilisateur et le mot de passe est incorrect");
                }
            if(!password_verify($_POST["pass"], $user["pass"])){
                die("L'utilisateur et le mot de passe est incorrect");
            }
            session_start();
            $_SESSION["user"] = [
                "id" => $user["id"],
                "pseudo" => $user["username"],
                "email" => $user["email"]
            ];
            header("Location: admin.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="">
</head>

<body>
    <h1>connexion</h1>
     <form method="post">
        <label for="email">email</label><br />
        <input type="email" name="email" id="email"><br /><br />
        <label for="pass">mot de passe</label><br />
        <input type="password" name="pass" id="pass"><br /><br />
        <input type="submit" value="connexion">
    </form>
    <script src=""></script>
</body>
</html>