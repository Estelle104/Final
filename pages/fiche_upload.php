<?php
    include('../inc/fonction.php');
    $id_image_principale = $_GET['id_img_principale'];
    $id_objet = $_GET['id_objet'];
    echo $id_objet;
    // $id_image_principale = 7;
    $sous_image = get_sous_image($id_image_principale);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Fiche et Upload</title>
</head>
<body>
    <header>
        <?php include('header.php') ?>
    </header>
    <main>
        <div class="container">
            <?php foreach($sous_image as $donne) {?>
                <p> <?php echo $donne['nom_sous_image']; ?></p>
                
            <?php }?>
        </div>
        <div class="container">
        <div class="upload-container">
            <h2></h2>
            <form action="traitement_upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_img_principale" value="<?= $id_image_principale ?>">
                <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
              <div class="form-group">
                <label for="media">Fichier</label>
                <input type="file" id="sous_image" name="sous_image" accept="image/*" required>
              </div>
              <button type="submit" class="btn-upload">Publier</button>
            </form>
            <div class="back-link">
              <a href="modele.php">⬅ Retour </a>
            </div>
        </div>
        </div>
    </main>
</body>
</html>
