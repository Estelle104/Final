<?php
require("../inc/fonction.php");

session_start();

$uploadDir = __DIR__ . '/../assets/image/';
$maxSize = 20 * 1024 * 1024; 
$id_img_principale = $_POST['id_img_principale'];


$allowedMimeTypes = ['image/jpg','image/jpeg','image/png'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['sous_image'])) {
    $file = $_FILES['sous_image'];
    if ($file['size'] > $maxSize) {
        header('Location:fiche_upload.php?id_img_principale=<?=  ?>');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowedMimeTypes)) {
        echo "Type de fichier non autorisé : " . $mime;
        exit;
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        echo "Fichier uploadé avec succès : " . $newName;
        
        get_sous_image($id_img_principale, $newName);

        header('Location:fiche_upload.php?id_img_principale=<?= $id_img_principale ?>');
    } else {
        $bool = move_uploaded_file($file['tmp_name'], $uploadDir . $newName);
    }
} else {
    echo "Aucun fichier reçu.";
}