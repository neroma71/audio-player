<?php
    require_once('./utils/connexion.php');

    $statement = $db->prepare("SELECT * FROM album");
    $statement->execute();
    $albums = $statement->fetchALL();

    foreach($albums as $album){
        echo "<img src='./images/". $album['pochette'] ."' alt=''> <p>". $album['nom_album']."</p>";
    }
?>

