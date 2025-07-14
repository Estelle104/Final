<?php
require("../inc/fonction.php");
session_start();

$uploadDir = __DIR__ . '/../assets/image/';
$maxSize = 20 * 1024 * 1024;  // 20 Mo
$allowedMimeTypes = ['image/jpg', 'image/jpeg', 'image/png'];

$id_img_principale = $_POST['id_img_principale'] ?? null;
$id_objet = $_POST['id_objet'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['sous_image']) && $id_img_principale && $id_objet) {
    $file = $_FILES['sous_image'];

    if ($file['size'] > $maxSize) {
        header('Location: fiche_upload.php?id_img_principale=' . urlencode($id_img_principale) . '&id_objet=' . urlencode($id_objet) . '&erreur=taille');
        exit;
    }

    // Vérifie le type MIME du fichier
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        header('Location: fiche_upload.php?id_img_principale=' . urlencode($id_img_principale) . '&id_objet=' . urlencode($id_objet) . '&erreur=type');
        exit;
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
         add_sous_image($id_img_principale, $newName, $id_objet);

        header('Location: fiche_upload.php?id_img_principale=' . urlencode($id_img_principale) . '&id_objet=' . urlencode($id_objet) . '&success=1');
        exit;
    } else {
        header('Location: fiche_upload.php?id_img_principale=' . urlencode($id_img_principale) . '&id_objet=' . urlencode($id_objet) . '&erreur=upload');
        exit;
    }
} else {
    echo "Aucun fichier reçu ou données manquantes.";
}
