<?php
if (!isset($_GET['id_objet']) || !isset($_GET['id_membre'])) {
    die("Paramètres manquants.");
}

$id_objet = $_GET['id_objet'];
$id_membre = $_GET['id_membre'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Retour emprunt</title>
</head>
<body>
    <h2>État de l'objet emprunté</h2>

    <form action="traitement_retour.php" method="POST">
        <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
        <input type="hidden" name="id_membre" value="<?= $id_membre ?>">

        <label>
            <input type="radio" name="etat" value="ok" required> OK
        </label>
        <label>
            <input type="radio" name="etat" value="abime"> Abîmé
        </label><br><br>

        <button type="submit">Valider le retour</button>
    </form>
</body>
</html>
