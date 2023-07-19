<?php
    require_once('./utils/connexion.php');

    $statement = $db->prepare("SELECT lien_musique FROM musique WHERE idAlbum = 1");
    $statement->execute();
    $songs = $statement->fetchAll();
    $l= $songs['lien_musique'][0];
    $link = 'songs/'. $songs['lien_musique'];


?>