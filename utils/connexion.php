<?php
    $dns = 'mysql:host=localhost;dbname=audio_player' ;
    $user = 'root';
    $password = '';

    try{
        $db = new PDO($dns, $user, $password);
    }
    catch(Exception $message){
        echo "impossible de se connectre" . "<pre>$message</pre>";
    }

?>