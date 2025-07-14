<?php
include('../inc/fonction.php');

include('../inc/base.php');

$sql = "
    SELECT 
        m.id_membre,
        m.nom AS nom_membre,
        SUM(CASE WHEN r.etat = 'ok' THEN 1 ELSE 0 END) AS nb_ok,
        SUM(CASE WHEN r.etat = 'abime' THEN 1 ELSE 0 END) AS nb_abime
    FROM Final_retour r
    JOIN Final_membre m ON m.id_membre = r.id_membre
    GROUP BY m.id_membre, m.nom
    ORDER BY m.nom ASC;
";

$result = mysqli_query($bdd, $sql);

if (!$result) {
    die("Erreur SQL : " . mysqli_error($bdd));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Liste des retours</title>
</head>
<body>
<header class="bg-primary text-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Liste des Objets</h1>
                <div>
                    <a href="liste_retour.php" class="btn btn-light me-2">
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
    <h1>Liste des objets retournés (tous utilisateurs)</h1>

    <table border="1">
        <tr>
            <th>Utilisateur</th>
            <th>Objets retournés OK</th>
            <th>Objets retournés Abîmés</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['nom_membre']) ?></td>
                <td><?= $row['nb_ok'] ?></td>
                <td><?= $row['nb_abime'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
