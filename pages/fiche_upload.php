<?php
    include('../inc/fonction.php');
    $id_image_principale = $_GET['id_img_principale'];
    $id_objet = $_GET['id_objet'];
    // echo $id_objet;
    // $id_image_principale = 7;
    $sous_image = get_sous_image($id_image_principale);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Fiche et Upload</title>

</head>
<body>
    <header>
        <?php include('header.php') ?>
    </header>
    <main class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h3 class="mb-4 text-center" style="color: var(--secondary);">Images associées</h3>
                    
                    <?php if(!empty($sous_image)): ?>
                        <div class="image-list">
                            <?php foreach($sous_image as $donne): ?>
                                <div class="image-item">
                                    <div class="image-name">
                                        <i class="fas fa-image me-2" style="color: var(--primary);"></i>
                                        <?php echo $donne['nom_sous_image']; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info text-center">
                            Aucune image associée pour le moment.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-md-6 mx-auto">
                    <div class="upload-container">
                        <h2 class="text-center"><i class="fas fa-cloud-upload-alt me-2"></i>Ajouter une image</h2>
                        <form action="traitement_upload.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_img_principale" value="<?= $id_image_principale ?>">
                            <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
                            
                            <div class="mb-3">
                                <label for="sous_image" class="form-label">Sélectionner un fichier image</label>
                                <input class="form-control" type="file" id="sous_image" name="sous_image" accept="image/*" required>
                                <div class="form-text">Formats acceptés: JPG, PNG, GIF (max 5MB)</div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-upload me-2"></i>Publier l'image
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-4">
                            <a href="listeObjet.php" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>