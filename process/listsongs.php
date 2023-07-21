<?php
session_start();
 require_once('../utils/connexion.php');
if(isset($_SESSION['idAlbum']) && $_SESSION['idAlbum'] != ' '){
   
    $idAlbum = $_SESSION['idAlbum'];
    $statement = $db->prepare("SELECT lien_musique FROM musique WHERE idAlbum = $idAlbum");
    $statement->execute();
    $songs = $statement->fetchAll();
    
    foreach($songs as $song){
        echo $song['lien_musique'] . ' ';
    }
}


?>