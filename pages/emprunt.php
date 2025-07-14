<?php
    session_start();
    $id_user = $_SESSION['user']['id_membre'];
    $id_membre = $_GET['id_membre'];
    $id_objet = $_GET['id_objet'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="traitement_emprunt.php" method="post">
  <input type="datetime-local" name="newdate" required>
  <input type="hidden" name="id_membre" value="<?= $id_membre ?>">
  <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
  <button type="submit">Emprunter</button>
</form>
</body>
</html>