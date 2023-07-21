<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/audio.css">
</head>
<body>
    <div class="upload">
    <form method="post" action="../process/traitement_playlist.php" enctype="multipart/form-data">
<p class="title_form">ajout playlist</p>
        <label for="titre">nom playlist</label><br />
        <input type="text" name="nom_playlist" ><br /><br />
        <label for="titre">photo de profil</label><br />
        <input type="file" name="avatar"><br /><br />
        <input type="submit" value="envoyer">
</form>
</div>
</body>
</html>