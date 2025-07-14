<?php
include('../inc/fonction.php');

$categories = get_all_categories(); 

$categorie_selectionnee = $_GET['categorie'] ?? null;
$liste = [];
if ($categorie_selectionnee !== null && $categorie_selectionnee !== '') {
    $liste = liste_objets_par_nom_categorie($categorie_selectionnee);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objets par Catégorie</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header class="bg-primary text-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Objets par Catégorie</h1>
                <div>
                    <a href="listeObjet.php" class="btn btn-light me-2">
                        <i class="fas fa-list me-1"></i> Tous les objets
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-4">
        <div class="mb-4">
            <h4>Filtrer par catégorie :</h4>
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($categories as $categorie): ?>
                    <a href="?categorie=<?= urlencode($categorie['nom_categorie']) ?>" 
                       class="btn btn-outline-primary <?= $categorie_selectionnee == $categorie['nom_categorie'] ? 'active' : '' ?>">
                        <?= htmlspecialchars($categorie['nom_categorie']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (!empty($liste)): ?>
            <div class="row g-4">
                <?php foreach ($liste as $obj): 
                    $isBorrowed = !empty($obj['date_retour']) && strtotime($obj['date_retour']) > time();
                    ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100 border-0 shadow-sm objet-card">
                            <img src="../assets/image/<?= htmlspecialchars($obj['nom_image']) ?>" 
                                 class="card-img-top objet-image" 
                                 alt="<?= htmlspecialchars($obj['nom_objet']) ?>">
                            <div class="card-body">
                                <h5 class="card-title objet-title"><?= htmlspecialchars($obj['nom_objet']) ?></h5>
                                
                                <ul class="list-unstyled objet-meta">
                                    <li class="mb-2">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        <span>Propriétaire: <?= htmlspecialchars($obj['proprietaire'] ?? 'Inconnu') ?></span>
                                    </li>
                                    
                                    <?php if(!empty($obj['emprunteur'])): ?>
                                    <li class="mb-2">
                                        <i class="fas fa-user-friends text-primary me-2"></i>
                                        <span>Emprunteur: <?= htmlspecialchars($obj['emprunteur']) ?></span>
                                    </li>
                                    <?php endif; ?>
                                    
                                    <?php if($isBorrowed): ?>
                                    <li class="mb-2">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        <span>Emprunté le: <?= date('d/m/Y', strtotime($obj['date_emprunt'])) ?></span>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-undo text-primary me-2"></i>
                                        <span class="return-date">Retour: <?= date('d/m/Y', strtotime($obj['date_retour'])) ?></span>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <span class="badge rounded-pill <?= $isBorrowed ? 'bg-danger' : 'bg-success' ?>">
                                    <?= $isBorrowed ? 'Emprunté' : 'Disponible' ?>
                                </span>
                                <span class="badge bg-secondary ms-1">
                                    <?= htmlspecialchars($obj['nom_categorie']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Aucun objet trouvé dans cette catégorie.
            </div>
        <?php endif; ?>
    </main>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>