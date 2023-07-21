<?php
    require('./utils/connexion.php');

    $req = $db->query('SELECT * FROM album');
    $albums = $req->fetchALL();
?>
<main>
    <section class="container">
        <div class="search">
            <form action="../process/recherche.php" method="get" id="monform">
                <input type="search" name="terme" id="rechercher">
                <input type="submit" name="s" value="Rechercher">
            </form>
        </div>
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
            <div class="block">toto</div>
            <div class="block">toto</div>
            <div class="block">toto</div>
            <div class="block">toto</div>
            <div class="block">toto</div>
            <div class="block">toto</div>
        </article>
    </section>
    <footer>fsdf</footer>
</main>