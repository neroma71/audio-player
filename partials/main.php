<?php
    require('./utils/connexion.php');

    $req = $db->query('SELECT * FROM album');
    $albums = $req->fetchALL();
?>
<main>
    <section class="container">
        <div class="search">
            <div class="logo"></div>
            <form action="../partials/recherche.php" method="get" id="monform">
                <input type="search" name="terme" id="rechercher">
                <input type="submit" name="s" value="Rechercher">
            </form>
        </div>
       <?php include("menu.php"); ?>
        <h1>SpotiWish</h1>
        <article class="album">
            <?php
                foreach($albums as $album){
                    echo "<a href='album.php?id_album=".$album['idAlbum']."'><div class='block'><img src='uploads/".$album['pochette']."'>";
                    echo "<p>".$album['nom_album']."</p>";
                    echo "</div></a>";
                }
            ?>
        </article>
        <article class="playlist">
            <?php require('liste_playlist.php'); 
            
        foreach($playlists as $playlist){
            echo"<a href='partials/myplaylist.php?idplay=".$playlist['idPlaylist']."'><div class='block'><img src='uploads/".$playlist['avatar']."'><p>".$playlist['nom_playlist']."</p> </a></div>";
        }
    ?>
           
        </article>
    </section>
    <?php require_once('footer_accueil.php'); ?>
</main>
