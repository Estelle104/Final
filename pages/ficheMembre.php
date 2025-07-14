<?php
include('../inc/fonction.php');
$id_membre = $_GET['id_membre'] ?? null;
$fiche = $id_membre ? get_fiche_membre($id_membre) : null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Membre - Site d'Emprunt</title>
    <link href="..assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="..assets/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    
</head>
<body>
    <header>
        <?php include('header.php'); ?>
    </header>
    
    <main class="container py-4">
        <?php if ($fiche): ?>
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center text-md-start">
                        <img src="../assets/image/<?= htmlspecialchars($fiche['membre']['image_profil'] ?? 'default-profile.jpg') ?>" 
                             alt="Photo de profil" 
                             class="profile-picture">
                    </div>
                    <div class="col-md-10">
                        <h1 class="mb-1"><?= htmlspecialchars($fiche['membre']['nom']) ?></h1>
                        <p class="text-muted mb-2">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            <?= htmlspecialchars($fiche['membre']['ville']) ?>
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary">
                                <i class="fas fa-user me-1"></i>
                                <?= htmlspecialchars($fiche['membre']['genre']) ?>
                            </span>
                            <span class="badge bg-secondary">
                                <i class="fas fa-birthday-cake me-1"></i>
                                <?= date('d/m/Y', strtotime($fiche['membre']['date_de_naissance'])) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Colonne des informations -->
                <div class="col-lg-4">
                    <div class="member-info-card">
                        <h3 class="h5 mb-3"><i class="fas fa-info-circle me-2"></i>Informations</h3>
                        
                        <div class="mb-3">
                            <p class="info-label mb-1">Email</p>
                            <p><?= htmlspecialchars($fiche['membre']['email']) ?></p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="info-label mb-1">Ville</p>
                            <p><?= htmlspecialchars($fiche['membre']['ville']) ?></p>
                        </div>
                        
                        <div>
                            <p class="info-label mb-1">Date de naissance</p>
                            <p><?= date('d/m/Y', strtotime($fiche['membre']['date_de_naissance'])) ?></p>
                        </div>
                    </div>
                    
                    <div class="member-info-card">
                        <h3 class="h5 mb-3"><i class="fas fa-chart-pie me-2"></i>Statistiques</h3>
                        
                        <div class="mb-3">
                            <p class="info-label mb-1">Objets partagés</p>
                            <p><?= array_reduce($fiche['categories'], function($carry, $cat) { 
                                return $carry + count($cat['objets']); 
                            }, 0) ?></p>
                        </div>
                        
                        <div>
                            <p class="info-label mb-1">Catégories</p>
                            <p><?= count($fiche['categories']) ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne des objets par catégorie -->
                <div class="col-lg-8">
                    <h2 class="h4 mb-3"><i class="fas fa-boxes me-2"></i>Objets partagés</h2>
                    
                    <?php if (count($fiche['categories']) > 0): ?>
                        <?php foreach ($fiche['categories'] as $categorie): ?>
                            <div class="category-card mb-4 p-3 bg-white rounded shadow-sm">
                                <h3 class="h5 mb-3 text-primary">
                                    <i class="fas fa-tag me-2"></i>
                                    <?= htmlspecialchars($categorie['nom_categorie']) ?>
                                    <span class="badge bg-secondary ms-2"><?= count($categorie['objets']) ?></span>
                                </h3>
                                
                                <div class="list-group">
                                    <?php foreach ($categorie['objets'] as $objet): ?>
                                        <div class="object-item d-flex align-items-center">
                                            <img src="../assets/image/<?= htmlspecialchars($objet['image_objet'] ?? 'default-object.jpg') ?>" 
                                                 alt="<?= htmlspecialchars($objet['nom_objet']) ?>" 
                                                 class="object-image me-3">
                                            <div class="flex-grow-1">
                                                <h4 class="h6 mb-0"><?= htmlspecialchars($objet['nom_objet']) ?></h4>
                                                <small class="text-muted">ID: <?= $objet['id_objet'] ?></small>
                                            </div>
                                            <a href="ficheObjet.php?id=<?= $objet['id_objet'] ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Ce membre n'a partagé aucun objet pour le moment.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                Membre non trouvé ou ID invalide.
            </div>
            <a href="liste_membres.php" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i> Retour à la liste
            </a>
        <?php endif; ?>
    </main>
    
    <footer>
        <?php include('footer.php'); ?>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>