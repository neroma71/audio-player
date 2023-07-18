<?php

require('./utils/connexion.php');
    $id_album = (int)$_GET['id_album'];
    $req = $db->prepare('SELECT * FROM album  WHERE idAlbum = :id_album');

$req->bindValue(":id_album", $id_album, PDO::PARAM_INT);
$req->execute();
$albums = $req->fetchAll();

$req = $db->prepare('SELECT * FROM musique INNER JOIN album ON album.idAlbum = musique.idAlbum WHERE album.idAlbum = :id_album');
$req->bindValue(":id_album", $id_album, PDO::PARAM_INT);
$req->execute();
$musics = $req->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    <link rel="stylesheet" href="css/album.css">
</head>
<body>
    <section class="album">
            <?php
                foreach($albums as $album){
                echo "<div class='block'>
                <img src='uploads/".$album['pochette']."'>";
                echo "<h4>".$album['nom_album']."</h4>";
                echo "<p>Artiste : ".$album['artiste']."</p>";
                echo "</div>";
                }
             ?>
     </section>
     <section class="songs">
        <?php
        foreach($musics as $music){
            echo "<div class='blocksong'>
            <img src='icon/play.svg'>
            ".$music['nom_musique'].
            "</div>";
        }
        ?>
     </section>

</body>
</html>