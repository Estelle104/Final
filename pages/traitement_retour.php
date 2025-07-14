<?php
include('../inc/fonction.php');

$id_objet = $_POST['id_objet'];
$id_membre = $_POST['id_membre'];
$etat = $_POST['etat'];


include('../inc/base.php');

$sql = "DELETE FROM Final_emprunt 
        WHERE id_objet = '$id_objet' AND id_membre = '$id_membre'";
$message;
if (mysqli_query($bdd, $sql)) {
    $message = "Merci d’avoir retourné l’objet. État : $etat";
} else {
    $message = "Erreur lors du retour : " . mysqli_error($bdd);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Message de Retour</title>
</head>
<body>
<header class="bg-primary text-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Liste des Objets</h1>
                <div>
                    <a href="listeRetour.php" class="btn btn-light me-2">
                        <i class="fas fa-users me-1"></i> Liste retourner
                    </a>
                    <a href="#" class="btn btn-light me-2">
                        <i class="fas fa-users me-1"></i> Emprunt en cours
                    </a>
                    <a href="filtreCategorie.php" class="btn btn-accent">
                        <i class="fas fa-plus me-1"></i> Filtre par Categorie
                    </a>
                    <a href="deconnexion.php" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Deconnexion
                    </a>
                    <a href="index.php" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Accueil
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
    <main>
        <div class="container">
            <h2><?php echo $message ?></h2>
        </div>
    </main>
    </main>
</body>
</html>
