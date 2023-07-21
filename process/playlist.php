<?php
if(isset($_POST['idmusic']) && !empty($_POST['idmusic'])){
   
        $req = $db->prepare("INSERT INTO playlist_musique (idPlaylist, idMusique) VALUES (?,?)");
        $req->execute(array(
            $_POST['selectPlaylist'],
            $_POST['idmusic']
        ));
}