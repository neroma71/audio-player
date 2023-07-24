<?php
session_start();
require('../utils/connexion.php');
$idplay = (int)$_GET['idplay'];

$req = $db->prepare('SELECT * FROM playlist_musique INNER JOIN musique ON musique.idMusique = playlist_musique.idMusique INNER JOIN playlist ON playlist_musique.idPlaylist = playlist.idPlaylist INNER JOIN album ON musique.idAlbum = album.idAlbum WHERE playlist_musique.idPlaylist = :idplay');
$req->bindValue(":idplay", $idplay, PDO::PARAM_INT);
$req->execute();
$playlists = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <?php include('menu.php'); ?>
<main>
<?php
$index=0;
                foreach ($playlists as $playlist) {
                   echo "<h1>Liste de ". $playlist['nom_playlist']. "</h1>";
                    echo "<div id='$index' class='blocksong'>
                    <img src='../icon/play.svg'>
                    ".$playlist['nom_musique']." <img class='imgliste'src='../uploads/".$playlist['pochette']."'></div>";
                        $index++;
                }
                ?>
            </main>
       <script src="../js/menu.js"></script>         
</body>
</html>