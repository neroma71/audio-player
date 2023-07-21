<?php
    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
        $tailleMax = 2097152;
        $extentionsValides = ["jpg" => "image/jpg",
                              "jpeg" => "image/jpeg",
                              "gif" => "image/gif",
                              "png" => "image/png",
                             ];
            $filetype = $_FILES["avatar"]["name"] && $_FILES["avatar"]["type"];
        if($_FILES['avatar']['size'] <= $tailleMax){
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if(array_key_exists($extensionUpload, $extentionsValides) && in_array($filetype, $extentionsValides)){
                $chemin = "../uploads/".$_FILES['avatar']['name'];
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
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
if(isset($_POST['nom_playlist'])){
    require('../utils/connexion.php');
    $req = $db->prepare("INSERT INTO playlist(nom_playlist, avatar) VALUES(:nom_playlist, :avatar)");
    if($req->execute(array(
        'nom_playlist'=>$_POST['nom_playlist'],
        'avatar'=>$_FILES['avatar']['name']
    )));
    header("location: ../index.php");
}
