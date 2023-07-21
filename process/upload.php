<?php
    if(isset($_FILES['pochette']) AND !empty($_FILES['pochette']['name'])){
        $tailleMax = 2097152;
        $extentionsValides = ["jpg" => "image/jpg",
                              "jpeg" => "image/jpeg",
                              "gif" => "image/gif",
                              "png" => "image/png",
                             ];
            $filetype = $_FILES["pochette"]["name"] && $_FILES["pochette"]["type"];
        if($_FILES['pochette']['size'] <= $tailleMax){
            $extensionUpload = strtolower(substr(strrchr($_FILES['pochette']['name'], '.'), 1));
            if(array_key_exists($extensionUpload, $extentionsValides) && in_array($filetype, $extentionsValides)){
                $chemin = "../uploads/".$_FILES['pochette']['name'];
                $resultat = move_uploaded_file($_FILES['pochette']['tmp_name'], $chemin);
                if($resultat){
                    
                }else{
                   echo "erreur d'importation";
                }
            }else{
                echo "mauvais format de photo";
            }
        }else{
            echo "votre photo est trop lourde ";
        }
    }
if(isset($_POST['nom_album'])){
    require('../utils/connexion.php');
    $req = $db->prepare("INSERT INTO album(nom_album, artiste, pochette) VALUES(:nom_album, :artiste, :pochette)");
    if($req->execute(array(
        'nom_album'=>$_POST['nom_album'],
        'artiste'=>$_POST['artiste'],
        'pochette'=>$_FILES['pochette']['name']
    )));
    header("location: ../partials/admin.php");
}
