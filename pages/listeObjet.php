<?php
include('../inc/fonction.php');
session_start();
$donne = liste_objets_empruntes();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Objets</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Liste des Objets</h1>
                <div>
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

    <main class="container py-4">
        <div class="row g-4">
            <?php foreach ($donne as $d) {

                $isBorrowed = !empty($d['date_retour']) && strtotime($d['date_retour']) > time();
            ?>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="fiche_upload.php?id_img_principale=<?= $d['id_image'] ?>&&id_objet=<?= $d['id_objet'] ?>">
                        <div class="card h-100 border-0 shadow-sm objet-card">
                            <img src="../assets/image/<?= $d['nom_image'] ?>" class="card-img-top objet-image" alt="<?= $d['nom_objet'] ?>">
                            <div class="card-body">
                                <h5 class="card-title objet-title"><?= $d['nom_objet'] ?></h5>

                                <ul class="list-unstyled objet-meta">
                                    <li class="mb-2">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        <span>Propriétaire: <?= $d['emprunteur'] ?></span>
                                    </li>

                                    <?php if ($isBorrowed): ?>
                                        <li class="mb-2">
                                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                                            <span>Emprunté le: <?= date('d/m/Y', strtotime($d['date_emprunt'])) ?></span>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-undo text-primary me-2"></i>
                                            <span class="return-date">Retour: <?= date('d/m/Y', strtotime($d['date_retour'])) ?></span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="details_objet.php?id=<?= $d['id_objet'] ?>" class="btn btn-sm btn-outline-primary float-end">
                                    <i class="fas fa-eye"></i> Détails
                                </a>
                                <?php if (!$isBorrowed) { ?>
                                    <a href="emprunt.php?id_membre=<?= $d['id_membre'] ?>&id_objet=<?= $d['id_objet'] ?>">
                                        <input type="button" value="Emprunter">
                                    </a>
                                <?php } ?>
                                    <?php if($isBorrowed){?>
                                    <span class="badge rounded-pill <?= $isBorrowed ? 'bg-danger' : 'bg-success' ?>">
                                        Disponible dans <?= $_SESSION['newDate']?> j;
                                </span>
                                <?php } ?>
                                

                            </div>
                            <a href="fiche.php?id_objet=<?= $d['id_objet'] ?>&nom_image=<?= $d['nom_image'] ?>&id_image=<?= $d['id_image'] ?>">Aller a la fiche</a>
                            <a href="ficheMembre.php?id_membre=<?= $d['id_membre'] ?>">Fiche membre</a>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </main>

    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>