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
    <div class="search">
        <div class="logo"></div>
        <form action="../partials/recherche.php" method="get" id="monform">
            <input type="search" name="terme" id="rechercher">
            <input type="submit" name="s" value="Rechercher">
        </form>
    </div>
    <?php include("partials/menu.php"); ?>
    <main>
        <div class="container">
            <section class="album">
                <?php
                foreach ($albums as $album) {
                    echo "<div class='block'>
                <img src='uploads/" . $album['pochette'] . "'>";
                    echo "<h4>" . $album['nom_album'] . "</h4>";
                    echo "<p>Artiste : " . $album['artiste'] . "</p>";
                    echo "</div>";
                }
                ?>
            </section>
            <section class="songs">
                <?php
                foreach ($musics as $music) {
                    echo "<div class='blocksong'>
            <img src='icon/play.svg'>
            " . $music['nom_musique'] .
                        "<form method='post' action='process/playlist.php'>
                            <input type='submit' name='liste' value='ajouter à la playlist' />
                        </form></div>";
                }
                ?>
            </section>
        </div>
        <footer></footer>
    </main>
    <script src="js/menu.js"></script>
</body>

</html>