<?php
if (isset($_FILES['lien_musique']) and !empty($_FILES['lien_musique']['name'])) {
  
    $tailleMax = 1000000000000000000;
    $extentionsValides = ["mp3", "MP3", "MPEG", "mpeg"];
   
    if ($_FILES['lien_musique']['size'] <= $tailleMax) {
        $extensionUpload = strtolower(substr(strrchr($_FILES['lien_musique']['name'], '.'), 1));

        if (in_array($extensionUpload, $extentionsValides)) {

            $chemin = "../songs/" . $_FILES['lien_musique']['name'];

            $resultat = move_uploaded_file($_FILES['lien_musique']['tmp_name'], $chemin);

            if ($extensionUpload) {

                var_dump($resultat);
            } else {
                echo "<p>erreur d'importation</p>";
            }
        } else {
            echo "mauvais format de musique";
        }
    } else {
        echo "votre morceau est trop lourde ";
    }
}
if (isset($_POST['nom_musique'])) {
    require_once('../utils/connexion.php');
    $requete = $db->prepare("INSERT INTO musique(nom_musique,lien_musique,idAlbum) VALUES (:nom_musique, :lien_musique,:idAlbum)");
    $requete->execute(array(
        'nom_musique' => $_POST['nom_musique'],
        'lien_musique' => $_FILES['lien_musique']['name'],
        'idAlbum' => $_POST['idAlbum'],
    ));
    header("location: ../index.php");
}
