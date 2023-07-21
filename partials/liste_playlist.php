<?php
$req = $db->query('SELECT * FROM playlist ORDER BY idPlaylist DESC');

$playlists = $req->fetchAll();
?>

