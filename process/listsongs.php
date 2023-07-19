<?php
require_once('../utils/connexion.php');
$statement = $db->prepare("SELECT lien_musique FROM musique WHERE idAlbum = 1");
$statement->execute();
$songs = $statement->fetchAll();

foreach($songs as $song){
    echo $song['lien_musique'] . ' ';
}

?>