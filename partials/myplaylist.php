<?php
session_start();
require('../utils/connexion.php');
$idplay = (int)$_GET['idplay'];

$req = $db->prepare('SELECT * FROM playlist_musique INNER JOIN playlist ON playlist.idPlaylist = playlist_musique.idPlaylist WHERE playlist_musique.idMusique = :idplay');
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
<?php
$index=0;
                foreach ($playlists as $playlist) {
                    echo "<div id='$index' class='blocksong'>
                    <img src='icon/play.svg'>
                    <img src='icon/play.svg'>
                    ".$playlist['nom_musique']."</div>";
                        $index++;
                }
                ?>
</body>
</html>