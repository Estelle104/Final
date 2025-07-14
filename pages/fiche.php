<?php 
require('../inc/fonction.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hist = emprunt($_GET['id_objet']);
$id_image = $_GET['id_image'];

$img=getSousImage1($_GET['id_objet']);
$sary=img_principale($_GET['id_objet']);
// $img1=tab($img,$sary['nom_image']);
$sousImage = get_sous_image($id_image);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Property Detail</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
 
</head>
<body>
    <?php include('header.php');?> 
<div class="container py-5"><div class="bg-white p-4 shadow-sm rounded mb-5">
  <h5 class="fw-bold mb-4">Galerie</h5>

  <div class="position-relative text-center mb-3">
    <img id="mainImage" src="../assets/image/<?= htmlspecialchars($sary['nom_image']) ?>" class="img-fluid rounded border" alt="Image principale" style="max-width: 50%; height: auto;">

   
    <button class="btn btn-dark position-absolute top-50 start-0 translate-middle-y" onclick="prevImage()" aria-label="Précédent">
      <i class="fas fa-chevron-left"> < </i>
    </button>
    <button class="btn btn-dark position-absolute top-50 end-0 translate-middle-y" onclick="nextImage()" aria-label="Suivant">
      <i class="fas fa-chevron-right"> > </i>
    </button>
  </div>
    <hr>
  <div class="d-flex gap-2 overflow-auto">
    <?php foreach ($sousImage as $image): ?>
      <img src="<?= htmlspecialchars($image['nom_sous_image']) ?>" class="img-thumbnail" style="width: 100px; height: auto; cursor: pointer;" onclick="changeImage(this)">
    <?php endforeach; ?>
  </div>
</div>

   
    <div class="row">
                <h3>Historique</h3>
                <table  class="table table-success table-striped" style="margin:auto;">
                    <tr>
                        <th>date d'emprunt</th>
                        <th>date de retour</th>
                        <th>Membre</th>
                        <th>Objet</th>
                    </tr>
                    <?php foreach($hist as $h ){?>
                       <tr>
                            <td><?=$h['date_emprunt']?></td>
                            <td><?=$h['date_retour']?></td>
                            <td><?=$h['nom']?></td>
                            <td><?=$h['nom_objet']?></td>
                       </tr>
                    <?php } ?>    
                </table>
            </div>
</div>
</div>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
