<?php
  require('../utlis/connexion.php');
  
  if(isset($_GET["s"]) AND $_GET["s"] == "Rechercher"){
    $_GET["terme"] = htmlspecialchars($_GET["terme"]);
    $terme = $_GET["terme"];
    $terme = trim($terme);
    $terme = strip_tags($terme);

    if(isset($terme)){
        $terme = strtolower($terme);

        $select_terme = $db->prepare("SELECT nom_musique, artiste FROM musique WHERE nom_musqiue LIKE ? OR artiste LIKE ? UNION SELECT nom_album FROM album WHERE nom_album LIKE ? ");  
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
    <title>Document</title>
</head>
<body>
  <?php
    while($terme_trouve = $select_terme->fetch()){
        echo "<p>prenom : ".$terme_trouve['firstname']." nom :".$terme_trouve['lastname']."</p>";
    }
    $select_terme->closeCursor();
  ?>
</body>
</html>