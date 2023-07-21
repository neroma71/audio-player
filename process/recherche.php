<?php
  require('../utils/connexion.php');
  
  if(isset($_GET["s"]) AND $_GET["s"] == "Rechercher"){
    $_GET["terme"] = htmlspecialchars($_GET["terme"]);
    $terme = $_GET["terme"];
    $terme = trim($terme);
    $terme = strip_tags($terme);

    if(isset($terme)){
        $terme = strtolower($terme);

        $select_terme = $db->prepare("SELECT * FROM album WHERE nom_album LIKE ? OR artiste LIKE ?");  
        $select_terme->execute(array("%".$terme."%", "%".$terme."%"));
    }else{
        echo "Vous devez rentrer votre recherche dans la barre de recherche";
    }
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link rel="stylesheet" href="../css/recherche.css">
</head>
<body>
  <section>
  <?php
    while($terme_trouve = $select_terme->fetch()){
        echo "<article class='link'><a href='../album.php?id_album=".$terme_trouve['idAlbum']."'>
        Album : ".$terme_trouve['nom_album']." / artiste : ".$terme_trouve['artiste']."
        <img src=../uploads/".$terme_trouve['pochette'].">
        </a></article>";
    }
    $select_terme->closeCursor();
  ?>
  </section>
</body>
</html>