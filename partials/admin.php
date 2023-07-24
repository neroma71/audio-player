<?php
session_start();
    if(!isset($_SESSION["user"])){
        header("location: ../index.php");
        die("go out");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/audio.css">
</head>
<body>
    <div class="upload">
<form method="post" action="../process/upload.php" enctype="multipart/form-data">
<p class="title_form">upload album</p>
        <label for="titre">titre de l'album</label><br />
        <input type="text" name="nom_album" id="titre"><br /><br />
        <label for="titre">artiste</label><br />
        <input type="text" name="artiste" id="artiste"><br /><br />
        <input type="file" name="pochette"><br /><br />
        <input type="submit" value="envoyer">
</form>
<p>toto</p>
<form method="post" action="../process/uploadmp3.php" enctype="multipart/form-data">
<p class="title_form">upload music</p>
        <label for="titre">titre de l'album</label><br />
        <select name="idAlbum">
                    <?php
                    require('../utils/connexion.php');
                    $req = $db->query('SELECT * FROM album ORDER BY idAlbum DESC');
                    $albums = $req->fetchAll(); 
                    foreach($albums as $album){
                        echo"<option value=".$album['idAlbum'].">".$album['nom_album']."</option>";
                    }  
                    ?>
        </select><br /><br />
        <label for="titre">titre du morceau</label><br />
        <input type="text" name="nom_musique" id="titre"><br /><br />
        <input type="file" name="lien_musique"><br /><br />
        <input type="submit" value="envoyer">
</form>
    </div>
</body>
</html>