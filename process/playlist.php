<?php

if(isset($_POST['idmusic']) && !empty($_POST['idmusic'])){
   
    require('../utils/connexion.php');
        $req = $db->prepare("INSERT INTO `playlist_musique`(`idPlaylist`, `idMusique`) VALUES ('?','?')");
        $req->execute(array(
            'idPlaylist'=> $music['idMusique'],
            'idMusique'=> $_POST['idmusic']
        ));
}