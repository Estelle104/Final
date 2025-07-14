<?php
    error_reporting(E_ALL); ini_set('display_errors', 1); 
       session_start();
    include('../inc/fonction.php');
    $page = $_POST['page'];
    echo $page;

    if($page=="connexion"){
        $email = $_POST['email'] ?? '';
        $mdp = $_POST['mdp'] ?? '';
            
        if($user = login($email, $mdp)) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect";
            header('Location:login.php?page=connexion');
        }
        exit();
    }
    if($page == "inscription"){
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $mdp = $_POST['mdp'] ?? '';
        $type_user = $_POST['type_utilisateur'] ?? '';
            
        if(inscription($nom, $prenom, $email, $mdp ,$type_user)) {
            $_SESSION['success'] = "Inscription réussie! Vous pouvez vous connecter";
            header('Location: login.php?page=connexion');
        } else {
            $_SESSION['error'] = "Erreur lors de l'inscription";
            header('Location: login.php?page=inscription');
        }
        exit();
    }
?>