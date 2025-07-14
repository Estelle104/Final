<?php
    include('../inc/fonction.php');

    $id_membre  = $_POST['id_membre'];
    $id_objet  = $_POST['id_objet'];
    $newDate  = $_POST['newdate'];

    if(isset($newDate)){
        $sql = upDateEmprunt($newDate, $id_membre, $id_objet);
        $diff = joursRestants($newDate);
        $_SESSION['newDate'] = $diff;

        header('Location: emprunt.php?id_objet=' . urlencode($id_objet) . '&id_membre=' . urlencode($id_membre));
        exit;
    } else {
        echo "Ajouter une date de retour";
    }
?>
