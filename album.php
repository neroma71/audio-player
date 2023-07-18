<?php

require('./utils/connexion.php');
    $id_album = (int)$_GET['id_album'];
    $req = $db->prepare('SELECT * FROM album  WHERE idAlbum = :id_album');

$req->bindValue(":id_album", $id_album, PDO::PARAM_INT);
$req->execute();
$albums = $req->fetchAll();

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
    <section class="container">
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

</body>
</html>